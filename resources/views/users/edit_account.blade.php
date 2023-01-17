@extends('layouts.admin')

@section('page-title') {{__('User Profile')}} @endsection
@section('links')
@if(\Auth::guard('client')->check())
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
@else
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
@endif
<li class="breadcrumb-item"> {{ __('User Profile') }}</li>
@endsection
@php
$logo=\App\Models\Utility::get_file('users-avatar/');
@endphp
@section('content')
<!-- Content assets/img/my_profile.png -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="profile_bg">
                <div class="profile_card">
                    <div class="left_inner">
                        <div class="profile_icon">
                            <img @if($user->avatar) src="{{asset($logo.$user->avatar)}}" @else avatar="{{ $user->name }}" @endif id="myAvatar" alt="user-image">
                            <!-- <a href="#"><i class='bx bxs-pencil'> </i></a> -->
                        </div>
                        <span>
                            <h3> {{@$user->name}} {{@$user->last_name}} </h3>
                            <p> {{@$user->email}}</p>
                        </span>
                    </div>
                    <div class="right_inner">
                        <!-- <a href="#"><i class='bx bxs-edit' ></i> Edit Profile</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
    $workspace = $currentWorkspace ? $currentWorkspace->id : 0 ;
    $user_id = $user? $user->id:0;
    @endphp
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="setting_tabs">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3 col-lg-2 col-12" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Edit Profile</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Notifications</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Choose Plan</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Password & Security</button>
                    </div>
                    <div class="tab-content col-lg-10 col-12" id="v-pills-tabContent">
                        <div class="tab-pane fade show active edit_profile" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <h2>Edit Profile</h2>
                            <form method="post" action="@auth('web'){{route('update.account',[$workspace,$user_id])}}@elseauth{{route('client.update.account' ,[$workspace,$user_id])}}@endauth" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">First Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" id="fullname" placeholder="{{ __('Enter Your Name') }}" value="{{ $user->name }}" required autocomplete="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" id="inputPassword4">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" id="email" placeholder="{{ __('Enter Your Email Address') }}" value="{{ $user->email }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label for="inputEmail4" class="form-label">Avatar</label>
                                    <input type="file" class="form-control" name="avatar" id="inputPassword4" data-filename="avatar-logo">
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Phone Number</label>
                                    <span>
                                        <select id="inputState" name="phone_code" class="form-select">
                                            <option value="+91" @if($user->phone_code && $user->phone_code == '+91') @php echo 'selected' @endphp @endif >+91</option>
                                            <option value="+98" @if($user->phone_code && $user->phone_code == '+98') @php echo 'selected' @endphp @endif >+98</option>
                                            <option value="+1" @if($user->phone_code && $user->phone_code == '+1') @php echo 'selected' @endphp @endif >+1</option>
                                        </select>
                                        <input type="text" class="form-control" value="{{ $user->phone_no }}" name="phone_no" id="inputPassword4">
                                    </span>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade notification" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <h2>Notifications</h2>
                            <form method="post" action="{{route('workspace.settings.store',$currentWorkspace->slug)}}" class="payment-form">
                                @csrf
                                <div class="col-12">
                                    <span>ACCOUNT</span>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" checked  id="flexSwitchCheckChecked1" checked="">
                                        <label class="form-check-label" for="flexSwitchCheckChecked1">Email me when someone follows me</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox"   id="flexSwitchCheckChecked2" checked="">
                                        <label class="form-check-label" for="flexSwitchCheckChecked2">Email me when someone answers on my post</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked3">
                                        <label class="form-check-label" for="flexSwitchCheckChecked3">Email me when someone mentions me</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>PLATFORM</span>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" name="is_email_on_new_project" value="1" id="flexSwitchCheckChecked4" @if($currentWorkspace->is_email_on_new_project && $currentWorkspace->is_email_on_new_project == 1) @php echo 'checked' @endphp  @endif type="checkbox"  >
                                        <label class="form-check-label" for="flexSwitchCheckChecked4">New launches and projects</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox"   name="is_email_on_product_updates" value="1" id="flexSwitchCheckChecked5" @if($currentWorkspace->is_email_on_product_updates && $currentWorkspace->is_email_on_product_updates == 1) @php echo 'checked' @endphp  @endif>
                                        <label class="form-check-label" for="flexSwitchCheckChecked5">Monthly product updates</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" name="is_email_on_subscription"  value="1" id="flexSwitchCheckChecked6" @if($currentWorkspace->is_email_on_subscription && $currentWorkspace->is_email_on_subscription == 1) @php echo 'checked' @endphp  @endif>
                                        <label class="form-check-label" for="flexSwitchCheckChecked6">Subscribe to newsletter</label>
                                    </div>
                                </div>
                                <input type="hidden" name="email_notify" value="1" />
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade plans" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                            <h2>Choose Plan</h2>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="pl_card">
                                        <h3>₹299</h3>
                                        <h6>Professional</h6>
                                        <p>Unleash the power of automation.</p>
                                        <ul>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="pl_card">
                                        <h3>₹299</h3>
                                        <h6>Professional</h6>
                                        <p>Unleash the power of automation.</p>
                                        <ul>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="pl_card">
                                        <h3>₹299</h3>
                                        <h6>Professional</h6>
                                        <p>Unleash the power of automation.</p>
                                        <ul>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                            <li><img src="{{asset('public/new_assets/assets/img/check-circle.png')}}" alt=""> Lorem Ipsum</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                            <div class="tab-content col-lg-10 col-12" id="v-pills-tabContent">
                                <h2>{{__('Change Password')}}</h2>
                                <form method="post" action="@auth('web'){{route('update.password')}}@elseauth{{route('client.update.password')}}@endauth">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">{{ __('Old Password') }}</label>
                                        <input class="form-control @error('old_password') is-invalid @enderror" name="old_password" type="password" id="inputPassword4" autocomplete="old_password" placeholder="{{ __('Enter Old Password') }}">
                                        @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">{{ __('New Password') }}</label>
                                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required autocomplete="new-password" id="inputPassword4" placeholder="{{ __('Enter Your Password') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">{{ __('Confirm New Password') }}</label>
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" required autocomplete="new-password" id="inputPassword4" placeholder="{{ __('Enter Your Password') }}">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    @endsection
    @push('scripts')

    <script type="text/javascript">
        $('#avatar').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#myAvatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
    </script>
    <script>
        $(document).on('click', '.nav-link', function() {
            $('.nav-link').removeClass('active');
            $('.nav-link').removeClass('text-primary');
            setTimeout(() => {
                $(this).addClass('active').removeClass('text-primary');
            }, 10);
        });

        var type = window.location.hash.substr(1);
        $('.nav-link').removeClass('active');
        $('.nav-link').removeClass('text-primary');
        if (type != '') {
            $('a[href="#' + type + '"]').addClass('active').removeClass('text-primary');
        } else {
            $('.nav-link:eq(0)').addClass('active').removeClass('text-primary');
        }




        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    @endpush