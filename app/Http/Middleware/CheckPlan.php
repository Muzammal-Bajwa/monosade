<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\Plan;
use App\Models\Workspace;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPlan
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check())
        {
            $user = Auth::user();
            if($user->type != 'admin')
            {
                $workspace = Workspace::find($user->currant_workspace);
                if($workspace->created_by == $user->id)
                {
                    if($user->is_trial_done < 2)
                    {
                        if($user->is_trial_done == 1 && $user->plan_expire_date < date('Y-m-d'))
                        {
                            $user->is_trial_done = 2;
                            $user->save();
                        }
                    }

                    if((empty($user->plan_expire_date) || $user->plan_expire_date < date('Y-m-d')) && $user->plan != 1)
                    {
                        $plan = Plan::find(1);
                        $user->assignPlan(1);
                        if(!empty($plan))
                        {
                            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
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
                                    'price' => 0,
                                    'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : 'usd',
                                    'txn_id' => '',
                                    'payment_type' => __('Zero Price'),
                                    'payment_status' => 'succeeded',
                                    'receipt' => null,
                                    'user_id' => $user->id,
                                ]
                            );
                        }

                        //                        $error = $user->is_trial_done ? __('Your Plan is expired.') : ($user->plan_expire_date < date('Y-m-d') ? __('Please upgrade your plan') : '');
                        //                        return redirect()->route('plans.index')->with('error', $error);
                    }
                }
            }
        }

        return $next($request);
    }
}
