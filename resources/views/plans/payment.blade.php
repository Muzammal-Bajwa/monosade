@extends('layouts.admin')

@section('page-title') 
{{__('Plan Payment')}} 
@endsection


@section('links')
@if(\Auth::guard('client')->check())
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
 @else
 <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
 @endif
<li class="breadcrumb-item"><a href="{{route('plans.index')}}"> {{ __('plans') }}</a></li>
<li class="breadcrumb-item"> {{ __('Plan Payment') }}</li>
@endsection

@section('content')


      <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xl-3">
                        <div class=" sticky-top" style="top:30px">
                            <div class="list-group list-group-flush card" id="useradd-sidenav">
                            @if(isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on')
                                 <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{ __('Stripe') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                              
                            @endif
                            @if(isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on')
                                 <a href="#paypal-billing" class="list-group-item list-group-item-action border-0">{{ __('Paypal') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on')
                                <a href="#paystack-billing" class="list-group-item list-group-item-action border-0">{{ __('Paystack') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                
                            @endif
                            @if(isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on')
                            <a href="#flutterwave-billing" class="list-group-item list-group-item-action border-0">{{ __('Flutterwave') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                               
                            @endif
                            @if(isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on')
                            <a href="#razorpay-billing" class="list-group-item list-group-item-action border-0">{{ __('Razorpay') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on')
                            <a href="#paytm-billing" class="list-group-item list-group-item-action border-0">{{ __('Paytm') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on')
                            <a href="#mercado-billing" class="list-group-item list-group-item-action border-0">{{ __('Mercado') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on')
                             <a href="#mollie-billing" class="list-group-item list-group-item-action border-0">{{ __('Mollie') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on')
                            <a href="#skrill-billing" class="list-group-item list-group-item-action border-0">{{ __('Skrill') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on')
                            <a href="#coingate-billing" class="list-group-item list-group-item-action border-0">{{ __('Coingate') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if(isset($paymentSetting['is_paymentwall_enabled']) && $paymentSetting['is_paymentwall_enabled'] == 'on')
                            <a href="#paymentwall_payment" class="list-group-item list-group-item-action border-0">{{ __('Paymentwall') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif                            </div>
                        

                            

                     <div class="mt-5">
                            <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
                                                                        visibility: visible;
                                                                        animation-delay: 0.2s;
                                                                        animation-name: fadeInUp;
                                                                      ">
                                <div class="card-body">
                                    <span class="price-badge bg-primary">{{$plan->name }}</span>
                                        
                                    <div class="text-end">
                                        <div class="">
                                                                                    </div>
                                    </div>

                                        <h3 class="mb-4 f-w-600  ">
                                          {{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->monthly_price}} <small class="text-sm">/{{ __('Monthly Price') }}</small>
                                        </h3>
                                        <p class="mb-0">
                                            @if($plan->id != 1)
                                             {{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }} {{__('Trial Days')}}
                                             @endif
                        
                                            <ul class="list-unstyled my-2">
                                            <li>
                                                <span class="theme-avtar">
                                                <i class="text-primary ti ti-circle-plus"></i></span>
                                                 {{ ($plan->max_workspaces < 0)?__('Unlimited'):$plan->max_workspaces }} {{__('Workspaces')}}
                                            </li>
                                            <li>
                                                <span class="theme-avtar">
                                                <i class="text-primary ti ti-circle-plus"></i></span>
                                                {{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} {{__('Users Per Workspace')}}
                                            </li>
                                            <li>
                                                <span class="theme-avtar">
                                                <i class="text-primary ti ti-circle-plus"></i></span>
                                                {{ ($plan->max_clients < 0)?__('Unlimited'):$plan->max_clients }} {{__('Clients Per Workspace')}}
                                            </li>
                                            <li>
                                                <span class="theme-avtar">
                                                <i class="text-primary ti ti-circle-plus"></i></span>
                                                {{ ($plan->max_projects < 0)?__('Unlimited'):$plan->max_projects }} {{__('Projects Per Workspace')}}
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>



                        </div>
                    </div>
                    <div class="col-xl-9">
                         @if(isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on')
                            <div id="useradd-2" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Stripe') }}</h5>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="" id="stripe-payment-form">
                                     @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" name="stripe_payment_frequency" class="form-check-input input-primary payment_frequency" data-from="stripe" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="" 
                                                        id="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" name="stripe_payment_frequency"  data-from="stripe" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off" class="form-check-input input-primary payment_frequency"
                                                        id="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                             <div class="row">
                                        <div class="col-lg-3">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                          <input type="radio" class="form-check-input input-primary" name="payment_type" id="one_time_type" value="one-time" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"></strong> {{ __('One Time') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                         <input type="radio" class="form-check-input input-primary" name="payment_type" id="recurring_type" value="recurring" autocomplete="off">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"></strong> {{ __('Reccuring') }}</span>
                                                           
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                            <input type="text" id="stripe_coupon" name="coupon" class="form-control coupon" data-from="stripe" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="stripe">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                        <button class="btn  btn-primary" type="submit" id="pay_with_stripe">
                                            {{__('Checkout')}} (<span class="coupon-stripe">{{ $plan->price }}</span>)
                                        </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif

                          @if(isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on')
                              <div id="paypal-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Paypal') }}</h5>
                                </div>
                                <div class="card-body">
                                      <form role="form" action="{{ route('plan.pay.with.paypal') }}" method="post" class="" id="paypal-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency"  name="paypal_payment_frequency" data-from="paypal" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" name="paypal_payment_frequency" class="form-check-input input-primary payment_frequency" data-from="paypal" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                            
                                              <input type="text" id="paypal_coupon" name="coupon" class="form-control coupon" data-from="paypal" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="paypal">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                         <button class="btn btn-primary" type="submit" id="pay_with_paypal">
                                         {{__('Checkout')}} (<span class="coupon-paypal">{{ $plan->price }}</span>)
                                        </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif



                             @if(isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on')
                               <div id="paystack-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Paystack') }}</h5>
                                </div>
                                <div class="card-body">
                                       <form role="form" action="{{ route('plan.pay.with.paystack') }}" method="post" class="" id="paystack-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency"   name="paystack_payment_frequency"  data-from="paystack" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency" name="paystack_payment_frequency"data-from="paystack" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                               <input type="text" id="paystack_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="paystack">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                      
                                           <button class="btn btn-primary" type="button" id="pay_with_paystack">
                                           {{__('Checkout')}} (<span class="coupon-paystack">{{ $plan->price }}</span>)
                                           </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif


                          @if(isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on')
                               <div id="flutterwave-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Flutterwave') }}</h5>
                                </div>
                                <div class="card-body">
                                       <form role="form" action="{{ route('plan.pay.with.flaterwave') }}" method="post" class="" id="flaterwave-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary flaterwave_frequency payment_frequency"   name="flaterwave_payment_frequency"  data-from="flaterwave" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency flaterwave_frequency"  name="flaterwave_payment_frequency"  data-from="flaterwave" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                               <input type="text" id="flaterwave_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="flaterwave">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                      
                                         

                                           <button class="btn btn-primary" type="button" id="pay_with_flaterwave">
                                            {{__('Checkout')}} (<span class="coupon-flaterwave">{{ $plan->price }}</span>)
                                            </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif



                         @if(isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on')
                               <div id="razorpay-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Razorpay') }}</h5>
                                </div>
                                <div class="card-body">
                                       <form role="form" action="{{ route('plan.pay.with.razorpay') }}" method="post" class="" id="razorpay-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency razorpay_frequency"   name="razorpay_payment_frequency"  data-from="razorpay" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary razorpay_frequency payment_frequency" name="razorpay_payment_frequency"  data-from="razorpay" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                               <input type="text" id="razorpay_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="razorpay">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">

                                           <button class="btn btn-primary" type="button" id="pay_with_razorpay">
                                                        {{__('Checkout')}} (<span class="coupon-razorpay">{{ $plan->price }}</span>)
                                                    </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif

                 @if(isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on')
                               <div id="paytm-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Paytm') }}</h5>
                                </div>
                                <div class="card-body">
                                        <form role="form" action="{{ route('plan.pay.with.paytm') }}" method="post" class="" id="paytm-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary paytm_frequency payment_frequency" name="paytm_payment_frequency"  data-from="paytm" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency paytm_frequency"  name="paytm_payment_frequency"  data-from="paytm" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">

                                               <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">{{__('Mobile Number')}}</label>
                                                <input type="text" id="mobile" name="mobile" class="form-control mobile" data-from="mobile" placeholder="{{ __('Enter Mobile Number') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                               <input type="text" id="paytm_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="paytm">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">

                                             <button class="btn btn-primary" type="submit" id="pay_with_paytm">
                                             {{__('Checkout')}} (<span class="coupon-paytm">{{ $plan->price }}</span>)
                                            </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif



                               @if(isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on')
                               <div id="mercado-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Mercado') }}</h5>
                                </div>
                                <div class="card-body">
                                       <form role="form" action="{{ route('plan.pay.with.mercado') }}" method="post" class="" id="mercado-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency mercado_frequency" name="mercado_payment_frequency" data-from="mercado" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency mercado_frequency"  name="mercado_payment_frequency" data-from="mercado" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                               <input type="text" id="mercado_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="mercado">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">

                                           <button class="btn btn-primary" type="submit" id="pay_with_paytm">
                                                        {{__('Checkout')}} (<span class="coupon-mercado">{{ $plan->price }}</span>)
                                          </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif


                           @if(isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on')
                               <div id="mollie-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Mollie') }}</h5>
                                </div>
                                <div class="card-body">
                                      <form role="form" action="{{ route('plan.pay.with.mollie') }}" method="post" class="" id="mollie-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary mollie_frequency payment_frequency" name="mollie_payment_frequency" data-from="mollie" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency mollie_frequency"  name="mollie_payment_frequency" data-from="mollie" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                               <input type="text" id="mollie_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="mollie">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                      
                                          

                                           <button class="btn btn-primary" type="submit" id="pay_with_mollie">
                                                        {{__('Checkout')}} (<span class="coupon-mollie">{{ $plan->price }}</span>)
                                                    </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif



                    @if(isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on')
                               <div id="skrill-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Skrill') }}</h5>
                                </div>
                                <div class="card-body">
                                       <form role="form" action="{{ route('plan.pay.with.skrill') }}" method="post" class="" id="skrill-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency skrill_frequency"   name="skrill_payment_frequency" data-from="skrill" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency skrill_frequency"  name="skrill_payment_frequency" data-from="skrill" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                                 <input type="text" id="skrill_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="skrill">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">

                                     @php
                                                $skrill_data = [
                                                    'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                    'user_id' => 'user_id',
                                                    'amount' => 'amount',
                                                    'currency' => 'currency',
                                                ];
                                                session()->put('skrill_data', $skrill_data);
                                            @endphp
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">

                                           <button class="btn btn-primary" type="submit" id="pay_with_skrill">
                                                        {{__('Checkout')}} (<span class="coupon-skrill">{{ $plan->price }}</span>)
                                                    </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif




                   @if(isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on')
                               <div id="coingate-billing" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Coingate') }}</h5>
                                </div>
                                <div class="card-body">
                                      <form role="form" action="{{ route('plan.pay.with.coingate') }}" method="post" class="" id="coingate-payment-form">
                                        @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency coingate_frequency"  name="coingate_payment_frequency" data-from="coingate" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency coingate_frequency" name="coingate_payment_frequency"  data-from="coingate" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                                <input type="text" id="coingate_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="coingate">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary" type="submit" id="pay_with_coingate">
                                             {{__('Checkout')}} (<span class="coupon-coingate">{{ $plan->price }}</span>)
                                            </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif



                  @if(isset($paymentSetting['is_paymentwall_enabled']) && $paymentSetting['is_paymentwall_enabled'] == 'on')
                               <div id="paymentwall_payment" class="card">
                                <div class="card-header">
                                    <h5>{{ __('Paymentwall') }}</h5>
                                </div>
                                <div class="card-body">
                                        <form role="form" action="{{ route('paymentwall') }}" method="post" class="" id="coingate-payment-form">
                                            @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary coingate_frequency payment_frequency"name="paymentwall_payment_frequency" data-from="coingate" value="monthly" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}" autocomplete="off" checked="">
                                                    <label class="form-check-label d-block" for="">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                                    class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->monthly_price }}</strong>{{ __('Monthly Payments') }}
                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border card p-3">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input input-primary payment_frequency coingate_frequency" name="paymentwall_payment_frequency" data-from="coingate" value="annual" data-price="{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}" autocomplete="off">
                                                        <span>
                                                            <span class="h5 d-block"><strong
                                                            class="float-end"> {{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->annual_price }}</strong>{{ __('Annual Payments') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mt-1">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label class="form-label">Coupon Code</label>
                                                <input type="text" id="paymentwall_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-4">
                                            <a href="#" class="btn  btn-primary apply-coupon" data-from="paymentwall">{{ __('Apply') }}</a>
                                        </div>
                                    </div>
                                <div class="row mt-3">
                                <div class="col-sm-12">
                                   
                                    <div class="float-end">
                                        <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                      
                                      

                                            <button class="btn btn-primary" type="submit" id="pay_with_paymentwall">
                                                            {{__('Checkout')}} (<span class="coupon-coingate">{{ $plan->price }}</span>)
                                                        </button>
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div> 
            @endif

                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('.nav-tabs li a').first().trigger('click');
            }, 100);

            var type = window.location.hash.substr(1);
            $('.list-group-item').removeClass('active');
            $('.list-group-item').removeClass('text-primary');
            if (type != '') {
                $('a[href="#' + type + '"]').addClass('active').removeClass('text-primary');
            } else {
                $('.list-group-item:eq(0)').addClass('active').removeClass('text-primary');
            }
        });
            $(document).on('click', '.list-group-item', function() {
                $('.list-group-item').removeClass('active');
                $('.list-group-item').removeClass('text-primary');
                setTimeout(() => {
                    $(this).addClass('active').removeClass('text-primary');
                }, 10);
            });
    </script>
    <script src="{{url('assets/custom/js/jquery.form.js')}}"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


   @if(!empty($paymentSetting['is_stripe_enabled']) && isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on')
    <?php $stripe_session = \Session::get('stripe_session');?>

    <?php if(isset($stripe_session) && $stripe_session): ?>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe('{{ $paymentSetting['stripe_key'] }}');
        stripe.redirectToCheckout({
            sessionId: '{{ $stripe_session->id }}',
        }).then((result) => {
        });
    </script>
    <?php endif ?>
    @endif


    <script type="text/javascript">
        $(document).on('change', '.payment_frequency', function (e) {
            var price = $(this).attr('data-price');
            var where = $(this).attr('data-from');
            $('.coupon-' + where).text(price);

            if ($('#' + where + '_coupon').val() != null && $('#' + where + '_coupon').val() != '') {
                applyCoupon($('#' + where + '_coupon').val(), where);
            }
        });

        // Apply Coupon
        $(document).on('click', '.apply-coupon', function (e) {

            e.preventDefault();

            var ele = $(this);
            var coupon = $('#' + ele.attr('data-from') + '_coupon').val();

            applyCoupon(coupon, ele.attr('data-from'));
        });

        function applyCoupon(coupon_code, where) {
            if (coupon_code != null && coupon_code != '') {
                $.ajax({
                    url: '{{route('apply.coupon')}}',
                    datType: 'json',
                    data: {
                        plan_id: '{{ $plan->id }}',
                        coupon: coupon_code,
                        frequency: $('input[name="' + where + '_payment_frequency"]:checked').val()
                    },
                    success: function (data) {
                        if (data.is_success) {
                            $('.coupon-' + where).text(data.final_price);
                        } else {
                            $('.final-price').text(data.final_price);
                            show_toastr('Error', data.message, 'error');
                        }
                    }
                })
            } else {
                show_toastr('Error', '{{__('Invalid Coupon Code.')}}', 'error');
            }
        }
        
        @if(!empty($paymentSetting['is_paystack_enabled']) && isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on')
        
        // Paystack Payment
        $(document).on("click", "#pay_with_paystack", function () {
            $('#paystack-payment-form').ajaxForm(function (res) {
                if (res.flag == 1) {
                    var coupon_id = res.coupon;

                    var paystack_callback = "{{ url('/plan/paystack') }}";
                    var order_id = '{{time()}}';
                    var handler = PaystackPop.setup({
                        key: '{{ $paymentSetting['paystack_public_key']  }}',
                        email: res.email,
                        amount: res.total_price * 100,
                        currency: res.currency,
                        ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                            1
                        ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                        metadata: {
                            custom_fields: [{
                                display_name: "Email",
                                variable_name: "email",
                                value: res.email,
                            }]
                        },

                        callback: function (response) {
                            console.log(response.reference, order_id);
                            window.location.href = paystack_callback + '/' + response.reference + '/' + '{{encrypt($plan->id)}}' + '?coupon_id=' + coupon_id + '&payment_frequency=' + res.payment_frequency
                        },
                        onClose: function () {
                            alert('window closed');
                        }
                    });
                    handler.openIframe();
                } else if (res.flag == 2) {

                } else {
                    show_toastr('Error', data.message, 'msg');
                }

            }).submit();
        });
        @endif

        @if(!empty($paymentSetting['is_flutterwave_enabled']) && isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on')
       
        // Flaterwave Payment
        $(document).on("click", "#pay_with_flaterwave", function () {
            $('#flaterwave-payment-form').ajaxForm(function (res) {
                if (res.flag == 1) {
                    var coupon_id = res.coupon;

                    var API_publicKey = '{{ $paymentSetting['flutterwave_public_key']  }}';
                    var nowTim = "{{ date('d-m-Y-h-i-a') }}";
                    var flutter_callback = "{{ url('/plan/flaterwave') }}";
                    var x = getpaidSetup({
                        PBFPubKey: API_publicKey,
                        customer_email: '{{Auth::user()->email}}',
                        amount: res.total_price,
                        currency: res.currency,
                        txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) + 'fluttpay_online-' +
                            {{ date('Y-m-d') }},
                        meta: [{
                            metaname: "payment_id",
                            metavalue: "id"
                        }],
                        onclose: function () {
                        },
                        callback: function (response) {
                            var txref = response.tx.txRef;
                            if (
                                response.tx.chargeResponseCode == "00" ||
                                response.tx.chargeResponseCode == "0"
                            ) {
                                window.location.href = flutter_callback + '/' + txref + '/' + '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}?coupon_id=' + coupon_id + '&payment_frequency=' + res.payment_frequency;
                            } else {
                                // redirect to a failure page.
                            }
                            x.close(); // use this to close the modal immediately after payment.
                        }
                    });
                } else if (res.flag == 2) {

                } else {
                    show_toastr('Error', data.message, 'msg');
                }

            }).submit();
        });
        @endif
        
         @if(!empty($paymentSetting['is_razorpay_enabled']) && isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on')
        // Razorpay Payment
        $(document).on("click", "#pay_with_razorpay", function () {
            $('#razorpay-payment-form').ajaxForm(function (res) {
                if (res.flag == 1) {
                    var razorPay_callback = '{{url('/plan/razorpay')}}';
                    var totalAmount = res.total_price * 100;
                    var coupon_id = res.coupon;
                    var options = {
                        "key": "{{ $paymentSetting['razorpay_public_key']  }}", // your Razorpay Key Id
                        "amount": totalAmount,
                        "name": 'Plan',
                        "currency": res.currency,
                        "description": "",
                        "handler": function (response) {
                            window.location.href = razorPay_callback + '/' + response.razorpay_payment_id + '/' + '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}?coupon_id=' + coupon_id + '&payment_frequency=' + res.payment_frequency;
                        },
                        "theme": {
                            "color": "#528FF0"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                } else if (res.flag == 2) {

                } else {
                    show_toastr('Error', data.message, 'msg');
                }

            }).submit();
        });
        @endif
    </script>

    <script>
         $(document).on('click', '.list-group-item', function() {
                $('.list-group-item').removeClass('active');
                $('.list-group-item').removeClass('text-primary');
                setTimeout(() => {
                    $(this).addClass('active').removeClass('text-primary');
                }, 10);
            });

                   var type = window.location.hash.substr(1);
            $('.list-group-item').removeClass('active');
            $('.list-group-item').removeClass('text-primary');
            if (type != '') {
                $('a[href="#' + type + '"]').addClass('active').removeClass('text-primary');
            } else {
                $('.list-group-item:eq(0)').addClass('active').removeClass('text-primary');
            }
      
                 


       var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
@endpush
