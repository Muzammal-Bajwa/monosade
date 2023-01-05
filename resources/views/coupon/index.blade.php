@extends('layouts.admin')

@section('page-title') {{__('Coupons')}} @endsection
@section('links')
@if(\Auth::guard('client')->check())
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
 @else
 <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
 @endif
<li class="breadcrumb-item"> {{ __('Coupon') }}</li>
@endsection
@section('action-button')
    <a href="#" class="btn btn-sm btn-primary" data-toggle="tooltip" title="{{__('Add Coupon')}}" data-ajax-popup="true" data-size="lg" data-title="{{ __('Add Coupon') }}" data-url="{{route('coupons.create')}}">
        <i class="ti ti-plus"></i>
    </a>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead>
                            <tr>
                                <th> {{__('Name')}}</th>
                                <th> {{__('Code')}}</th>
                                <th> {{__('Discount (%)')}}</th>
                                <th> {{__('Limit')}}</th>
                                <th> {{__('Used')}}</th>
                                <th> {{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>{{ $coupon->used_coupon() }}</td>
                                    <td>
                                        <a href="{{ route('coupons.show',$coupon->id) }}" class="action-btn btn-warning  btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" title="{{__('Show')}}">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn btn-info  btn btn-sm d-inline-flex align-items-center" data-url="{{ route('coupons.edit',$coupon->id) }}" data-toggle="tooltip" title="{{__('Edit')}}"     data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Coupon')}}">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <a href="#" class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center bs-pass-para" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="delete-form-{{$coupon->id}}" data-toggle="tooltip" title="{{__('Delete')}}"            >
                                            <i class="ti ti-trash"></i>
                                        </a>




                                        {!! Form::open(['method' => 'DELETE', 'route' => ['coupons.destroy',$coupon->id],'id'=>'delete-form-'.$coupon->id]) !!}
                                        {!! Form::close() !!}
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

@push('css-page')
@endpush
@push('scripts')
    <script>
        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
@endpush
