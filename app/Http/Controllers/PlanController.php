<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentWorkspace = Utility::getWorkspaceBySlug('');
        $paymentSetting   = Utility::getAdminPaymentSetting();

        if(Auth::user()->type == 'admin')
        {
            $plans = Plan::get();

            return view('plans.admin', compact('plans', 'currentWorkspace', 'paymentSetting'));
        }
        elseif($currentWorkspace->creater->id == Auth::user()->id)
        {
            $plans = Plan::where('status', '1')->get();

            return view('plans.company', compact('plans', 'currentWorkspace', 'paymentSetting'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan();

        return view('plans.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation                   = [];
        $validation['name']           = 'required|unique:plans';
        $validation['monthly_price']  = 'required|numeric|min:0';
        $validation['annual_price']   = 'required|numeric|min:0';
        $validation['trial_days']     = 'required|numeric';
        $validation['max_workspaces'] = 'required|numeric';
        $validation['max_users']      = 'required|numeric';
        $validation['max_clients']    = 'required|numeric';
        $validation['max_projects']   = 'required|numeric';
        if($request->image)
        {
            $validation['image'] = 'required|image';
        }
        $validator = Validator::make(
            $request->all(), $validation
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $post = $request->all();
        if($request->monthly_price > 0 || $request->annual_price > 0)
        {
            $paymentSetting = Utility::getAdminPaymentSetting();

            if((isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on') || (isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on') || (isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on') || (isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on') || (isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on') || (isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on') || (isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on') || (isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on') || (isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on') || (isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on'))
            {
                $post['monthly_price'] = $request->monthly_price;
                $post['annual_price']  = $request->annual_price;
            }
            else
            {
                return redirect()->back()->with('error', __('Please set stripe/paypal api key & secret key for add new plan'));
            }
        }
        $post['status'] = $request->has('status') ? 1 : 0;
        if($request->image)
        {
            $avatarName = 'plan_' . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('plans', $avatarName);
            $post['image'] = $avatarName;
        }
        if(Plan::create($post))
        {
            return redirect()->back()->with('success', __('Plan created Successfully!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($planID)
    {
        $plan = Plan::find($planID);

        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function update($planID, Request $request)
    {
        $plan = Plan::find($planID);
        if($plan)
        {
            $validation         = [];
            $validation['name'] = 'required|unique:plans,name,' . $planID;
            if($plan->id != 1)
            {
                $validation['monthly_price'] = 'required|numeric|min:0';
                $validation['annual_price']  = 'required|numeric|min:0';
                $validation['trial_days']    = 'required|numeric';
            }
            $validation['max_workspaces'] = 'required|numeric';
            $validation['max_users']      = 'required|numeric';
            $validation['max_clients']    = 'required|numeric';
            $validation['max_projects']   = 'required|numeric';
            if($request->image)
            {
                $validation['image'] = 'required|image';
            }
            $validator = \Validator::make(
                $request->all(), $validation
            );

            if($validator->fails())
            {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $post = $request->all();

            if(($request->monthly_price > 0 || $request->annual_price > 0) && $plan->id != 1)
            {
                $paymentSetting = Utility::getAdminPaymentSetting();

                if(($paymentSetting['is_stripe_enabled'] == 'on' && !empty($paymentSetting['stripe_key']) && !empty($paymentSetting['stripe_secret'])) || ($paymentSetting['is_paypal_enabled'] == 'on' && !empty($paymentSetting['paypal_client_id']) && !empty($paymentSetting['paypal_secret_key'])) || ($request->monthly_price <= 0 && $request->annual_price <= 0))
                {

                    $post['monthly_price'] = $request->monthly_price;
                    $post['annual_price']  = $request->annual_price;
                }
                else
                {
                    return redirect()->back()->with('error', __('Please set payment api key & secret key for add new plan'));
                }
            }

            if($plan->id != 1)
            {
                $post['status'] = $request->has('status') ? 1 : 0;
            }

            if($request->image)
            {
                $avatarName = 'plan_' . time() . '.' . $request->image->getClientOriginalExtension();
                 $dir = 'plans/';
                 $path = Utility::upload_file($request,'image',$avatarName,$dir,[]);
                if($path['flag'] == 1)
                {
                    $image = $path['url'];
                }
                else
                {
                    return redirect()->back()->with('error', __($path['msg']));
                }
                // $request->image->storeAs('plans', $avatarName);
                $post['image'] = $avatarName;
            }
            if($plan->update($post))
            {
                return redirect()->back()->with('success', __('Plan updated Successfully!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Plan not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($planID)
    {

    }

    public function userPlan(Request $request)
    {
        $objUser = \Auth::user();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->code);
        $plan    = Plan::find($planID);
        if($plan)
        {
            if($plan->monthly_price <= 0)
            {
                $objUser->assignPlan($plan->id, 'weekly');

                return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Plan not found'));
        }
    }

    public function payment(Request $request, $frequency, $code)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug('');
        $paymentSetting   = Utility::getAdminPaymentSetting();

        $planID = \Illuminate\Support\Facades\Crypt::decrypt($code);
        $plan   = Plan::find($planID);

        if($plan)
        {
            $plan->price = (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->{$frequency . '_price'};

            return view('plans.payment', compact('plan', 'frequency', 'currentWorkspace', 'paymentSetting'));
        }
        else
        {
            return redirect()->back()->with('error', __('Plan is deleted.'));
        }
    }

    public function takeAPlanTrial(Request $request, $plan_id)
    {
        $plan = Plan::find($plan_id);
        $user = Auth::user();
        if($plan && $user->type == 'user' && $user->is_trial_done == 0)
        {
            $assignPlan = $user->assignPlan($plan->id);
            if($assignPlan['is_success'])
            {
                $days                   = $plan->trial_days == '-1' ? '36500' : $plan->trial_days;
                $user->is_trial_done    = 1;
                $user->plan             = $plan->id;
                $user->plan_expire_date = Carbon::now()->addDays($days)->isoFormat('YYYY-MM-DD');
                $user->save();

                return redirect()->route('home')->with('success', __('Your trial has been started'));
            }
            else
            {
                return redirect()->route('home')->with('error', __('Your trial can not be started'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
