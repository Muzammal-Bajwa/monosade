<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Order;
use App\Models\Payment;
use Artisan;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\Utility;
use CoinGate\CoinGate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CoingatePaymentController extends Controller
{
    public $mode;
    public $coingate_auth_token;
    public $is_enabled;
    public $currancy;

    public function setPaymentDetail()
    {
        $user = Auth::user();
        if($user->getGuard() == 'client')
        {
            $payment_setting = Utility::getPaymentSetting($user->currentWorkspace->id);
            $this->currancy  = (isset($user->currentWorkspace->currency_code)) ? $user->currentWorkspace->currency_code : 'USD';
        }
        else
        {
            $payment_setting = Utility::getAdminPaymentSetting();
            $this->currancy  = !empty(env('CURRENCY')) ? env('CURRENCY') : 'USD';
        }

        $this->coingate_auth_token = isset($payment_setting['coingate_auth_token']) ? $payment_setting['coingate_auth_token'] : '';
        $this->mode                = isset($payment_setting['coingate_mode']) ? $payment_setting['coingate_mode'] : 'off';
        $this->is_enabled          = isset($payment_setting['is_coingate_enabled']) ? $payment_setting['is_coingate_enabled'] : 'off';
    }

    // public function planPayWithCoingate(Request $request)
    // {
    //     $this->setPaymentDetail();

    //     $authuser   = Auth::user();
    //     $planID     = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
    //     $plan       = Plan::find($planID);
    //     $coupons_id = '';

    //     if($plan)
    //     {
    //         /* Check for code usage */
    //         $plan->discounted_price = false;
    //         $price                  = $plan->{$request->coingate_payment_frequency . '_price'};

    //         if(isset($request->coupon) && !empty($request->coupon))
    //         {
    //             $request->coupon = trim($request->coupon);
    //             $coupons         = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();

    //             if(!empty($coupons))
    //             {
    //                 $usedCoupun             = $coupons->used_coupon();
    //                 $discount_value         = ($price / 100) * $coupons->discount;
    //                 $plan->discounted_price = $price - $discount_value;

    //                 if($usedCoupun >= $coupons->limit)
    //                 {
    //                     return redirect()->back()->with('error', __('This coupon code has expired.'));
    //                 }
    //                 $price      = $price - $discount_value;
    //                 $coupons_id = $coupons->id;
    //             }
    //             else
    //             {
    //                 return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
    //             }
    //         }

    //         if($price <= 0)
    //         {
    //             $authuser->plan = $plan->id;
    //             $authuser->save();

    //             $assignPlan = $authuser->assignPlan($plan->id, $request->coingate_payment_frequency);

    //             if($assignPlan['is_success'] == true && !empty($plan))
    //             {
    //                 if(!empty($authuser->payment_subscription_id) && $authuser->payment_subscription_id != '')
    //                 {
    //                     try
    //                     {
    //                         $authuser->cancel_subscription($authuser->id);
    //                     }
    //                     catch(\Exception $exception)
    //                     {
    //                         \Log::debug($exception->getMessage());
    //                     }
    //                 }

    //                 $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
    //                 Order::create(
    //                     [
    //                         'order_id' => $orderID,
    //                         'name' => null,
    //                         'email' => null,
    //                         'card_number' => null,
    //                         'card_exp_month' => null,
    //                         'card_exp_year' => null,
    //                         'plan_name' => $plan->name,
    //                         'plan_id' => $plan->id,
    //                         'price' => $price == null ? 0 : $price,
    //                         'price_currency' => $this->currancy,
    //                         'txn_id' => '',
    //                         'payment_type' => __('Zero Price'),
    //                         'payment_status' => 'succeeded',
    //                         'receipt' => null,
    //                         'user_id' => $authuser->id,
    //                     ]
    //                 );
                
    //                 return redirect()->back()->with('success', __('Plan activated Successfully!'));
    //             }
    //             else
    //             {
    //                 return redirect()->back()->with('error', __('Plan fail to upgrade.'));
    //             }
    //         }

    //         CoinGate::config(
    //             array(
    //                 'environment' => $this->mode,
    //                 'auth_token' => $this->coingate_auth_token,
    //                 'curlopt_ssl_verifypeer' => FALSE,
    //             )
    //         );
    //         $post_params = array(
    //             'order_id' => time(),
    //             'price_amount' => $price,
    //             'price_currency' => $this->currancy,
    //             'receive_currency' => $this->currancy,
    //             'callback_url' => route(
    //                 'plan.coingate', [
    //                                    $request->plan_id,
    //                                    'payment_frequency=' . $request->coingate_payment_frequency,
    //                                    'coupon_id=' . $coupons_id,
    //                                ]
    //             ),
    //             'cancel_url' => route('plan.coingate', [$request->plan_id]),
    //             'success_url' => route(
    //                 'plan.coingate', [
    //                                    $request->plan_id,
    //                                    'payment_frequency=' . $request->coingate_payment_frequency,
    //                                    'coupon_id=' . $coupons_id,
    //                                ]
    //             ),
    //             'title' => 'Plan #' . time(),
    //         );

    //         // $order = \CoinGate\Merchant\Order::create($post_params);

    //           try{
    //                 $order = Order::create($post_params);
    //          }

    //          catch(\Exception $e)
    //          {
    //              return redirect()->back()->with('error', __('BadAuthToken Auth Token is not valid.'));
    //          }
        

    //         if($order)
    //         {
    //             return redirect($order->payment_url);
    //         }
    //         else
    //         {
    //             return redirect()->back()->with('error', __('Something went wrong.'));
    //         }
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('error', 'Plan is deleted.');
    //     }

    // }

    public function planPayWithCoingate(Request $request)
    {
        $payment    = $this->setPaymentDetail();
        $planID     = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan       = Plan::find($planID);
        $authuser   = Auth::user();
        $coupons_id = '';

        if ($plan) {
            $price = $plan->monthly_price;
            if (isset($request->coupon) && !empty($request->coupon)) {
                $request->coupon = trim($request->coupon);
                $coupons         = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();

                if (!empty($coupons)) {
                    $usedCoupun             = $coupons->used_coupon();
                    $discount_value         = ($price / 100) * $coupons->discount;
                    $plan->discounted_price = $price - $discount_value;
                    $coupons_id             = $coupons->id;
                    if ($usedCoupun >= $coupons->limit) {
                        return redirect()->back()->with('error', __('This coupon code has expired.'));
                    }
                    $price = $price - $discount_value;
                } else {
                    return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                }
            }

            if ($price <= 0) {
                $authuser->plan = $plan->id;
                $authuser->save();

                $assignPlan = $authuser->assignPlan($plan->id);

                if ($assignPlan['is_success'] == true && !empty($plan)) {

                    $orderID = time();
                    Order::create(
                        [
                            'order_id' => $orderID,
                            'name' => null,
                            'email' => null,
                            'card_number' => null,
                            'card_exp_month' => null,
                            'card_exp_year' => null,
                            'plan_name' => $plan->name,
                            'plan_id' => $plan->id,
                            'price' => $price == null ? 0 : $price,
                            'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'USD',
                            'txn_id' => '',
                            'payment_type' => 'coingate',
                            'payment_status' => 'succeeded',
                            'receipt' => null,
                            'user_id' => $authuser->id,
                        ]
                    );
                    $assignPlan = $authuser->assignPlan($plan->id);

                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                } else {
                    return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                }
            }
            CoinGate::config(
                array(
                    'environment' => $this->mode,
                    'auth_token' => $this->coingate_auth_token,
                    'curlopt_ssl_verifypeer' => FALSE,
                )
            );
            $post_params = array(
                'order_id' => time(),
                'price_amount' => $price,
                'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'USD',
                'receive_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'USD',
                'callback_url' => route(
                    'plan.coingate',
                    [
                        $request->plan_id,
                        'coupon_id=' . $coupons_id,
                    ]
                ),
                'cancel_url' => route('plan.coingate', [$request->plan_id]),
                'success_url' => route(
                    'plan.coingate',
                    [
                        $request->plan_id,
                        'coupon_id=' . $coupons_id,
                    ]
                ),
                'title' => 'Plan #' . time(),
            );

            $order       = \CoinGate\Merchant\Order::create($post_params);
         
            if ($order) {
                return redirect($order->payment_url);
            } else {
                return redirect()->back()->with('error', __('opps something wren wrong.'));
            }
        } else {
            return redirect()->back()->with('error', 'Plan is deleted.');
        }
    }
    public function getPaymentStatus(Request $request)
    {
        $this->setPaymentDetail();

        $planID     = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan   = Plan::find($planID);
        $price  = $plan->{$request->payment_frequency . '_price'};
        $user   = Auth::user();

        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

        if($plan)
        {
            try
            {
                if($request->has('payment_frequency'))
                {
                    if($request->has('coupon_id') && $request->coupon_id != '')
                    {
                        $coupons = Coupon::find($request->coupon_id);
                        if(!empty($coupons))
                        {
                            $userCoupon         = new UserCoupon();
                            $userCoupon->user   = $user->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order  = $orderID;
                            $userCoupon->save();
                            $discount_value = ($price / 100) * $coupons->discount;
                            $price          = $price - $discount_value;
                            $usedCoupun     = $coupons->used_coupon();
                            if($coupons->limit <= $usedCoupun)
                            {
                                $coupons->is_active = 0;
                                $coupons->save();
                            }
                        }
                    }

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

                    $order                 = new Order();
                    $order->order_id       = $orderID;
                    $order->name           = $user->name;
                    $order->card_number    = '';
                    $order->card_exp_month = '';
                    $order->card_exp_year  = '';
                    $order->plan_name      = $plan->name;
                    $order->plan_id        = $plan->id;
                    $order->price          = $price;
                    $order->price_currency = $this->currancy;
                    $order->txn_id         = isset($request->transaction_id) ? $request->transaction_id : '';
                    $order->payment_type   = 'Coingate';
                    $order->payment_status = 'succeeded';
                    $order->receipt        = '';
                    $order->user_id        = $user->id;
                    $order->save();

                    $assignPlan = $user->assignPlan($plan->id, $request->payment_frequency);

                    if($assignPlan['is_success'])
                    {
                        return redirect()->route('home')->with('success', __('Plan activated Successfully!'));
                    }
                    else
                    {
                        return redirect()->route(
                            'payment', [
                                         $request->payment_frequency,
                                         \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                                     ]
                        )->with('error', __($assignPlan['error']));
                    }
                }
                else
                {
                    return redirect()->route(
                        'payment', [
                                     $request->payment_frequency,
                                     \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                                 ]
                    )->with('error', __('Transaction has been failed.'));
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route(
                    'payment', [
                                 $request->payment_frequency,
                                 \Illuminate\Support\Facades\Crypt::encrypt($plan->id),
                             ]
                )->with('error', __('Plan not found!'));
            }
        }
    }

    public function invoicePayWithCoingate(Request $request, $slug, $invoice_id)
    {
        $validatorArray = [
            'amount' => 'required',
        ];
        $validator      = Validator::make(
            $request->all(), $validatorArray
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', __($validator->errors()->first()));
        }

        $this->setPaymentDetail();

        $invoice = Invoice::find($invoice_id);
        if($invoice->getDueAmount() < $request->amount)
        {
            return redirect()->route(
                'client.invoices.show', [
                                          $slug,
                                          $invoice_id,
                                      ]
            )->with('error', __('Invalid amount.'));
        }
        CoinGate::config(
            array(
                'environment' => $this->mode,
                'auth_token' => $this->coingate_auth_token,
                'curlopt_ssl_verifypeer' => FALSE,
            )
        );
        $post_params = array(
            'order_id' => time(),
            'price_amount' => $request->amount,
            'price_currency' => $this->currancy,
            'receive_currency' => $this->currancy,
            'callback_url' => route(
                'client.invoice.coingate', [
                                             $slug,
                                             encrypt($invoice->id),
                                         ]
            ),
            'cancel_url' => route(
                'client.invoice.coingate', [
                                             $slug,
                                             encrypt($invoice->id),
                                         ]
            ),
            'success_url' => route(
                'client.invoice.coingate', [
                                             $slug,
                                             encrypt($invoice->id),
                                             'success=true',
                                         ]
            ),
            'title' => 'Plan #' . time(),
        );
        $order       = \CoinGate\Merchant\Order::create($post_params);
        if($order)
        {
            $request->session()->put('invoice_data', $post_params);

            return redirect($order->payment_url);
        }
        else
        {
            return redirect()->back()->with('error', __('Something went wrong.'));
        }
    }

    public function getInvoicePaymentStatus($slug, $invoice_id, Request $request)
    {
        $this->setPaymentDetail();

        if(!empty($invoice_id))
        {
            $user             = Auth::user();
            $currentWorkspace = Utility::getWorkspaceBySlug($slug);

            $invoice_id   = decrypt($invoice_id);
            $invoice      = Invoice::find($invoice_id);
            $invoice_data = $request->session()->get('invoice_data');

            if($invoice && !empty($invoice_data))
            {
                try
                {
                    if($request->has('success') && $request->success == 'true')
                    {
                        $order_id = strtoupper(str_replace('.', '', uniqid('', true)));

                        $invoice_payment                 = new InvoicePayment();
                        $invoice_payment->order_id       = $order_id;
                        $invoice_payment->invoice_id     = $invoice->id;
                        $invoice_payment->currency       = $currentWorkspace->currency_code;
                        $invoice_payment->amount         = isset($invoice_data['price_amount']) ? $invoice_data['price_amount'] : 0;
                        $invoice_payment->payment_type   = 'Coingate';
                        $invoice_payment->receipt        = '';
                        $invoice_payment->client_id      = $user->id;
                        $invoice_payment->txn_id         = '';
                        $invoice_payment->payment_status = 'succeeded';
                        $invoice_payment->save();

                        if(($invoice->getDueAmount() - $invoice_payment->amount) == 0)
                        {
                            $invoice->status = 'paid';
                            $invoice->save();
                        }

                        $request->session()->forget('invoice_data');

                        return redirect()->route(
                            'client.invoices.show', [
                                                      $slug,
                                                      $invoice_id,
                                                  ]
                        )->with('success', __('Invoice paid Successfully!'));
                    }
                    else
                    {
                        return redirect()->route(
                            'client.invoices.show', [
                                                      $slug,
                                                      $invoice_id,
                                                  ]
                        )->with('error', __('Transaction fail'));
                    }
                }
                catch(\Exception $e)
                {
                    return redirect()->route('client.invoices.index', $slug)->with('error', __('Invoice not found!'));
                }
            }
            else
            {
                return redirect()->route(
                    'client.invoices.show', [
                                              $slug,
                                              $invoice_id,
                                          ]
                )->with('error', __('Invoice not found.'));
            }
        }
        else
        {
            return redirect()->route('client.invoices.index', $slug)->with('error', __('Invoice not found.'));
        }
    }
}
