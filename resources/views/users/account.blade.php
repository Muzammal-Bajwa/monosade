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
   <!-- Content -->

    <!-- Content -->
    @php
    $workspace = $currentWorkspace ? $currentWorkspace->id : 0 ;
    $user_id = $user? $user->id:0;
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="profile_bg">
                                        <div class="profile_card">
                                            <div class="left_inner">
                                                <div class="profile_icon">
                                                <img @if($user->avatar) src="{{asset($logo.$user->avatar)}}" @else avatar="{{ $user->name }}" @endif id="myAvatar" alt="user-image">
                                                    <!-- <a href="#"><i class='bx bxs-pencil'></i></a> -->
                                                </div>
                                                <span>
                                                    <h3>{{$user->name}} </h3>
                                                    <p>{{$user->email}}</p>
                                                </span>
                                            </div>
                                            <div class="right_inner">
                                                <a href="{{ route('users.edit.account') }}"><i class='bx bxs-edit' ></i> Edit Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="infoCard">
                                        <div class="card-header">
                                            <h3>Profile Information</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                <li>
                                                    <label for="">Full Name</label>
                                                    {{$user->name}}
                                                </li>
                                                <li>
                                                    <label for="">Mobile</label>
                                                    {{$user->phone_no}}  {{$user->phone_code}}
                                                </li>
                                                <li>
                                                    <label for="">Email</label>
                                                    {{$user->email}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="infoCard">
                                        <div class="card-header">
                                            <h3>My team</h3>
                                            <a href="{{ route('clients.index' , [$workspace]) }}">View All</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="teams">
                                                @foreach ($clients as $client)
                                                <div class="member">
                                                    <div class="rt_side">
                                                        <img src="assets/img/Profil.png" alt="">
                                                        <h5>{{$client->email}}<p>{{$client->name}}</p></h5>
                                                    </div>
                                                    <div class="lt_side">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="projectCard">
                                        <div class="pr_card_header">
                                            <h3>Projects <br/><p>Your recent projects...</p></h3>
                                            <a href="{{ route('projects.index' , [$workspace]) }}">View All</a>
                                        </div>
                                        <div class="pr_card_body">
                                            <div class="row">
                                            @foreach ($projects as $project)
                                                <div class="col-lg-3 col-sm-6 col-12">
                                                    <div class="pro_card">
                                                    <div class="pr_header">
                                                      <div class="title_pr">
                                                        <a href="projects-details.html">
                                                          <span><img src="assets/img/book.png" alt=""></span>
                                                          <h3> {{$project->name}} <span>Logo Design</span></h3>
                                                        </a>
                                                      </div>
                                                      <a href="#"><img src="{{asset('public/new_assets/assets/img/status.png')}}" alt=""></a>
                                                      <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                          <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('projects.edit',[$currentWorkspace->slug,$project->id]) }}"
                                                                ><i class="bx bx-edit-alt me-1"></i> edit project</a
                                                            >
                                                            <a href="javascript:void(0)" class="dropdown-item text-danger bs-pass-para" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="leave-form-{{$project->id}}">
                                                                <i class="bx bx-trash me-1"></i> Delete Project</a>
                                                            <form id="leave-form-{{$project->id}}" action="{{ route('projects.leave',[$currentWorkspace->slug,$project->id]) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            </div>
                                                      </div>
                                                    </div>
                                                    <div class="pr_body">
                                                      <p> {{$project->description}}</p>
                                                    </div>
                                                    <div class="pr_footer">
                                                      <div class="files">
                                                        <h5><i class='bx bxs-file' ></i> 5</h5>
                                                        <h5><i class='bx bxs-message-detail' ></i> 8</h5>
                                                      </div>
                                                      <span class="in_progress"> {{$project->status}}</span>
                                                    </div>
                                                  </div>
                                                </div>
                                                @endforeach
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->@endsection
@push('scripts')

              <script type="text/javascript">
                    $('#avatar').change(function(){
                       
                    let reader = new FileReader();
                    reader.onload = (e) => { 
                      $('#myAvatar').attr('src', e.target.result); 
                    }
                    reader.readAsDataURL(this.files[0]); 
                  
                   });
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