<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Order;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    private $_api_context;

    public function setApiContext()
    {
        $user        = \Auth::user();
        $paypal_conf = config('paypal');
        if($user->getGuard() == 'client')
        {
            $paypal_conf['settings']['mode'] = $user->currentWorkspace->paypal_mode;
            $paypal_conf['client_id']        = $user->currentWorkspace->paypal_client_id;
            $paypal_conf['secret_key']       = $user->currentWorkspace->paypal_secret_key;
        }
        else
        {
            $paymentSetting                  = Utility::getAdminPaymentSetting();
            $paypal_conf['settings']['mode'] = $paymentSetting['paypal_mode'];
            $paypal_conf['client_id']        = $paymentSetting['paypal_client_id'];
            $paypal_conf['secret_key']       = $paymentSetting['paypal_secret_key'];
        }
        
        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'], $paypal_conf['secret_key']
                )
            );
            $this->_api_context->setConfig($paypal_conf['settings']);
        }
        
        public function clientPayWithPaypal(Request $request, $slug, $invoice_id)
        {
        
        $user = Auth::user();

        $get_amount = $request->amount;

        $request->validate(['amount' => 'required|numeric|min:0']);

        $currentWorkspace = Utility::getWorkspaceBySlug($slug);

        if($currentWorkspace)
        {
            $invoice = Invoice::find($invoice_id);

            if($invoice)
            {
                if($get_amount > $invoice->getDueAmount())
                {
                    return redirect()->back()->with('error', __('Invalid amount.'));
                }
                else
                {
                    $this->setApiContext();

                    $name = $currentWorkspace->name . " - " . Utility::invoiceNumberFormat($invoice->invoice_id);

                    $payer = new Payer();
                    $payer->setPaymentMethod('paypal');
                    
                    $item_1 = new Item();
                    $item_1->setName($name)->setCurrency($currentWorkspace->currency_code)->setQuantity(1)->setPrice($get_amount);
                    
                    $item_list = new ItemList();
                    $item_list->setItems([$item_1]);
                    
                    $amount = new Amount();
                    $amount->setCurrency($currentWorkspace->currency_code)->setTotal($get_amount);
                    
                    $transaction = new Transaction();
                    $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name);
                    
                    $redirect_urls = new RedirectUrls();
                    $redirect_urls->setReturnUrl(
                        route(
                            'client.get.payment.status', [
                                                           $currentWorkspace->slug,
                                                           $invoice->id,
                                                       ]
                        )
                    )->setCancelUrl(
                        route(
                            'client.get.payment.status', [
                                $currentWorkspace->slug,
                                $invoice->id,
                                ]
                                )
                            );
                            
                    $payment = new Payment();
                    $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);

                    try
                    {
                        
                        $payment->create($this->_api_context);
                        // dd($payment);
                    }
                    catch(\PayPal\Exception\PayPalConnectionException $ex) //PPConnectionException
                    {
                        // dd($redirect_urls);
                        if(\Config::get('app.debug'))
                        {
                            return redirect()->route(
                                'client.invoices.show', [
                                                          $currentWorkspace->slug,
                                                          $invoice_id,
                                                      ]
                            )->with('error', __('Connection timeout'));
                        }
                        else
                        {
                            return redirect()->route(
                                'client.invoices.show', [
                                                          $currentWorkspace->slug,
                                                          $invoice_id,
                                                      ]
                            )->with('error', __('Some error occur, sorry for inconvenient'));
                        }
                    }
                    foreach($payment->getLinks() as $link)
                    {
                        if($link->getRel() == 'approval_url')
                        {
                            $redirect_url = $link->getHref();
                            break;
                        }
                    }
                    Session::put('paypal_payment_id', $payment->getId());
                    if(isset($redirect_url))
                    {
                        return Redirect::away($redirect_url);
                    }

                    return redirect()->route(
                        'client.invoices.show', [
                                                  $currentWorkspace->slug,
                                                  $invoice_id,
                                              ]
                    )->with('error', __('Unknown error occurred'));
                }
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function clientGetPaymentStatus(Request $request, $slug, $invoice_id)
    {
        $user = Auth::user();

        $invoice = Invoice::find($invoice_id);

        $currentWorkspace = Utility::getWorkspaceBySlug($slug);

        if($currentWorkspace && $invoice)
        {
            $this->setApiContext();

            $payment_id = Session::get('paypal_payment_id');

            Session::forget('paypal_payment_id');

            if(empty($request->PayerID || empty($request->token)))
            {
                return redirect()->route(
                    'client.invoices.show', [
                                              $currentWorkspace->slug,
                                              $invoice_id,
                                          ]
                )->with('error', __('Payment failed'));
            }

            $payment = Payment::get($payment_id, $this->_api_context);

            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            try
            {
                $result = $payment->execute($execution, $this->_api_context)->toArray();

                $order_id = strtoupper(str_replace('.', '', uniqid('', true)));

                $status = ucwords(str_replace('_', ' ', $result['state']));

                if($result['state'] == 'approved')
                {
                    $amount = $result['transactions'][0]['amount']['total'];
                }
                else
                {
                    $amount = isset($result['transactions'][0]['amount']['total']) ? $result['transactions'][0]['amount']['total'] : '0.00';
                }

                $invoice_payment                 = new InvoicePayment();
                $invoice_payment->order_id       = $order_id;
                $invoice_payment->invoice_id     = $invoice->id;
                $invoice_payment->currency       = $currentWorkspace->currency_code;
                $invoice_payment->amount         = $amount;
                $invoice_payment->payment_type   = 'PAYPAL';
                $invoice_payment->receipt        = '';
                $invoice_payment->client_id      = $user->id;
                $invoice_payment->txn_id         = $payment_id;
                $invoice_payment->payment_status = $result['state'];
                $invoice_payment->save();

                if($result['state'] == 'approved')
                {
                    if(($invoice->getDueAmount() - $invoice_payment->amount) == 0)
                    {
                        $invoice->status = 'paid';
                        $invoice->save();
                    }

                    return redirect()->route(
                        'client.invoices.show', [
                                                  $currentWorkspace->slug,
                                                  $invoice_id,
                                              ]
                    )->with('success', __('Payment added Successfully'));
                }
                else
                {
                    return redirect()->route(
                        'client.invoices.show', [
                                                  $currentWorkspace->slug,
                                                  $invoice_id,
                                              ]
                    )->with('error', __('Transaction has been ' . $status));
                }

            }
            catch(\Exception $e)
            {
                return redirect()->route(
                    'client.invoices.show', [
                                              $currentWorkspace->slug,
                                              $invoice_id,
                                          ]
                )->with('error', __('Transaction has been failed!'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function planPayWithPaypal(Request $request)
    {
        $authuser = \Auth::user();
        $planID   = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan     = \App\Models\Plan::find($planID);

        if($plan)
        {
            try
            {
                $coupon_id = null;
                $price     = (float)$plan->{$request->paypal_payment_frequency . '_price'};

                if(!empty($request->coupon))
                {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if(!empty($coupons))
                    {
                        $usedCoupun     = $coupons->used_coupon();
                        $discount_value = ($price / 100) * $coupons->discount;
                        $price          = $price - $discount_value;

                        if($coupons->limit == $usedCoupun)
                        {
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
                        }
                        $coupon_id = $coupons->id;
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }

                if($price <= 0)
                {
                    $authuser->plan = $plan->id;
                    $authuser->save();

                    $assignPlan = $authuser->assignPlan($plan->id);

                    if($assignPlan['is_success'] == true && !empty($plan))
                    {
                        if(!empty($authuser->payment_subscription_id) && $authuser->payment_subscription_id != '')
                        {
                            try
                            {
                                $authuser->cancel_subscription($authuser->id);
                            }
                            catch(\Exception $exception)
                            {
                                \Log::debug($exception->getMessage());
                            }
                        }

                        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                        Order::create(
                            [
                                'order_id' => $orderID,
                                'name' => $authuser->name,
                                'email' => null,
                                'card_number' => null,
                                'card_exp_month' => null,
                                'card_exp_year' => null,
                                'plan_name' => $plan->name,
                                'plan_id' => $plan->id,
                                'price' => $price,
                                'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'usd',
                                'txn_id' => '',
                                'payment_type' => __('Zero Price'),
                                'payment_status' => 'succeeded',
                                'receipt' => null,
                                'user_id' => $authuser->id,
                            ]
                        );

                        return redirect()->route('home')->with('success', __('Plan successfully upgraded.'));
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                    }
                }

                $this->setApiContext();

                $name = $plan->name;

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name)->setCurrency(!empty(env('CURRENCY')) ? env('CURRENCY') : 'usd')->setQuantity(1)->setPrice($price);

                $item_list = new ItemList();
                $item_list->setItems([$item_1]);

                $amount = new Amount();
                $amount->setCurrency(!empty(env('CURRENCY')) ? env('CURRENCY') : 'usd')->setTotal($price);

                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(
                    route(
                        'plan.get.payment.status', [
                                                     $plan->id,
                                                     'coupon_id' => $coupon_id,
                                                     'frequency' => $request->paypal_payment_frequency,
                                                 ]
                    )
                )->setCancelUrl(
                    route(
                        'plan.get.payment.status', [
                                                     $plan->id,
                                                     'coupon_id' => $coupon_id,
                                                     'frequency' => $request->paypal_payment_frequency,
                                                 ]
                    )
                );

                $payment = new Payment();
                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);

                try
                {
                    $payment->create($this->_api_context);
                }
                catch(\PayPal\Exception\PayPalConnectionException $ex) //PPConnectionException
                {
                    if(config('app.debug'))
                    {
                        return redirect()->route(
                            'payment', [
                                         $request->paypal_payment_frequency,
                                         \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                                     ]
                        )->with('error', __('Connection timeout'));
                    }
                    else
                    {
                        return redirect()->route(
                            'payment', [
                                         $request->paypal_payment_frequency,
                                         \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                                     ]
                        )->with('error', __('Some error occur, sorry for inconvenient'));
                    }
                }

                foreach($payment->getLinks() as $link)
                {
                    if($link->getRel() == 'approval_url')
                    {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                // Session::put('plan_paypal_payment_id', $payment->getId());

                if(isset($redirect_url))
                {
                    return Redirect::away($redirect_url);
                }

                return redirect()->route(
                    'payment', [
                                 $request->paypal_payment_frequency,
                                 \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                             ]
                )->with('error', __('Unknown error occurred'));
            }
            catch(\Exception $e)
            {
                return redirect()->route(
                    'payment', [
                                 $request->paypal_payment_frequency,
                                 \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                             ]
                )->with('error', __($e->getMessage()));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetPaymentStatus(Request $request, $plan_id)
    {
        $user = Auth::user();
        $plan = \App\Models\Plan::find($plan_id);

        if($plan)
        {
            $this->setApiContext();

            // $payment_idt = Session::get('plan_paypal_payment_id');
            $payment_id = $request->paymentId;

            if(empty($request->PayerID || empty($request->token)))
            {
                return redirect()->route(
                    'payment', [
                                 $request->frequency,
                                 \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                             ]
                )->with('error', __('Payment failed'));
            }

            $payment   = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            try
            {
                $result = $payment->execute($execution, $this->_api_context)->toArray();

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $status = ucwords(str_replace('_', ' ', $result['state']));

                //                Session::forget('plan_paypal_payment_id');

                if($result['state'] == 'approved')
                {
                    if(!empty($user->payment_subscription_id) && $user->payment_subscription_id != '')
                    {
                        try
                        {
                            $user->cancel_subscription($user->id);
                        }
                        catch(\Exception $exception)
                        {
                            \Log::debug($exception->getMessage());
                        }
                    }

                    if($request->has('coupon_id') && $request->coupon_id != '')
                    {
                        $coupons = Coupon::find($request->coupon_id);
                        if(!empty($coupons))
                        {
                            $userCoupon            = new UserCoupon();
                            $userCoupon->user_id   = $user->id;
                            $userCoupon->coupon_id = $coupons->id;
                            $userCoupon->order_id  = $orderID;
                            $userCoupon->save();

                            $usedCoupun = $coupons->used_coupon();
                            if($coupons->limit <= $usedCoupun)
                            {
                                $coupons->is_active = 0;
                                $coupons->save();
                            }
                        }
                    }

                    $order                 = new Order();
                    $order->order_id       = $orderID;
                    $order->name           = '';
                    $order->card_number    = '';
                    $order->card_exp_month = '';
                    $order->card_exp_year  = '';
                    $order->plan_name      = $plan->name;
                    $order->plan_id        = $plan->id;
                    $order->price          = $result['transactions'][0]['amount']['total'];
                    $order->price_currency = !empty(env('CURRENCY')) ? env('CURRENCY') : 'usd';
                    $order->txn_id         = $payment_id;
                    $order->payment_type   = 'Paypal';
                    $order->payment_status = $result['state'];
                    $order->receipt        = '';
                    $order->user_id        = $user->id;
                    $order->save();

                    $assignPlan = $user->assignPlan($plan->id, $request->frequency);

                    if($assignPlan['is_success'])
                    {
                        return redirect()->route('home')->with('success', __('Plan activated Successfully!'));
                    }
                    else
                    {
                        return redirect()->route(
                            'payment', [
                                         $request->frequency,
                                         \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                                     ]
                        )->with('error', __($assignPlan['error']));
                    }
                }
                else
                {
                    return redirect()->route(
                        'payment', [
                                     $request->frequency,
                                     \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                                 ]
                    )->with('error', __('Transaction has been ') . __($status));
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route(
                    'payment', [
                                 $request->frequency,
                                 \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                             ]
                )->with('error', __('Transaction has been failed!'));
            }
        }
        else
        {
            return redirect()->route(
                'payment', [
                             $request->frequency,
                             \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                         ]
            )->with('error', __('Plan is deleted.'));
        }
    }
}
