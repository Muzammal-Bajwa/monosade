@extends('layouts.admin')
 @php

 $logo=\App\Models\Utility::get_file('logo/');
        if(Auth::user()->type == 'admin')
        {
        $setting = App\Models\Utility::getAdminPaymentSettings();
            if ($setting['color']) {
                $color = $setting['color'];
            }
            else{
            $color = 'theme-3';
            }
            $dark_mode = $setting['cust_darklayout'];
            $cust_theme_bg =$setting['cust_theme_bg'];
            $SITE_RTL = env('SITE_RTL');
        }
        else { 
            $setting = App\Models\Utility::getcompanySettings($currentWorkspace->id);
            $color = $setting->theme_color;
            $dark_mode = $setting->cust_darklayout; 
            $SITE_RTL = $setting->site_rtl;
            $cust_theme_bg = $setting->cust_theme_bg;
        }

           if($color == '' || $color == null){
              $settings = App\Models\Utility::getAdminPaymentSettings();
              $color = $settings['color'];           
           }

           if($dark_mode == '' || $dark_mode == null){
              $dark_mode = $settings['cust_darklayout'];
           }

           if($cust_theme_bg == '' || $dark_mode == null){
              $cust_theme_bg = $settings['cust_theme_bg'];
           }

            if($SITE_RTL == '' || $SITE_RTL == null){
              $SITE_RTL = env('SITE_RTL');
           }
      @endphp



@section('page-title', __('Settings'))
@section('links')
@if(\Auth::guard('client')->check())   
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
 @else
 <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
 @endif
<li class="breadcrumb-item"> {{ __('Settings') }}</li>
@endsection
<style type="text/css">
    .row > * {
    flex-shrink: 0;
    /* width: 100%; */
    width: none !important;
    max-width: 100% !important;
    padding-right: calc(var(--bs-gutter-x) * .5);
    padding-left: calc(var(--bs-gutter-x) * .5);
    margin-top: var(--bs-gutter-y);
    /* width: auto; */
}
</style>
@section('content')
<div class="row mb-5">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="profile_bg">
            <div class="profile_card">
                <div class="left_inner">
                    <div class="profile_icon">
                        <img src="assets/img/my_profile.png" alt="">
                        <a href="#"><i class='bx bxs-pencil'></i></a>
                    </div>
                    <span>
                        <h3>{{auth()->user()->name}}</h3>
                        <p>{{auth()->user()->email}}</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $workspace = $currentWorkspace ? $currentWorkspace->id : 0 ;
    auth()->user();
