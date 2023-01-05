@extends('layouts.admin')

@section('page-title')
    {{ __('Plans') }}
@endsection
@section('links')
    @if (\Auth::guard('client')->check())
        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">{{ __('Home') }}</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    @endif
    <li class="breadcrumb-item"> {{ __('plans') }}</li>
@endsection

@section('action-button')
    @if (Auth::user()->type == 'admin')
        <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="{{ __('Add Plan') }}"
            data-toggle="tooltip" title="{{ __('Add Plan') }}" data-url="{{ route('plans.create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endif
@endsection
<style type="text/css">
    .price-card .p-price {
        font-size: 44px !important;
    }

</style>
@section('content')
    <div class="row">
        @foreach ($plans as $key => $plan)
            <div class="col-lg-3">

                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body">
                        <div class="text-end">
                            @if ((isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on') || (isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on') || (isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on') || (isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on') || (isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on') || (isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on') || (isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on') || (isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on') || (isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on') || (isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on'))
                                <span class="btn btn-sm btn-primary">
                                    <a href="#" class="" data-url="{{ route('plans.edit', $plan->id) }}"
                                        data-ajax-popup="true" data-title="{{ __('Edit Plan') }}" data-toggle="tooltip"
                                        data-size="lg" title="{{ __('Edit') }}">
                                        <span class=""> <i class="ti ti-pencil text-white"></i></span>

                                    </a></span>
                            @endif
                        </div>

                        <span class="price-badge bg-primary"> {{ $plan->name }}</span>

                        <span
                            class="mb-4 f-w-600 p-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->monthly_price }}
                            <small class="text-sm">/{{ __('Monthly Price') }}</small></span><br>
                        <span
                            class="mb-4 f-w-600 p-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->annual_price }}
                            <small class="text-sm">/{{ __('Annual Price') }}</small></span>

                        <p class="mb-0">
                            {{ $plan->description }}
                        </p>
                        <ul class="list-unstyled my-5">
                            @if ($plan->id != 1)
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>

                                    {{ $plan->trial_days < 0 ? __('Unlimited') : $plan->trial_days }}
                                    {{ __('Trial Days') }}

                                </li>
                            @endif
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->max_workspaces < 0 ? __('Unlimited') : $plan->max_workspaces }}
                                {{ __('Workspaces') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->max_users < 0 ? __('Unlimited') : $plan->max_users }}
                                {{ __('Users Per Workspace') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->max_clients < 0 ? __('Unlimited') : $plan->max_clients }}
                                {{ __('Clients Per Workspace') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->max_projects < 0 ? __('Unlimited') : $plan->max_projects }}
                                {{ __('Projects Per Workspace') }}
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
