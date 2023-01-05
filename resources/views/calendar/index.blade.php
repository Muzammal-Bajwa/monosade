@extends('layouts.admin')
<style type="text/css">
    .modal-body{
    background: #fff !important;
        padding: 25px !important;
    }
</style>
@section('page-title') {{__('Calendar')}} @endsection
@section('links')
@if(\Auth::guard('client')->check())   
<li class="breadcrumb-item"><a href="{{route('client.home')}}">{{__('Home')}}</a></li>
 @else
 <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
 @endif
<li class="breadcrumb-item"> {{ __('Calendar') }}</li>
@endsection

@php
$logo=\App\Models\Utility::get_file('avatars/');
$logo_tasks=\App\Models\Utility::get_file('tasks/');
@endphp


@section('multiple-action-button')
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 pt-lg-3 pt-xl-2">
        <div class=" form-group col-auto">
        <select class="  form-select select2" id="projects" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="@auth('web'){{route('calender.index',$currentWorkspace->slug)}}@else{{route('client.calender.index',$currentWorkspace->slug)}}@endif">{{__('All Projects')}}</option>
            @foreach($projects as $project)
                <option value="@auth('web'){{route('calender.index',$currentWorkspace->slug)}}@else{{route('client.calender.index',$currentWorkspace->slug)}}@endif{{ '/'.$project->id }}" @if($project_id == $project->id) selected @endif>{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
</div>
@endsection
         @section('content')
                    <div class="row">
                        <!-- [ sample-page] start -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Calendar</h5>
                                </div>
                                <div class="card-body">
                                    <div id='calendar' class='calendar'></div>
                                </div>
                            </div>
                        </div>

                         <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4">Tasks</h4>
                                        <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                            @php
                                            $date = Carbon\Carbon::now()->format('m');
                                            $this_month_task = App\Models\task::get();
                                            @endphp

                                            @foreach($this_month_task as $task)
                                             @php
                                             $month =date('m', strtotime($task->start_date));
                                            @endphp
                                            @if($date == $month)
                                            <li class="list-group-item card mb-3">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="fa fa-tasks"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                            <h6 class="m-0">{{$task->title}}</h6>
                                                            <small class="text-muted">{{$task->start_date}} to {{$task->due_date}}</small>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </li>  
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                           </div>
@endsection
@if($currentWorkspace)
    @push('scripts')

    
        <script>
     (function () {
        var etitle;
        var etype;
        var etypeclass;
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
            timeGridDay: "{{__('Day')}}",
            timeGridWeek: "{{__('Week')}}",
            dayGridMonth: "{{__('Month')}}"
        },
            themeSystem: 'bootstrap',
            slotDuration: '00:10:00',
            navLinks: true,
            droppable: true,
            selectable: true,
            selectMirror: true,
            editable: true,
            dayMaxEvents: true,
            handleWindowResize: true,
            events: {!! json_encode($arrayJson) !!},
        });
        calendar.render();
    })();
            @auth('web')
            $(document).on('click', '#form-comment button', function (e) {
                var comment = $("#form-comment textarea[name='comment']");
                if ($.trim(comment.val()) != '') {
                    $.ajax({
                        url: $("#form-comment").data('action'),
                        data: {comment: comment.val()},
                        type: 'POST',
                        success: function (data) {
                            data = JSON.parse(data);

                            if (data.user_type == 'Client') {
                                var avatar = "avatar='" + data.client.name + "'";
                                var html = "<li class='media border-bottom mb-3'>" +
                                    "                    <img class='mr-3 avatar-sm rounded-circle img-thumbnail' width='60' " + avatar + " alt='" + data.client.name + "'>" +
                                    "                    <div class='media-body mb-2'>" +
                                    "                        <h5 class='mt-0 mb-1 form-control-label'>" + data.client.name + "</h5>" +
                                    "                        " + data.comment +
                                    "                    </div>" +
                                    "                </li>";
                            } else {
                                var avatar = (data.user.avatar) ? "src='{{$logo}}/" + data.user.avatar + "'" : "avatar='" + data.user.name + "'";
                                var html = "<li class='media border-bottom mb-3'>" +
                                    "                    <img class='mr-3 avatar-sm rounded-circle img-thumbnail' width='60' " + avatar + " alt='" + data.user.name + "'>" +
                                    "                    <div class='media-body mb-2'>" +
                                    "                           <div class='float-left'>" +
                                    "                               <h5 class='mt-0 mb-1 form-control-label'>" + data.user.name + "</h5>" +
                                    "                               " + data.comment +
                                    "                           </div>" +
                                    "                           <div class='float-right'>" +
                                    "                               <a href='#' class='delete-icon' data-url='" + data.deleteUrl + "'>" +
                                    "                                   <i class='fas fa-trash'></i>" +
                                    "                               </a>" +
                                    "                           </div>" +
                                    "                    </div>" +
                                    "                </li>";
                            }

                            $("#comments").prepend(html);
                            $("#form-comment textarea[name='comment']").val('');
                            show_toastr('{{__('Success')}}', '{{ __("Comment Added Successfully!")}}', 'success');
                        },
                        error: function (data) {
                            show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    });
                } else {
                    comment.focus();
                    show_toastr('{{__('Error')}}', '{{ __("Please write comment!")}}', 'error');
                }
            });
            $(document).on("click", ".delete-comment", function () {
                if (confirm('{{__('Are you sure ?')}}')) {
                    var btn = $(this);
                    $.ajax({
                        url: $(this).attr('data-url'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        success: function (data) {
                            show_toastr('{{__('Success')}}', '{{ __("Comment Deleted Successfully!")}}', 'success');
                            btn.closest('.media').remove();
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            if (data.message) {
                                show_toastr('{{__('Error')}}', data.message, 'error');
                            } else {
                                show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                            }
                        }
                    });
                }
            });
            $(document).on('click', '#form-subtask .create-subtask', function (e) {
                e.preventDefault();

                var name = $('#form-subtask input[name="name"]');
                var due_date = $('#form-subtask input[name="due_date"]');

                if ($.trim(name.val()) != '' && due_date.val() != '') {
                    $.ajax({
                        url: $("#form-subtask").data('action'),
                        type: 'POST',
                        data: {
                            name: name.val(),
                            due_date: due_date.val()
                        },
                        dataType: 'json',
                        success: function (data) {

                            show_toastr('{{__('Success')}}', '{{ __("Sub Task Added Successfully!")}}', 'success');

                            var html = '<li class="list-group-item py-3">' +
                                '                                <label class="custom-control custom-switch float-left">' +
                                '                                    <input type="checkbox" class="custom-control-input" name="option" id="option" value="' + data.id + '" data-url="' + data.updateUrl + '">' +
                                '                                    <label class="custom-control-label form-control-label" for="option">' + data.name + '</label>' +
                                '                                </label>' +
                                '                                <div class="float-right">' +
                                '                                    <a href="#" class="delete-icon delete-subtask" data-url="' + data.deleteUrl + '">' +
                                '                                        <i class="fas fa-trash"></i>' +
                                '                                    </a>' +
                                '                                </div>' +
                                '                            </li>';
                            $("#subtasks").prepend(html);
                            name.val('');
                            due_date.val('');
                            $("#form-subtask").collapse('toggle');
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            if (data.message) {
                                show_toastr('{{__('Error')}}', data.message, 'error');
                                $('#file-error').text(data.errors.file[0]).show();
                            } else {
                                show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                            }
                        }
                    });
                } else {
                    name.focus();
                    show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                }
            });
            $(document).on("change", "#subtasks input[type=checkbox]", function () {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        show_toastr('{{__('Success')}}', '{{ __("Subtask Updated Successfully!")}}', 'success');
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('{{__('Error')}}', data.message, 'error');
                        } else {
                            show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            });
            $(document).on("click", ".delete-subtask", function () {
                if (confirm('{{__('Are you sure ?')}}')) {
                    var btn = $(this);
                    $.ajax({
                        url: $(this).attr('data-url'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        success: function (data) {
                            show_toastr('{{__('Success')}}', '{{ __("Subtask Deleted Successfully!")}}', 'success');
                            btn.closest('.list-group-item').remove();
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            if (data.message) {
                                show_toastr('{{__('Error')}}', data.message, 'error');
                            } else {
                                show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                            }
                        }
                    });
                }
            });
       $(document).on('submit', '#form-file', function (e) {
       
                e.preventDefault();

                $.ajax({
                    url: $("#form-file").data('url'),
                    type: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        show_toastr('{{__('Success')}}', '{{ __("File Upload Successfully!")}}', 'success');
                        // console.log(data);
                        var delLink = '';

                        if (data.deleteUrl.length > 0) {
                            delLink = "<a href='#' class=' action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-comment delete-icon delete-comment-file'  data-url='" + data.deleteUrl + "'>" +
                                "                                        <i class='ti ti-trash'></i>" +
                                "                                    </a>";
                        }

                        var html = "<div class='card mb-1 shadow-none border'>" +

                            "                        <div class='card-body p-3'>" +

                            "                            <div class='row align-items-center'>" +

                            "                                <div class='col-auto'>" +

                            "                                    <div class='avatar-sm'>" +

                            "                                        <span class='avatar-title rounded text-uppercase'>" +
                             "<img class='preview_img_size' " + "src='{{$logo_tasks}}/" + data.file + "'>"
                           +
                            "                                        </span>" +
                            "                                    </div>" +
                            "                                </div>" +
                            "                                <div class='col pl-0'>" +
                            "                                    <a href='#' class='text-muted form-control-label'>" + data.name + "</a>" +
                            "                                    <p class='mb-0'>" + data.file_size + "</p>" +
                            "                                </div>" +
                            "                                <div class='col-auto'>" +
                            "                                    <a download href='{{$logo_tasks}}/" + data.file + "' class='edit-icon action-btn btn-primary  btn btn-sm d-inline-flex align-items-center'>" +
                            "                                        <i class='ti ti-download'></i>" +
                            "                                    </a>" +

                                                               
                            "                                   <a  href='{{$logo_tasks}}/" + data.file + "' class='edit-icon action-btn btn-secondary  btn btn-sm d-inline-flex align-items-center mx-1'>" +
                            "                                        <i class='ti ti-crosshair text-white'></i>" +
                            "                                    </a>" +









                            delLink +
                            "                                </div>" +
                            "                            </div>" +
                            "                        </div>" +
                            "                    </div>";
                        $("#comments-file").prepend(html);
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('{{__('Error')}}', data.message, 'error');
                            $('#file-error').text(data.errors.file[0]).show();
                        } else {
                            show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            });
            $(document).on("click", ".delete-comment-file", function () {
                if (confirm('{{__('Are you sure ?')}}')) {
                    var btn = $(this);
                    $.ajax({
                        url: $(this).attr('data-url'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        success: function (data) {
                            show_toastr('{{__('Success')}}', '{{ __("File Deleted Successfully!")}}', 'success');
                            btn.closest('.border').remove();
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            if (data.message) {
                                show_toastr('{{__('Error')}}', data.message, 'error');
                            } else {
                                show_toastr('{{__('Error')}}', '{{ __("Some Thing Is Wrong!")}}', 'error');
                            }
                        }
                    });
                }
            });
            @endauth

        </script>
    @endpush
@endif
