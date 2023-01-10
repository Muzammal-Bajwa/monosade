@extends('layouts.admin')

@section('page-title') {{__('Projects')}} @endsection
@section('links')
@if(\Auth::guard('client')->check())
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
 @else
 <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
 @endif
<li class="breadcrumb-item"> {{ __('Projects') }}</li>
@endsection

@php
    $logo=\App\Models\Utility::get_file('users-avatar/');

@endphp
@section('action-button')
    @auth('web')

     <!-- <a href="{{ route('project.export') }}"  class="btn btn-sm btn-primary "  data-toggle="tooltip" title="{{ __('Export Project') }}"
                > <i class="ti ti-file-x"></i></a>

                <a href="#"  class="btn btn-sm btn-primary mx-1" data-ajax-popup="true" data-title="{{__('Import Project')}}" data-url="{{ route('project.file.import' ,$currentWorkspace->slug) }}"  data-toggle="tooltip" title="{{ __('Import Project') }}"><i class="ti ti-file-import"></i> </a> -->

        @if(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id())
            <!-- <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="{{ __('Create New Project') }}" data-url="{{route('projects.create',$currentWorkspace->slug)}}" data-toggle="tooltip" title="{{ __('Add Project') }}">
                <i class="ti ti-plus"></i>
            </a> -->
          @endif
               
    @endauth
@endsection

@section('content')
        @if($projects && $currentWorkspace)
        <div class="search_bar">
            <!-- Search -->
              <div class="navbar-nav align-items-center search">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->
              @auth('web')
              @if(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id())
              <a href="{{ route('projects.create', 'xpat') }}" class="blue_btn">
                <i class='bx bx-plus'></i>
                New Project
              </a>
              @endif
             @endauth
          </div>
            <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y project_page">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <h2>Active Projects <span>(3)</span></h2>
                  <div class="row">
                    @foreach ($projects as $project)
                     <div class="col-lg-3 col-sm-6 col-12">
                      <div class="pro_card">
                        <div class="pr_header">
                          <div class="title_pr">
                            <a href="projects-details.html">
                              <span><img src="assets/img/book.png" alt=""></span>
                              <h3>
                                {{ $project->name }} 
                                <span>Logo Design</span>
                            </h3>
                            </a>
                          </div>
                          <a href="#"><img src="assets/img/status.png" alt=""></a>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-edit-alt me-1"></i> Repeat Order</a
                              >
                             <a href="#" class="dropdown-item text-danger bs-pass-para" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="leave-form-{{$project->id}}">
                                <i class="bx bx-trash me-1"></i> Delete Project</a>
                              <form id="leave-form-{{$project->id}}" action="{{ route('projects.leave',[$currentWorkspace->slug,$project->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            </div>
                          </div>
                        </div>
                        <div class="pr_body">
                          <p>{{ $project->description }}</p>
                        </div>
                        <div class="pr_footer">
                          <div class="files">
                            <h5><i class='bx bxs-file' ></i>{{$project->countTask()}}</h5>
                            <h5><i class='bx bxs-message-detail' ></i>{{$project->countTaskComments()}}</h5>
                          </div>
                          <span class="in_progress">{{$project->status}}</span>
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
            </div>
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
@endsection

@push('css-page')
@endpush

@push('scripts')
    <script src="{{asset('assets/custom/js/isotope.pkgd.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('.status-filter button').click(function () {
                $('.status-filter button').removeClass('active');
                $(this).addClass('active');

                var data = $(this).attr('data-filter');
                $grid.isotope({
                    filter: data
                })
            });

            var $grid = $(".grid").isotope({
                itemSelector: ".All",
                percentPosition: true,
                masonry: {
                    columnWidth: ".All"
                }
            })
        });
    </script>

@endpush
