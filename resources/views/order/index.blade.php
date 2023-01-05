@extends('layouts.admin')

@section('page-title') {{__('Orders')}} @endsection
@section('links')
@if(\Auth::guard('client')->check())   
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
 @else
 <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
 @endif
<li class="breadcrumb-item"> {{ __('Orders') }}</li>
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('Order Id')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Plan Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Payment Type')}}</th>
                                <th>{{__('Coupon')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Invoice')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $order)
                                @php($color = ($order->payment_status == 'succeeded' || $order->payment_status == 'approved') ? 'success' : 'danger')
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{$order->user_name}}</td>
                                    <td>{{$order->plan_name}}</td>
                                    <td>{{env('CURRENCY_SYMBOL')}}{{number_format($order->price)}}</td>
                                    <td><i class="fas fa-circle text-{{ $color }}"></i> {{__(ucfirst($order->payment_status))}}</td>
                                    <td>{{ __($order->payment_type) }}</td>
                                    <td>{{ !empty($order->appliedCoupon->coupon_detail) ? (!empty($order->appliedCoupon->coupon_detail->code) ? $order->appliedCoupon->coupon_detail->code : '') : '' }}</td>
                                    <td>{{App\Models\Utility::dateFormat($order->created_at)}}</td>
                                    <td class="Id sorting_1">
                                        @if(!empty($order->receipt))
                                            <a href="{{$order->receipt}}" target="_blank">
                                                <i class="fas fa-print mr-1"></i> {{__('Invoice')}}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