@endphp
    <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xl-12">
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
                                            <form class="row g-3" method="post" action="@auth('web'){{route('update.account',[$workspace,auth()->user()->id])}}@elseauth{{route('client.update.account' ,[$workspace,auth()->user()->id])}}@endauth">
                                            @csrf   
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">First Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" id="fullname" value="{{ auth()->user()->name }}" required autocomplete="name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Last Name</label>
                                                    <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Phone Number</label>
                                                    <span>
                                                    <select id="inputState" class="form-select">
                                                        <option selected>+91</option>
                                                        <option>+98</option>
                                                        <option>+1</option>
                                                    </select>
                                                        <input type="text" class="form-control" value="{{ auth()->user()->phone_no }}" name="phone_no" id="inputPassword4">
                                                    </span>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade notification" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                            <h2>Notifications</h2>
                                            <form class="row g-3">
                                                <div class="col-12">
                                                    <span>ACCOUNT</span>
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked1" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked1">Email me when someone follows me</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked2" checked="">
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
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked4">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked4">New launches and projects</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked5">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked5">Monthly product updates</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked6" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked6">Subscribe to newsletter</label>
                                                    </div>
                                                </div>
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
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="pl_card">
                                                        <h3>₹299</h3>
                                                        <h6>Professional</h6>
                                                        <p>Unleash the power of automation.</p>
                                                        <ul>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="pl_card">
                                                        <h3>₹299</h3>
                                                        <h6>Professional</h6>
                                                        <p>Unleash the power of automation.</p>
                                                        <ul>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                            <li><img src="assets/img/check-circle.png" alt=""> Lorem Ipsum</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                                            <div class="tab-pane fade show active edit_profile" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                                                <h2>Edit Profile</h2>
                                                <form class="row g-3" method="post" action="@auth('web'){{route('update.password',[$workspace,auth()->user()->id])}}@elseauth{{route('client.update.account' ,[$workspace,auth()->user()->id])}}@endauth">
                                                    @csrf   
                                                    <div class="col-md-6">
                                                        <label for="inputEmail4" class="form-label">Current Password</label>
                                                        <input class="form-control" name="old_password" type="password" id="fullname"  required autocomplete="name">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">New Password</label>
                                                        <input type="password" name="password"  class="form-control" id="inputPassword4">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEmail4" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" name="password_confirmation"  id="inputEmail4">
                                                    </div>
                                                    <div class="col-12">
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
                       
                        <!-- <div id="workspace-settings" class="">
                            {{Form::open(array('route'=>['workspace.settings.store', $currentWorkspace->slug],'method'=>'post', 'enctype' => 'multipart/form-data'))}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="card ">
                                        <div class="card-header">
                                            <h5>{{__('Workspace Settings')}}</h5>
                                        </div>
                                        <div class="card-body">
                                           <div class="col-12">
                                             <div class="row">
                                            <div class="col-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{__('Dark Logo')}}</h5>
                                                    
                                                    </div>

                                                    
                                                    <div class="card-body">
                                                            <div class="logo-content">
                                                                <img src="@if($currentWorkspace->logo) {{asset($logo.$currentWorkspace->logo)}} @else{{asset($logo.'logo-light.png')}} @endif" class="small_logo" id="dark_logo"/>
                                                            </div>


                                                            <div class="choose-file mt-5 ">
                                                                <label for="logo">
                    
                                                                    <div class=" bg-primary"> <i class="ti ti-upload px-1"></i>{{__('Choose file here')}}</div>
                                                                    <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                                                </label>
                                                                <p class="edit-logo"></p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="col-4">
                                                <div class="card ">
                                                    <div class="card-header">
                                                        <h5>{{__('Light Logo')}}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                            <div class="logo-content">
                                                                <img src="@if($currentWorkspace->logo_white) {{asset($logo.$currentWorkspace->logo_white)}} @else{{asset($logo.'logo-dark.png')}} @endif" id="image"  class="small_logo"/>
                                                            </div>
                                                            <div class="choose-file mt-5 ">
                                                                <label for="logo_white">
                    
                                                                    <div class=" bg-primary"> <i class="ti ti-upload px-1"></i>{{__('Choose file here')}}</div>
                                                                    <input type="file" class="form-control" name="logo_white" id="logo_white" data-filename="edit-logo_white">
                                                                </label>
                                                                <p class="edit-logo_white"></p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="card ">
                                                    <div class="card-header">
                                                        <h5>{{__('Favicon')}}</h5>
                                                    
                                                    </div>
                                                    <div class="card-body" style="height: 220px !important">
                                                            <div class="logo-content">


                                                                <img src="@if($currentWorkspace->favicon) {{asset($logo.$currentWorkspace->favicon)}} @else{{asset($logo.'favicon.png')}} @endif" id="favicon"  class="favicon" style="width:90px !important" />
                                                            </div>
                                                            <div class="choose-file mt-5 ">
                                                                <label for="small-favicon">
                    
                                                                    <div class=" bg-primary"> <i class="ti ti-upload px-1"></i>{{__('Choose file here')}}</div>
                                                                    <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                                                </label>
                                                                <p class="edit-favicon"></p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                             </div>
                                              </div>
                                                <div class="row mt-2">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                               {{Form::label('name',__('Name'),array('class'=>'form-label')) }}
                                                              {{Form::text('name',$currentWorkspace->name,array('class'=>'form-control', 'required' => 'required','placeholder'=>__('Enter Name')))}}
                                                                @error('name')
                                                                <span class="invalid-name" role="alert">
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            {{Form::label('interval_time',__('Tracking Interval'),array('class'=>'form-label')) }}
        
                                                            {{ Form::number('interval_time',$currentWorkspace->interval_time, ['class' => 'form-control', 'placeholder' => __('Enter Tracking Interval'),'required'=>'required']) }}  
                                                            <small>{{__("Image Screenshot Take Interval time ( 1 = 1 min)")}}</small>  
                                                        </div>
                                                    </div>         
                                                   
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">{{__('Application URL')}}</label>
                                                             {{ Form::text('currency',URL::to('/'), ['class' => 'form-control', 'placeholder' => __('Enter Currency'),'disabled'=>'true']) }} 
                                                              <small>{{__("Application URL to log into the app.")}}</small>   
                                                        </div>
                                                    </div>


                                            <h4 class="small-title mb-4">Theme Customizer</h4>
                                            <div class="col-12">
                                                <div class="pct-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h6 class="">
                                                            <i data-feather="credit-card" class="me-2"></i>Primary color settings
                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="theme-color themes-color">
                                                             <input type="hidden" class="theme_color " name="theme_color" value="{{$color}}">
                                                            <a href="#!" class="{{($color =='theme-1') ? 'active_color' : ''}}" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                            <input type="radio" class="theme_color " name="theme_color" value="theme-1" style="display: none;">
                                                            <a href="#!" class="{{($color =='theme-2') ? 'active_color' : ''}}" data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                                <input type="radio" class="theme_color" name="theme_color" value="theme-2" style="display: none;">
                                                            <a href="#!" class="{{($color =='theme-3') ? 'active_color' : ''}}" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                                <input type="radio" class="theme_color" name="theme_color" value="theme-3" style="display: none;">
                                                            <a href="#!" class="{{($color =='theme-4') ? 'active_color' : ''}}" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                            <input type="radio" class="theme_color" name="theme_color" value="theme-4" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6 class="">
                                                                <i data-feather="layout" class="me-2"></i>Sidebar settings
                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="form-check form-switch">
                                                                 <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg"  @if($cust_theme_bg == 'on') checked @endif/>
                                                                   <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg">Transparent layout</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6 class="">
                                                            <i data-feather="sun" class=""></i>Layout settings
                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="form-check form-switch mt-2">
                                                                <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout" @if($dark_mode == 'on') checked @endif/>
                            
                                                            <label class="form-check-label f-w-600 pl-1" for="cust-darklayout" >Dark Layout</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                         <div class="col switch-width">
                                                             <div class="form-group ml-2 mr-3 ">
                                                                 <label class="form-label mb-1">{{__('Enable RTL')}}</label>
                                                                 <div class="custom-control custom-switch">
                                                                      <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="" name="site_rtl" id="site_rtl" {{! empty($SITE_RTL) && $SITE_RTL == 'on' ? 'checked="checked"' : '' }}>
                                                                     <label class="custom-control-label" for="site_rtl"></label>
                                                                 </div>
                                                             </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end mt-2">
                                                <input type="submit" value="{{__('Save Changes')}}" class="btn btn-primary">
                                            </div>
                                                </div>
                                            
                                        </div>
                                    </div> 
                                </div>
                              </div> 
                                {{Form::close()}}
                        </div> -->
                                        
                                <div id="task-stage-settings" class="">
                                    <div class="">
                                        <div class="col-md-12">
                                        <div class="card task-stages" data-value="{{json_encode($stages)}}">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-11">
                                                    <h5 class="pb-2">
                                                        {{ __('Task Stage Settings') }}
                                                        
                                                    </h5>
                                                    <small class="pt-2">{{__('System will consider the last stage as a completed/done project or task status.')}}</small></div>
                                                    <div class="col-auto  text-end">
                                                    
                                                    <button data-repeater-create type="button" class="btn-submit btn btn-sm btn-primary btn-icon " data-toggle="tooltip" title="{{__('Add')}}">
                                                        <i class="ti ti-plus"></i>
                                                    </button> 
                                            
                                            </div>
                                                </div>
                                                </div>
                                                
                                                <div class="card-body">
                                                    <form method="post" action="{{route('stages.store',$currentWorkspace->slug)}}">
                                                        @csrf
                                                        <table class="table table-hover" data-repeater-list="stages">
                                                            <thead>
                                                            <th>
                                                                <div data-toggle="tooltip" data-placement="left" data-title="{{ __('Drag Stage to Change Order') }}" data-original-title="" title="">
                                                                    <i class="fas fa-crosshairs"></i>
                                                                </div>
                                                            </th>
                                                            <th>{{__('Color')}}</th>
                                                            <th>{{__('Name')}}</th>
                                                            <th class="text-right">{{__('Delete')}}</th>
                                                            </thead>
                                                            <tbody>
                                                            <tr data-repeater-item>
                                                                <td><i class="fas fa-crosshairs sort-handler"></i></td>
                                                                <td>
                                                                    <input type="color" name="color">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="id" id="id"/>
                                                                    <input type="text" name="name" class="form-control mb-0" required/>
                                                                </td>
                                                                <td class="text-right ">
                                                                    <a data-repeater-delete class=" action-btn btn-danger  btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-end pt-2">
                                                            <button class="btn-submit btn btn-primary" type="submit">{{__('Save Changes')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="bug-stage-settings" class="tab-pane">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card bug-stages" data-value="{{json_encode($bugStages)}}">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-11">
                                                    <h5 class="pb-2">
                                                        {{ __('Bug Stage Settings') }}
                                                        
                                                    </h5>
                                                    <small class="">{{__('System will consider the last stage as a completed/done project or bug status.')}}</small>
                                                </div>
                                                    <div class=" col-auto text-end">
                                                    <button data-repeater-create type="button" class="btn-submit btn btn-sm btn-primary " data-toggle="tooltip" title="{{__('Add')}}">
                                                        <i class="ti ti-plus"></i>
                                                    </button>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="card-body">
                                                    <form method="post" action="{{route('bug.stages.store',$currentWorkspace->slug)}}">
                                                        @csrf
                                                        <table class="table table-hover" data-repeater-list="stages">
                                                            <thead>
                                                            <th>
                                                                <div data-toggle="tooltip" data-placement="left" data-title="{{ __('Drag Stage to Change Order') }}" data-original-title="" title="">
                                                                    <i class="fas fa-crosshairs"></i>
                                                                </div>
                                                            </th>
                                                            <th>{{__('Color')}}</th>
                                                            <th>{{__('Name')}}</th>
                                                            <th class="text-right">{{__('Delete')}}</th>
                                                            </thead>
                                                            <tbody>
                                                            <tr data-repeater-item>
                                                                <td><i class="fas fa-crosshairs sort-handler"></i></td>
                                                                <td>
                                                                    <input type="color" name="color">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="id" id="id"/>
                                                                    <input type="text" name="name" class="form-control mb-0" required/>
                                                                </td>
                                                                <td class="text-right">
                                                                    <a data-repeater-delete class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-end pt-2">
                                                            <button class="btn-submit btn btn-primary" type="submit">{{__('Save Changes')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    <div id="tax-settings" class="">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                          <div class="row">
                                            <div class="col-11">
                                        <h5 class="">
                                            {{ __('Tax Settings') }}
                                        </h5>
                                    </div>
                                        <div class="text-end  col-auto">
                                        <button class="btn-submit btn btn-sm btn-primary" type="button" data-ajax-popup="true" data-title="{{ __('Add Tax') }}" data-url="{{route('tax.create',$currentWorkspace->slug)}}" data-toggle="tooltip" title="{{__('Add Tax')}}">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">

                                            <table id="" class="table table-bordered px-2">
                                                <thead>
                                                <tr>
                                                    <th>{{__('Name')}}</th>
                                                    <th>{{__('Rate')}}</th>
                                                    <th width="200px" class="text-right">{{__('Action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($taxes as $tax)
                                                    <tr>
                                                        <td>{{$tax->name}}</td>
                                                        <td>{{$tax->rate}}%</td>
                                                        <td class="text-right">
                                                            <a href="#" class="action-btn btn-info  btn btn-sm d-inline-flex align-items-center" data-ajax-popup="true" data-title="{{ __('Edit Tax') }}" data-url="{{route('tax.edit',[$currentWorkspace->slug,$tax->id])}}" data-toggle="tooltip" title="{{__('Edit Tax')}}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                            <a href="#" class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center bs-pass-para" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{ $tax->id }}"data-toggle="tooltip" title="{{__('Delete')}}">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            <form id="delete-form-{{$tax->id}}" action="{{ route('tax.destroy',[$currentWorkspace->slug,$tax->id]) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div id="company-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">
                                            {{ __('Company Settings') }}
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="{{route('workspace.settings.store',$currentWorkspace->slug)}}" class="payment-form">
                                            @csrf
                                            <div class="row mt-3">
                                                <div class="form-group col-md-6">
                                                    <label for="company" class="form-label">{{ __('Name') }}</label>
                                                    <input type="text" name="company" id="company" class="form-control" value="{{ $currentWorkspace->company }}" required="required"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="address" class="form-label">{{ __('Address') }}</label>
                                                    <input type="text" name="address" id="address" class="form-control" value="{{$currentWorkspace->address}}" required="required"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="city" class="form-label">{{__('City')}}</label>
                                                    <input class="form-control" name="city" type="text" value="{{ $currentWorkspace->city }}" id="city">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="state" class="form-label">{{__('State')}}</label>
                                                    <input class="form-control" name="state" type="text" value="{{ $currentWorkspace->state }}" id="state">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="zipcode" class="form-label">{{__('Zip/Post Code')}}</label>
                                                    <input class="form-control" name="zipcode" type="text" value="{{ $currentWorkspace->zipcode }}" id="zipcode">
                                                </div>
                                                <div class="form-group  col-md-6">
                                                    <label for="country" class="form-label">{{__('Country')}}</label>
                                                    <input class="form-control" name="country" type="text" value="{{ $currentWorkspace->country }}" id="country">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="telephone" class="form-label">{{__('Telephone')}}</label>
                                                    <input class="form-control" name="telephone" type="text" value="{{ $currentWorkspace->telephone }}" id="telephone">
                                                </div>
                                            </div>
                                             <div class="text-end">
                                            <button type="submit" class="btn-submit btn btn-primary">{{ __('Save Changes')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div id="payment-settings" class="faq">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">
                                            {{ __('Payment Settings') }}
                                        </h5>
                                         <small class="d-block mt-2">{{__("These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.")}}</small>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="{{route('workspace.settings.store',$currentWorkspace->slug)}}" class="payment-form">
                                            @csrf
                                            <div class="row mt-3">
                                                    <div class="form-group col-md-6">
                                                    <label for="currency_code" class="form-label">{{ __('Currency Code') }}</label>
                                                    <input type="text" name="currency_code" id="currency_code" class="form-control" value="{{$currentWorkspace->currency_code}}" required="required"/>
                                                    <small> {{ __('Note: Add currency code as per three-letter ISO code.') }} <a href="https://stripe.com/docs/currencies" target="_new">{{ __('You can find out how to do that here.') }}</a>.</small>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="currency" class="form-label">{{ __('Currency') }}</label>
                                                    <input type="text" name="currency" id="currency" class="form-control" value="{{$currentWorkspace->currency}}" required="required"/>
                                                </div>
                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="accordion accordion-flush" id="payment-gateways">
                                                      <div id="" class="accordion-item card">
                                                        <!-- Stripe -->
                                    
                                                        <h2 class="accordion-header" id="stripe">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseone"
                                                                aria-expanded="false" aria-controls="collapseone">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Stripe') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                <div id="collapseone" class="accordion-collapse collapse"
                                                    aria-labelledby="stripe" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">

                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_stripe_enabled" id="is_stripe_enabled" {{(isset($currentWorkspace->is_stripe_enabled) && $currentWorkspace->is_stripe_enabled == '1') ? 'checked' : ''}}>
                                                                                <label class="custom-control-label form-control-label" for="is_stripe_enabled">{{__('Enable Stripe')}}</label>
                                                                            </div>



                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('stripe_key', __('Stripe Key'),['class' => 'form-label']) }}
                                                                     {{ Form::text('stripe_key', (isset($currentWorkspace->stripe_key) && !empty($currentWorkspace->stripe_key)) ? $currentWorkspace->stripe_key :'', ['class' => 'form-control','placeholder' => __('Stripe Key')]) }}

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                     {{ Form::label('stripe_secret', __('Stripe Secret'),['class' => 'form-label']) }}
                                                                     {{ Form::text('stripe_secret', (isset($currentWorkspace->stripe_secret) && !empty($currentWorkspace->stripe_secret)) ? $currentWorkspace->stripe_secret:'', ['class' => 'form-control','placeholder' => __('Stripe Secret')]) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <div id="" class="accordion-item card">
                                                        <!-- paypal -->
                                    
                                                        <h2 class="accordion-header" id="paypal">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapsetwo"
                                                                aria-expanded="false" aria-controls="collapsetwo">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Paypal') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapsetwo" class="accordion-collapse collapse"
                                                    aria-labelledby="paypal" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">
                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_paypal_enabled" id="is_paypal_enabled" {{(isset($currentWorkspace->is_paypal_enabled) && $currentWorkspace->is_paypal_enabled == '1') ? 'checked' : ''}}><label class="custom-control-label form-control-label" for="is_paypal_enabled">{{__('Enable Paypal')}}</label>
                                                                            </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                             <label class="pb-2" for="paypal_mode">{{__('Paypal Mode')}}</label> 
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="paypal_mode" class="form-check-input input-primary " value="sandbox" {{ (!isset($currentWorkspace-> paypal_mode) || empty($currentWorkspace->paypal_mode) || $currentWorkspace->paypal_mode == 'sandbox') ? 'checked' : ''}}
                                                                            id="">
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                        class="float-end"></strong>{{ __('Sandbox') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" name="paypal_mode" class="form-check-input input-primary "  value="live" {{ (isset($currentWorkspace->paypal_mode) && $currentWorkspace->paypal_mode == 'live') ? 'checked' : ''}}>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                class="float-end"></strong>{{ __('Live') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('paypal_client_id', __('Client ID'),['class' => 'form-label']) }}
                                                                                {{ Form::text('paypal_client_id', (isset($currentWorkspace->paypal_client_id)) ? $currentWorkspace->paypal_client_id : '', ['class' => 'form-control','placeholder' => __('Client ID')]) }}

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('paypal_secret_key', __('Secret Key'),['class' => 'form-label']) }}
                                                                                {{ Form::text('paypal_secret_key', isset($currentWorkspace->paypal_secret_key) ? $currentWorkspace->paypal_secret_key : '', ['class' => 'form-control','placeholder' => __('Secret Key')]) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                                <div id="" class="accordion-item card">
                                                        <!-- paystack -->
                                    
                                                        <h2 class="accordion-header" id="paystack">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapsethree"
                                                                aria-expanded="false" aria-controls="collapsethree">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Paystack') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapsethree" class="accordion-collapse collapse"
                                                    aria-labelledby="paystack" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">

                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_paystack_enabled" id="is_paystack_enabled" {{ isset($payment_detail['is_paystack_enabled']) && $payment_detail['is_paystack_enabled'] == 'on' ? 'checked="checked"' : '' }}>  <label class="custom-control-label form-control-label" for="is_paystack_enabled">{{__('Enable Paystack')}}</label>
                                                                            </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                        
                                                    </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                     <label class="form-label" for="paystack_public_key">{{ __('Public Key') }}</label>
                                                                     <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="{{isset($payment_detail['paystack_public_key']) ? $payment_detail['paystack_public_key']:''}}" placeholder="{{ __('Public Key') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                   <label class="form-label" for="paystack_secret_key">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="{{isset($payment_detail['paystack_secret_key']) ? $payment_detail['paystack_secret_key']:''}}" placeholder="{{ __('Secret Key') }}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 


                                            <div id="" class="accordion-item card">
                                                        <!-- Flutterwave -->
                                    
                                                        <h2 class="accordion-header" id="Flutterwave">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapsefor"
                                                                aria-expanded="false" aria-controls="collapsefor">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Flutterwave') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapsefor" class="accordion-collapse collapse"
                                                    aria-labelledby="Flutterwave" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">


                                                                   <div class="form-check form-switch d-inline-block">
                                                                    <input type="checkbox" class="form-check-input"  name="is_flutterwave_enabled" id="is_flutterwave_enabled" {{ isset($payment_detail['is_flutterwave_enabled'])  && $payment_detail['is_flutterwave_enabled']== 'on' ? 'checked="checked"' : '' }}><label class="custom-control-label form-control-label" for="is_flutterwave_enabled">{{__('Enable Flutterwave')}}</label>
                                                                </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                        
                                                    </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                      <label class="form-label" for="flutterwave_public_key">{{ __('Public Key') }}</label>
                                                                    <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="{{isset($payment_detail['flutterwave_public_key'])?$payment_detail['flutterwave_public_key']:''}}" placeholder="{{ __('Public Key') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                 <label class="form-label" for="paystack_secret_key">{{ __('Secret Key') }}</label>
                                                                 <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="{{isset($payment_detail['flutterwave_secret_key'])?$payment_detail['flutterwave_secret_key']:''}}" placeholder="{{ __('Secret Key') }}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="" class="accordion-item card">
                                                        <!-- Razorpay -->
                                    
                                                        <h2 class="accordion-header" id="Razorpay">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                                                aria-expanded="false" aria-controls="collapsefive">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Razorpay') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapsefive" class="accordion-collapse collapse"
                                                    aria-labelledby="Razorpay" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">

                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_razorpay_enabled" id="is_razorpay_enabled" {{ isset($payment_detail['is_razorpay_enabled']) && $payment_detail['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : '' }}><label class="custom-control-label form-control-label" for="is_razorpay_enabled">{{__('Enable Razorpay')}}</label>
                                                                            </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                        
                                                    </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                     <label class="form-label" for="razorpay_public_key">{{ __('Public Key') }}</label>
                                                                    <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="{{ isset($payment_detail['razorpay_public_key'])?$payment_detail['razorpay_public_key']:''}}" placeholder="{{ __('Public Key') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                     <label class="form-label" for="paystack_secret_key">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="{{ isset($payment_detail['razorpay_secret_key'])?$payment_detail['razorpay_secret_key']:''}}" placeholder="{{ __('Secret Key') }}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                                 <div id="" class="accordion-item card">
                                                        <!-- paypal -->
                                    
                                                        <h2 class="accordion-header" id="mercado">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapsetsix"
                                                                aria-expanded="false" aria-controls="collapsetsix">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Mercado Pago') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapsetsix" class="accordion-collapse collapse"
                                                    aria-labelledby="mercado" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">

                                                          

                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_mercado_enabled" id="is_mercado_enabled" {{isset($payment_detail['is_mercado_enabled']) &&  $payment_detail['is_mercado_enabled'] == 'on' ? 'checked="checked"' : '' }}> <label class="custom-control-label form-control-label" for="is_mercado_enabled">{{__('Enable Mercado Pago')}}</label>
                                                                            </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                             <label class="pb-2" for="paypal_mode">{{__('Mercado Mode')}}</label> 
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary "name="mercado_mode" value="sandbox" {{ isset($payment_detail['mercado_mode']) && $payment_detail['mercado_mode'] == '' || isset($payment_detail['mercado_mode']) && $payment_detail['mercado_mode'] == 'sandbox' ? 'checked' : '' }}>

                                                                          
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                        class="float-end"></strong>{{ __('Sandbox') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary "name="mercado_mode" value="live" {{ isset($payment_detail['mercado_mode']) && $payment_detail['mercado_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                class="float-end"></strong>{{ __('Live') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-12">
                                                                 <label for="mercado_access_token" class="form-label">{{ __('Access Token') }}</label>
                                                                    <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="{{isset($payment_detail['mercado_access_token']) ? $payment_detail['mercado_access_token']:''}}" placeholder="{{ __('Access Token') }}"/>                                                        
                                                                    @if ($errors->has('mercado_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('mercado_access_token') }}
                                                                        </span>
                                                                    @endif
                                                            </div>
                                                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                              <div id="" class="accordion-item card">
                                                        <!-- Paytm -->
                                    
                                                        <h2 class="accordion-header" id="Paytm">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapset7"
                                                                aria-expanded="false" aria-controls="collapset7">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Paytm') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapset7" class="accordion-collapse collapse"
                                                    aria-labelledby="Paytm" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">

                                                        

                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_paytm_enabled" id="is_paytm_enabled" {{ isset($payment_detail['is_paytm_enabled']) && $payment_detail['is_paytm_enabled'] == 'on' ? 'checked="checked"' : '' }}> 
                                                                                  <label class="custom-control-label form-control-label" for="is_paytm_enabled">{{__('Enable Paytm')}}</label>
                                                                            </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                             <label class="pb-2" for="paypal_mode">{{__('Paytm Environment')}}</label> 
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary "name="paytm_mode" value="local" {{ isset($payment_detail['paytm_mode']) && $payment_detail['paytm_mode'] == '' || isset($payment_detail['paytm_mode']) && $payment_detail['paytm_mode'] == 'local' ? 'checked="checked"' : '' }}>

                                                                          
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                        class="float-end"></strong>{{ __('Local') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary"name="paytm_mode" value="production" {{ isset($payment_detail['paytm_mode']) && $payment_detail['paytm_mode'] == 'production' ? 'checked="checked"' : '' }}>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                class="float-end"></strong>{{ __('Production') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                  <div class="form-group">
                                                                    <label class="form-label" for="paytm_public_key">{{ __('Merchant ID') }}</label>
                                                                    <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="{{isset($payment_detail['paytm_merchant_id'])? $payment_detail['paytm_merchant_id']:''}}" placeholder="{{ __('Merchant ID') }}"/>
                                                                </div>
                                                            </div>
                                                           <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="paytm_secret_key">{{ __('Merchant Key') }}</label>
                                                                        <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="{{ isset($payment_detail['paytm_merchant_key']) ? $payment_detail['paytm_merchant_key']:''}}" placeholder="{{ __('Merchant Key') }}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="paytm_industry_type">{{ __('Industry Type') }}</label>
                                                                        <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="{{isset($payment_detail['paytm_industry_type']) ?$payment_detail['paytm_industry_type']:''}}" placeholder="{{ __('Industry Type') }}"/>
                                                                    </div>
                                                                </div>
                                                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="" class="accordion-item card">
                                                        <!-- Mollie -->
                                    
                                                        <h2 class="accordion-header" id="Mollie">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapset8"
                                                                aria-expanded="false" aria-controls="collapset8">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Mollie') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapset8" class="accordion-collapse collapse"
                                                    aria-labelledby="Mollie" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">
                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input"name="is_mollie_enabled" id="is_mollie_enabled" {{ isset($payment_detail['is_mollie_enabled']) && $payment_detail['is_mollie_enabled'] == 'on' ? 'checked="checked"' : '' }}> 
                                                                                 <label class="custom-control-label form-control-label" for="is_mollie_enabled">{{__('Enable Mollie')}}</label>
                                                                            </div>            
                                                        </div>
                                        
                                                        <div class="row mt-2">
                                                               <div class="col-md-4 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="mollie_api_key">{{ __('Mollie Api Key') }}</label>
                                                                                <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="{{ isset($payment_detail['mollie_api_key'])?$payment_detail['mollie_api_key']:''}}" placeholder="{{ __('Mollie Api Key') }}"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-4 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="mollie_profile_id">{{ __('Mollie Profile Id') }}</label>
                                                                                <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="{{ isset($payment_detail['mollie_profile_id'])?$payment_detail['mollie_profile_id']:''}}" placeholder="{{ __('Mollie Profile Id') }}"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="mollie_partner_id">{{ __('Mollie Partner Id') }}</label>
                                                                                <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="{{ isset($payment_detail['mollie_partner_id'])?$payment_detail['mollie_partner_id']:''}}" placeholder="{{ __('Mollie Partner Id') }}"/>
                                                                            </div>
                                                                        </div>
                                                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                               <div id="" class="accordion-item card">
                                                        <!-- Skrill -->
                                    
                                                        <h2 class="accordion-header" id="Skrill">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapset9"
                                                                aria-expanded="false" aria-controls="collapset9">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Skrill') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapset9" class="accordion-collapse collapse"
                                                    aria-labelledby="Skrill" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">
                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input"name="is_skrill_enabled" id="is_skrill_enabled" {{ isset($payment_detail['is_skrill_enabled']) && $payment_detail['is_skrill_enabled'] == 'on' ? 'checked="checked"' : '' }}> 
                                                                                 <label class="custom-control-label form-control-label" for="is_skrill_enabled">{{__('Enable Skrill')}}</label>
                                                                            </div>            
                                                              </div>
                                        
                                                                 <div class="row mt-2">
                                                                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="mollie_api_key">{{ __('Skrill Email') }}</label>
                                                                                <input type="email" name="skrill_email" id="skrill_email" class="form-control" value="{{ isset($payment_detail['skrill_email'])?$payment_detail['skrill_email']:''}}" placeholder="{{ __('Skrill Email') }}"/>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                           </div>
                                                      </div>
                                                  </div>

                                                    <div id="" class="accordion-item card">
                                                        <!-- paypal -->
                                    
                                                        <h2 class="accordion-header" id="CoinGate">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapset10"
                                                                aria-expanded="false" aria-controls="collapset10">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('CoinGate') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                  <div id="collapset10" class="accordion-collapse collapse"
                                                    aria-labelledby="CoinGate" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">
                                                                   <div class="form-check form-switch d-inline-block">
                                                                                <input type="checkbox" class="form-check-input" name="is_coingate_enabled" id="is_coingate_enabled" {{ isset($payment_detail['is_coingate_enabled']) && $payment_detail['is_coingate_enabled'] == 'on' ? 'checked="checked"' : '' }}> <label class="custom-control-label form-control-label" for="is_mercado_enabled">{{__('CoinGate')}}</label>
                                                                            </div>            
                                                        </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                             <label class="pb-2" for="paypal_mode">{{__('CoinGate Mode')}}</label> 
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary "name="coingate_mode" value="sandbox" {{ isset($payment_detail['coingate_mode']) && $payment_detail['coingate_mode'] == '' || isset($payment_detail['coingate_mode']) && $payment_detail['coingate_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>

                                                                          
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                        class="float-end"></strong>{{ __('Sandbox') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary name="coingate_mode" value="live" {{ isset($payment_detail['coingate_mode']) && $payment_detail['coingate_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong
                                                                                class="float-end"></strong>{{ __('Live') }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row mt-2">
                                                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="coingate_auth_token">{{ __('CoinGate Auth Token') }}</label>
                                                                                <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="{{ isset($payment_detail['coingate_auth_token'])?$payment_detail['coingate_auth_token']:''}}" placeholder="{{ __('CoinGate Auth Token') }}"/>
                                                                            </div>
                                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
 
                                                  <div id="" class="accordion-item card">
                                                        <!-- Paymentwall -->
                                    
                                                        <h2 class="accordion-header" id="Paymentwall">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse11"
                                                                aria-expanded="false" aria-controls="collapse11">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card"></i> {{ __('Paymentwall') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                <div id="collapse11" class="accordion-collapse collapse"
                                                    aria-labelledby="Paymentwall" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-end">
                                                                   <div class="form-check form-switch d-inline-block">
                                                                        
                                                                                 <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                                                <input type="checkbox" class="form-check-input" name="is_paymentwall_enabled" id="is_paymentwall_enabled" {{ isset($payment_detail['is_paymentwall_enabled'])  && $payment_detail['is_paymentwall_enabled']== 'on' ? 'checked="checked"' : '' }}>
                                                                                 <label class="custom-control-label form-control-label" for="is_paymentwall_enabled">{{__('Enable PaymentWall')}}</label>
                                                                            </div>



                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_public_key" class="form-label">{{ __('Public Key') }}</label>
                                                                                <input type="text" name="paymentwall_public_key" id="paymentwall_public_key" class="form-control" value="{{isset($payment_detail['paymentwall_public_key'])?$payment_detail['paymentwall_public_key']:''}}" placeholder="{{ __('Public Key') }}"/>
                                                                                @if ($errors->has('paymentwall_public_key'))
                                                                                    <span class="invalid-feedback d-block">
                                                                                        {{ $errors->first('paymentwall_public_key') }}
                                                                                    </span>
                                                                                @endif

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                     <label for="paymentwall_private_key" class="form-label">{{ __('Private Key') }}</label>
                                                                                <input type="text" name="paymentwall_private_key" id="paymentwall_private_key" class="form-control form-control-label" value="{{isset($payment_detail['paymentwall_private_key'])?$payment_detail['paymentwall_private_key']:''}}" placeholder="{{ __('Private Key') }}"/>
                                                                                @if ($errors->has('paymentwall_private_key'))
                                                                                    <span class="invalid-feedback d-block">
                                                                                        {{ $errors->first('paymentwall_private_key') }}
                                                                                    </span>
                                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                              
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                            <button type="submit" class="btn-submit btn btn-primary">{{ __('Save Changes')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="invoice-settings" class="tab-pane">
                        <div class="">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">
                                            {{ __('Invoice Footer Settings') }}
                                           
                                        </h5>
                                         <small class="d-block mt-2">{{__('The following will be displayed in the invoice footer.')}}</small>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="{{route('workspace.settings.store',$currentWorkspace->slug)}}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="invoice_footer_title" class="form-label">{{ __('Invoice Footer Title') }}</label>
                                                    <input class="form-control" name="invoice_footer_title" type="text" value="{{ $currentWorkspace->invoice_footer_title }}" id="invoice_footer_title">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="invoice_footer_notes" class="form-label">{{ __('Invoice Footer Notes') }}</label>
                                                    <textarea class="form-control" name="invoice_footer_notes">{{ $currentWorkspace->invoice_footer_notes }}</textarea>
                                                </div>
                                                <div class=" text-end">
                                                    <button type="submit" class="btn-submit btn btn-primary">
                                                        {{ __('Save Changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">
                                            {{ __('Invoice Settings') }}
                                        </h5>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="invoice_color_pallate">
                                            <div class="">
                                                <form action="{{route('workspace.settings.store',$currentWorkspace->slug)}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="address" class="form-label">{{__('Invoice Template')}}</label>
                                                        <select class="form-control select2" name="invoice_template">
                                                            <option value="template1" @if($currentWorkspace->invoice_template == 'template1') selected @endif>New York</option>
                                                            <option value="template2" @if($currentWorkspace->invoice_template == 'template2') selected @endif>Toronto</option>
                                                            <option value="template3" @if($currentWorkspace->invoice_template == 'template3') selected @endif>Rio</option>
                                                            <option value="template4" @if($currentWorkspace->invoice_template == 'template4') selected @endif>London</option>
                                                            <option value="template5" @if($currentWorkspace->invoice_template == 'template5') selected @endif>Istanbul</option>
                                                            <option value="template6" @if($currentWorkspace->invoice_template == 'template6') selected @endif>Mumbai</option>
                                                            <option value="template7" @if($currentWorkspace->invoice_template == 'template7') selected @endif>Hong Kong</option>
                                                            <option value="template8" @if($currentWorkspace->invoice_template == 'template8') selected @endif>Tokyo</option>
                                                            <option value="template9" @if($currentWorkspace->invoice_template == 'template9') selected @endif>Sydney</option>
                                                            <option value="template10" @if($currentWorkspace->invoice_template == 'template10') selected @endif>Paris</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{__('Color')}}</label>
                                                        <div class="row gutters-xs">
                                                            @foreach($colors as $key => $color)
                                                                <div class="col-auto">
                                                                    <label class="colorinput">
                                                                        <input name="invoice_color" type="radio" value="{{$color}}" class="colorinput-input" @if($currentWorkspace->invoice_color == $color) checked @endif>
                                                                        <span class="colorinput-color mb-1" style="background: #{{$color}}"></span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                     <div class="text-end">
                                                    <button class="btn-submit btn btn-primary" type="submit">
                                                        {{__('Save Changes')}}
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                            <div class="main_invoice">
                                                <iframe frameborder="0" width="100%" height="1080px" src="{{route('invoice.preview',[$currentWorkspace->slug,($currentWorkspace->invoice_template)?$currentWorkspace->invoice_template:'template1',($currentWorkspace->invoice_color)?$currentWorkspace->invoice_color:'fff'])}}"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="" id="email-notification-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Email Notification Settings') }}</h5>
                            </div>
                            <div class="card-body table-border-style ">
                                <div class="table-responsive">
                                    <table class="table dataTable">
                                        <thead>
                                        <tr>
                                            <th class="w-75"> {{__('Name')}}</th>
                                            <th class="text-center"> {{__('On/Off')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($EmailTemplates as $EmailTemplate)
                                            <tr class="">
                                                <td>{{ $EmailTemplate->name }}</td>
                                                <td class="text-center">
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label class="form-check form-switch d-inline-block">
                                                                <input type="checkbox" class="email-template-checkbox form-check-input" name="is_active" id="email_tempalte_{{($EmailTemplate->template)?$EmailTemplate->template->id:''}}" @if(($EmailTemplate->template)?($EmailTemplate->template->is_active == 1):'') checked="checked" @endif type="checkbox" value="{{($EmailTemplate->template)?$EmailTemplate->template->is_active:''}}" data-url="{{route('status.email.language',[($EmailTemplate->template)?$EmailTemplate->template->id:'0',$currentWorkspace->slug])}}">
                                                                <label class="col-form-label" for="email_tempalte_{{($EmailTemplate->template)?$EmailTemplate->template->id:''}}"></label>
                                                            </label>
                                                        </div>
                                                   
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    </div>

                    <div id="zoom-meeting-settings" class="">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">
                                            {{ __('Zoom Meeting Settings') }}
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="{{route('workspace.settings.store',$currentWorkspace->slug)}}" class="payment-form">
                                            @csrf
                                            <div class="row mt-3">
                                                <div class="form-group col-md-12">
                                                    <label for="company" class="form-label">{{ __('Zoom API Key') }}</label>
                                                    <input type="text" name="zoom_api_key" id="zoom_api_key" class="form-control" value="{{ $currentWorkspace->zoom_api_key }}" required="required"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="address" class="form-label">{{ __('Zoom API Secret') }}</label>
                                                    <input type="text" name="zoom_api_secret" id="zoom_api_secret" class="form-control" value="{{$currentWorkspace->zoom_api_secret}}" required="required"/>
                                                </div>
                                               
                                            </div>
                                            <div class="text-end">
                                            <button type="submit" class="btn-submit btn btn-primary">{{ __('Save Changes')}}</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                   
                    @if(Auth::user()->type == 'user')
                      <div class="" id="slack-settings">
                          {{Form::open(array('route'=>['workspace.settings.Slack', $currentWorkspace->slug],'method'=>'post','class'=>'d-contents'))}}
                           <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                     <div class="card-header">
                                    <h5 class="">
                                        {{ __('Slack Settings') }}
                                    </h5>
                                    </div>
                                    <div class="card-body">
                                    <div class="row company-setting">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                             {{Form::label('Slack Webhook URL',__('Slack Webhook URL'),['class'=>'form-label']) }}
                                           {{ Form::text('slack_webhook', isset($payment_detail['slack_webhook']) ?$payment_detail['slack_webhook'] :'', ['class' => 'form-control', 'placeholder' => __('Enter Slack Webhook URL'), 'required' => 'required']) }}     
                                           
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                             {{Form::label('Module Settings',__('Module Settings'),['class'=>'form-label']) }}
                                           </div> 
                                       

                                        <div class="col-md-4">
                                               <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6> {{Form::label('New Project',__('New Project'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                            {{Form::checkbox('project_notificaation', '1',isset($payment_detail['project_notificaation']) && $payment_detail['project_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'project_notificaation'))}}
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>  {{Form::label('New Task',__('New Task'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                           {{Form::checkbox('task_notificaation', '1',isset($payment_detail['task_notificaation']) && $payment_detail['task_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'task_notificaation'))}}
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>{{Form::label('Task Stage Updated',__('Task Stage Updated'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                            {{Form::checkbox('taskmove_notificaation', '1',isset($payment_detail['taskmove_notificaation']) && $payment_detail['taskmove_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'taskmove_notificaation'))}}
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                                 <div class="col-md-4">
                                                        <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                            <div class="mb-3 mb-sm-0">
                                                                <h6> {{Form::label('New Milestone',__('New Milestone'),['class'=>'form-label']) }}</h6>
                                                            </div>
                                                           <div class="text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                     {{Form::checkbox('milestone_notificaation', '1',isset($payment_detail['milestone_notificaation']) && $payment_detail['milestone_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'milestone_notificaation'))}}
                                                              </div>
                                                          </div>
                                                        </div>

                                                           <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                            <div class="mb-3 mb-sm-0">
                                                                <h6> {{Form::label('Milestone Status Updated',__('Milestone Status Updated'),['class'=>'form-label']) }}</h6>
                                                            </div>
                                                           <div class="text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                     {{Form::checkbox('milestonest_notificaation', '1',isset($payment_detail['milestonest_notificaation']) && $payment_detail['milestonest_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'milestonest_notificaation'))}}
                                                              </div>
                                                          </div>
                                                        </div>

                                                           <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                            <div class="mb-3 mb-sm-0">
                                                                <h6>  {{Form::label('New Task Comment',__('New Task Comment'),['class'=>'form-label']) }}</h6>
                                                            </div>
                                                           <div class="text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                    {{Form::checkbox('taskcom_notificaation', '1',isset($payment_detail['taskcom_notificaation']) && $payment_detail['taskcom_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'taskcom_notificaation'))}}
                                                              </div>
                                                          </div>
                                                        </div>
                                                     </div>

                                                 <div class="col-md-4">
                                                        <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                            <div class="mb-3 mb-sm-0">
                                                                <h6>{{Form::label('New Invoice',__('New Invoice'),['class'=>'form-label']) }}</h6>
                                                            </div>
                                                           <div class="text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                               {{Form::checkbox('invoice_notificaation', '1',isset($payment_detail['invoice_notificaation']) && $payment_detail['invoice_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'invoice_notificaation'))}}
                                                              </div>
                                                          </div>
                                                        </div>

                                                        <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                            <div class="mb-3 mb-sm-0">
                                                                <h6> {{Form::label('Invoice Status Updated',__('Invoice Status Updated'),['class'=>'form-label']) }}</h6>
                                                            </div>
                                                           <div class="text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {{Form::checkbox('invoicest_notificaation', '1',isset($payment_detail['invoicest_notificaation']) && $payment_detail['invoicest_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'invoicest_notificaation'))}}
                                                              </div>
                                                          </div>
                                                        </div>
                                                   </div>
                                        <div class=" text-end">
                                            {{Form::submit(__('Save Changes'),array('class'=>'btn btn-primary'))}}
                                        </div>
                                    </div>
                                </div>
                             </div>
                       </div>
                    </div>
                {{Form::close()}}
            </div>
         @endif
                @if(Auth::user()->type == 'user')
                      <div class="" id="telegram-settings">
                          {{Form::open(array('route'=>['workspace.settings.telegram', $currentWorkspace->slug],'method'=>'post','class'=>'d-contents'))}}
                           <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                        <div class="card-header">
                                        <h5 class="">
                                            {{ __('Telegram Settings') }}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                <div class="row company-setting">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                         {{Form::label('Telegram Access Token',__('Telegram Access Token'),['class'=>'form-label']) }}
                                       {{ Form::text('telegram_token', isset($payment_detail['telegram_token']) ?$payment_detail['telegram_token'] :'', ['class' => 'form-control', 'placeholder' => __('Enter Telegram Access Token'), 'required' => 'required']) }}     
                                       
                                    </div>

                                      <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                         {{Form::label('Telegram ChatID',__('Telegram ChatID'),['class'=>'form-label']) }}
                                       {{ Form::text('telegram_chatid',  isset($payment_detail['telegram_chatid']) ?$payment_detail['telegram_chatid'] :'', ['class' => 'form-control', 'placeholder' => __('Enter Telegram ChatID'), 'required' => 'required']) }}        
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                         {{Form::label('Module Settings',__('Module Settings'),['class'=>'form-control-label']) }}
                                       </div> 
                                   
                                    
                                    <div class="col-md-4 ">
                                              <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>  {{Form::label('New Project',__('New Project'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                          {{Form::checkbox('telegram_project_notificaation', '1',isset($payment_detail['telegram_project_notificaation']) && $payment_detail['telegram_project_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_project_notificaation'))}}</div>
                                                </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>   {{Form::label('New Task',__('New Task'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                          {{Form::checkbox('telegram_task_notificaation', '1',isset($payment_detail['telegram_task_notificaation']) && $payment_detail['telegram_task_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_task_notificaation'))}}</div>
                                                </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>      {{Form::label('Task Stage Updated',__('Task Stage Updated'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                           {{Form::checkbox('telegram_taskmove_notificaation', '1',isset($payment_detail['telegram_taskmove_notificaation']) && $payment_detail['telegram_taskmove_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_taskmove_notificaation'))}}</div>
                                                    </div>
                                                   </div>
                                                </div>

                                             <div class="col-md-4">
                                                <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>{{Form::label('New Milestone',__('New Milestone'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                          {{Form::checkbox('telegram_milestone_notificaation', '1',isset($payment_detail['telegram_milestone_notificaation']) && $payment_detail['telegram_milestone_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_milestone_notificaation'))}}</div>
                                                    </div>
                                                   </div>
                                                   <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>{{Form::label('Milestone Status Updated',__('Milestone Status Updated'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                           {{Form::checkbox('telegram_milestonest_notificaation', '1',isset($payment_detail['telegram_milestonest_notificaation']) && $payment_detail['telegram_milestonest_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_milestonest_notificaation'))}}</div>
                                                </div>
                                                </div>

                                                 <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>{{Form::label('New Task Comment',__('New Task Comment'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                            {{Form::checkbox('telegram_taskcom_notificaation', '1',isset($payment_detail['telegram_taskcom_notificaation']) && $payment_detail['telegram_taskcom_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_taskcom_notificaation'))}}</div>
                                                </div>
                                                </div>
                                        </div>
                                             <div class="col-md-4">
                                                   <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>  {{Form::label('New Invoice',__('New Invoice'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                            {{Form::checkbox('telegram_invoice_notificaation', '1',isset($payment_detail['telegram_invoice_notificaation']) && $payment_detail['telegram_invoice_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_invoice_notificaation'))}}</div>
                                                </div>
                                                </div>
                                                 <div class="d-flex align-items-center justify-content-between list_colume_notifi">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6> {{Form::label('Invoice Status Updated',__('Invoice Status Updated'),['class'=>'form-label']) }}</h6>
                                                    </div>
                                                   <div class="text-end">
                                                    <div class="form-check form-switch d-inline-block">
                                                           {{Form::checkbox('telegram_invoicest_notificaation', '1',isset($payment_detail['telegram_invoicest_notificaation']) && $payment_detail['telegram_invoicest_notificaation'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_invoicest_notificaation'))}}</div>
                                                </div>
                                                </div>
                                        </div>
                                    <div class=" text-end">
                                        {{Form::submit(__('Save Changes'),array('class'=>'btn btn-primary'))}}
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
                    {{Form::close()}}
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
    <script src="{{asset('assets/custom/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/custom/js/repeater.js')}}"></script>
    <script src="{{ asset('assets/custom/js/colorPick.js') }}"></script>
<script>
       var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>


 <script>
         function cust_theme_bg() {
            var custthemebg = document.querySelector("#cust-theme-bg");

            if (custthemebg.checked) {
                document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.add("transprent-bg");
            } else {
                document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.remove("transprent-bg");
            }

        }

        function cust_darklayout() {
            var custdarklayout = document.querySelector("#cust-darklayout");

            if (custdarklayout.checked) {
                document
                    .querySelector(".m-header > .b-brand > .logo-lg")
                    .setAttribute("src", "{{ asset('assets/images/logo.svg') }}");
                document
                    .querySelector("#main-style-link")
                    .setAttribute("href", "{{ asset('assets/css/style-dark.css') }}");
            } else {
                document
                    .querySelector(".m-header > .b-brand > .logo-lg")
                    .setAttribute("src", "{{ asset('assets/images/logo-dark.svg') }}");
                document
                    .querySelector("#main-style-link")
                    .setAttribute("href", "{{ asset('assets/css/style.css') }}");
            }

        }
</script>

<script src="{{asset('assets/js/pages/wow.min.js')}}"></script>
    <script>
        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener("scroll", function () {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
            } else if (cOst > ost) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
            document.querySelector(".navbar").classList.remove("default");
            } else {
            document.querySelector(".navbar").classList.add("default");
            document
                .querySelector(".navbar")
                .classList.remove("top-nav-collapse");
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: "animate__animated", // animation css class (default is animated)
        });
        wow.init();
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: "#navbar-example",
        });
    </script>

    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('iframe').attr('src', '{{url($currentWorkspace->slug.'/invoices/preview')}}/' + template + '/' + color);
        });

        $(document).ready(function () {

            var $dragAndDrop = $("body .task-stages tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeater = $('.task-stages').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('{{__('Are you sure ?')}}')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });


            var value = $(".task-stages").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

            var $dragAndDropBug = $("body .bug-stages tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeaterBug = $('.bug-stages').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('{{__('Are you sure ?')}}')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDropBug.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });


            var valuebug = $(".bug-stages").attr('data-value');
            if (typeof valuebug != 'undefined' && valuebug.length != 0) {
                valuebug = JSON.parse(valuebug);
                $repeaterBug.setList(valuebug);
            }
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
        });
    </script>


    <script>
        $('#logo').change(function(){
            
            let reader = new FileReader();
            reader.onload = (e) => { 
            $('#dark_logo').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        
        });

        $('#logo_white').change(function(){
            
            let reader = new FileReader();
            reader.onload = (e) => { 
            $('#image').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        
        });



        $('#small-favicon').change(function(){
            
            let reader = new FileReader();
            reader.onload = (e) => { 
            $('#favicon').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        
        });
     </script>




 <script>
     $(document).on('click', 'input[name="theme_color"]', function () {
         var eleParent = $(this).attr('data-theme');
         $('#themefile').val(eleParent);
         var imgpath = $(this).attr('data-imgpath');
         $('.' + eleParent + '_img').attr('src', imgpath);
     });

     $(document).ready(function () {
         setTimeout(function (e) {
             var checked = $("input[type=radio][name='theme_color']:checked");
             $('#themefile').val(checked.attr('data-theme'));
             $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
         }, 300);   
     });

     function check_theme(color_val) {
         $('.theme-color').prop('checked', false);
         $('input[value="'+color_val+'"]').prop('checked', true);
         $('#color_value').val(color_val);
     }
 </script>

 <script>
        $(document).ready(function () {
        cust_theme_bg();
        cust_darklayout();


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
        });

    </script>


<script>
        $(document).on("click", ".email-template-checkbox", function () {
            var chbox = $(this);
            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                        show_toastr('{{__("Success")}}', response.success, 'success');
                        if (chbox.val() == 1) {
                            $('#' + chbox.attr('id')).val(0);
                        } else {
                            $('#' + chbox.attr('id')).val(1);
                        }
                    } else {
                        show_toastr('{{__("Error")}}', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('{{__("Error")}}', response.error, 'error');
                    } else {
                        show_toastr('{{__("Error")}}', response, 'error');
                    }
                }
            })
        });

</script>





@endpush
