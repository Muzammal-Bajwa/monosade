@extends('layouts.admin')

@section('page-title') {{__('Clients')}} @endsection
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mini_content">
            <div class="col-lg-6 col-md-6 col-12">
                <h3>Team Members ({{@$clients->count()}})</h3>
            </div>
            @auth('web')
              @if(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id())
            <div class="col-lg-6 col-md-6 col-12">
                <a href="#" class="right_side btn-addnew-project" data-ajax-popup="true"  data-title="{{ __('Add Client') }}" data-url="{{route('clients.create',$currentWorkspace->slug)}}"  ><i class="bx bx-plus fs-4 lh-0"></i> Add Member</a>
            </div>
            @endif
             @endauth
        </div>
        @if($currentWorkspace)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    @foreach ($clients as $client)
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="team_card">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <!-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Remove</a> -->
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md" data-title="{{__('Edit Client')}}" data-url="{{route('clients.edit',[$currentWorkspace->slug,$client->id])}}"><i class="bx bx-pencil me-1"></i> Edit</a>
                                    <a href="#" class="dropdown-item bs-pass-para"  data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="delete-form-{{$client->id}}" ><i class="bx bx-trash me-1"></i> Remove</a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['clients.destroy',[$currentWorkspace->slug,$client->id]],'id'=>'delete-form-'.$client->id]) !!}
                                           {!! Form::close() !!}
                                </div>
                            </div>
                            <img src="{{asset('public/new_assets/assets/img/bigProfil.png')}}" alt="">
                            <h4>{{ $client->name }}</h4>
                            <p>{{$client->email}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="container mt-5">
            <div class="card">
                <div class="card-body p-4">
                    <div class="page-error">
                        <div class="page-inner">
                            <h1>404</h1>
                            <div class="page-description">
                                {{ __('Page Not Found') }}
                            </div>
                            <div class="page-search">
                                <p class="text-muted mt-3">{{ __("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.")}}</p>
                                <div class="mt-3">
                                    <a class="btn-return-home badge-blue" href="{{route('home')}}"><i class="fas fa-reply"></i> {{ __('Return Home')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>


@endsection


@push('scripts')

@endpush