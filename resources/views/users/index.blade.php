@extends('layouts.admin')

@section('page-title') {{__('Clients')}} @endsection
@section('content')
@php
$logo=\App\Models\Utility::get_file('users-avatar/');
@endphp
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mini_content">
            <div class="col-lg-6 col-md-6 col-12">
                <h3>Users ({{@$users->count()}}) </h3>
            </div>
            @auth('web')
            <div class="col-lg-6 col-md-6 col-12">
                @if(Auth::user()->type == 'admin')

                <a href="{{route('user.export')}}" class="right_side btn-addnew-project" data-toggle="tooltip" title="{{ __('Export')}}">
                    <i class="ti ti-file-x"></i>{{ __('Export')}}
                </a>
                <a href="#" class="right_side btn-addnew-project " data-ajax-popup="true" data-size="md" data-title="{{ __('Add User') }}" data-url="{{route('user.file.import')}}" data-toggle="tooltip" title="{{ __('Import') }}">
                    <i class="ti ti-file-import"></i>
                </a>

                <a href="#" class="right_side btn-addnew-project" data-ajax-popup="true" data-size="md" data-title="{{ __('Add User') }}" data-url="{{route('users.create')}}" data-toggle="tooltip" title="{{ __('Add User') }}">
                    <i class="bx bx-plus fs-4 lh-0"></i>{{ __('Add User') }}
                </a>
                @elseif(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id())
                <a href="#" class="right_side btn-addnew-project" data-ajax-popup="true" data-size="md" data-title="{{ __('Invite') }}" data-url="{{route('users.invite',$currentWorkspace->slug)}}" data-toggle="tooltip" title="{{ __('Invite') }}">
                    <i class="bx bx-plus fs-4 lh-0"></i>{{ __('Invite') }}
                </a>
                @endif
                @endauth
            </div>
        </div>
        @if($currentWorkspace || Auth::user()->type == 'admin')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    @foreach ($users as $user)
                    @php($workspace_id = (isset($currentWorkspace) && $currentWorkspace) ? $currentWorkspace->id : '')
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="team_card">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                           @if(Auth::user()->type == 'admin' && isset($user->getPlan))
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{__('Change Plan')}}" data-url="{{route('users.change.plan',$user->id)}}"><i class="ti ti-exchange"></i>
                                                <span>{{__('Change Plan')}}</span></a>
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md" data-title="{{__('Reset Password')}}" data-url="{{route('users.reset.password',$user->id)}}"><i class="ti ti-pencil"></i><span>{{__('Reset Password')}}</span></a>

                                            <a href="#" class="dropdown-item bs-pass-para " data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="delete_user_{{$user->id}}"><i class="ti ti-trash"></i><span>{{__('Delete')}}</span></a>
                                            <form action="{{route('users.delete',$user->id)}}" method="post" id="delete_user_{{$user->id}}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @elseif(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->permission == 'Owner' && Auth::user()->id != $user->id)
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md" data-title="{{ __('Edit User') }}" data-url="{{route('users.edit',[$currentWorkspace->slug,$user->id])}}"><i class="ti ti-edit"></i> <span>{{ __('Edit') }}</span></a>

                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md" data-title="{{__('Reset Password')}}" data-url="{{route('users.reset.password',$user->id)}}"><i class="ti ti-pencil"></i> <span>{{ __('Reset Password') }}</span></a>

                                            <a href="#" class="dropdown-item text-danger bs-pass-para" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="remove_user_{{$user->id}}"><i class="ti ti-trash"></i> <span>{{ __('Delete') }}</span></a>
                                            <form action="{{route('users.remove',[$currentWorkspace->slug,$user->id])}}" method="post" id="remove_user_{{$user->id}}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
                                </div>
                            </div>
                                <div class="avatar">
                                    <img alt="user-image" class=" " @if($user->avatar) src="{{asset($logo.$user->avatar)}}" @else avatar="{{ $user->name }}" @endif>
                                </div>
                                <h4 class="mt-2">{{ $user->name }}</h4>
                                <small>{{$user->email}}</small>

                                <div class=" mb-0 mt-3">
                                    <div class=" p-3">
                                        <div class="row px-2">
                                            @if(Auth::user()->type == 'admin')
                                            <div class="col-6 text-start">

                                                <h6 class="mb-0 px-3">{{ $user->countWorkspace() }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Workspaces') }}</p>
                                            </div>
                                            <div class="col-6 {{Auth::user()->type == 'admin' ? 'text-end' : 'text-start' }}  ">
                                                <h6 class="mb-0 px-3">{{ $user->countUsers($workspace_id) }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Users') }}</p>
                                            </div>
                                            <div class="col-6 text-start mt-2">
                                                <h6 class="mb-0 px-3">{{ $user->countClients($workspace_id) }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Clients') }}</p>
                                            </div>
                                            @endif

                                            <div class="col-6  {{Auth::user()->type == 'admin' ? 'text-end mt-2' : 'text-start' }} ">
                                                <h6 class="mb-0 px-3">{{ $user->countProject($workspace_id) }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Projects') }}</p>
                                            </div>
                                            @if(Auth::user()->type != 'admin')
                                            <div class="col-6 text-end">
                                                <h6 class="mb-0 px-3">{{ $user->countTask($workspace_id) }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Tasks') }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-2 mb-0">
                                    @if(Auth::user()->type == 'admin' && isset($user->getPlan))
                                    <button class="btn btn-sm btn-neutral mt-3 font-weight-500">
                                        @if(!empty($user->plan_expire_date))
                                        <a>{{ $user->is_trial_done == 1 ? __('Plan Trial') : __('Plan') }} {{ $user->plan_expire_date < date('Y-m-d') ? __('Expired') : __('Expires') }} {{__(' on ')}} {{ (date('d M Y',strtotime($user->plan_expire_date))) }}</a>
                                        @else
                                        <a>{{__('Unlimited')}}</a>
                                        @endif
                                    </button>
                                    @endif
                                </p>
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