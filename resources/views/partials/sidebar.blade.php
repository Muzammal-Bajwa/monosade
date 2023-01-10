       @php
         $logo=\App\Models\Utility::get_file('logo/');
         
        if(Auth::user()->type == 'admin')
        {
        $setting = App\Models\Utility::getAdminPaymentSettings();
        $company_logo = App\Models\Utility::get_logo();
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

            $company_logo = App\Models\Utility::getcompanylogo($currentWorkspace->id);



            if($company_logo == '' || $company_logo == null){
              $company_logo = App\Models\Utility::get_logo();
                     
           }


        }

           if($color == '' || $color == null){
              $settings = App\Models\Utility::getAdminPaymentSettings();
              $color = $settings['color'];           
           }

            

           if($dark_mode == '' || $dark_mode == null){
             $company_logo = App\Models\Utility::get_logo();
              $dark_mode = $settings['cust_darklayout'];
           }

           if($cust_theme_bg == '' || $dark_mode == null){
              $cust_theme_bg = $settings['cust_theme_bg'];
           }

            if($SITE_RTL == '' || $SITE_RTL == null){
              $SITE_RTL = env('SITE_RTL');
           }
      @endphp
       <!-- Menu -->

       <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="{{ route('home') }}" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <img src="{{asset('public/new_assets/assets/img/logo_main.png')}}" />
                            </span>
                            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>

                    <div class="menu-inner-shadow"></div>

                    <ul class="menu-inner py-1">
                        <!-- Dashboard -->
                        @if(\Auth::guard('client')->check())
              <li class="menu-item">
                <a href="{{route('client.home')}}" class="menu-link {{ (Request::route()->getName() == 'home' || Request::route()->getName() == NULL || Request::route()->getName() == 'client.home') ? ' active' : '' }}">
                <img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Dashboard') }}</div>
                </a>
              </li>
           @else
             <li class="menu-item">
                <a href="{{route('home')}}" class="menu-link  {{ (Request::route()->getName() == 'home' || Request::route()->getName() == NULL || Request::route()->getName() == 'client.home') ? ' active' : '' }}">
                <img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Dashboard') }}</div>
                </a>
              </li>
            @endif
            @if(isset($currentWorkspace) && $currentWorkspace)
            @auth('web')  
          <li class="menu-item">
            <a href="{{ route('users.index',$currentWorkspace->slug) }}" class="menu-link {{ (Request::route()->getName() == 'users.index') ? ' active' : '' }}"><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Users') }}</div></a>
          </li>
            @if($currentWorkspace->creater->id == Auth::user()->id)   
            <li class="menu-item">
                <a href="{{ route('clients.index',$currentWorkspace->slug) }}" class="menu-link {{ (Request::route()->getName() == 'clients.index') ? ' active' : '' }}"><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics"> {{ __('Clients') }}</div></a>
            </li>
            @endif  
          <li class="menu-item {{ (Request::route()->getName() == 'projects.index' || Request::segment(2) == 'projects') ? ' active' : '' }}">
            <a href="{{ route('projects.index',$currentWorkspace->slug) }}" class="menu-link"><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Projects') }}</div></a>
          </li>
          <li class="menu-item {{ (Request::route()->getName() == 'tasks.index') ? ' active' : '' }}">
            <a href="{{ route('tasks.index',$currentWorkspace->slug) }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Tasks') }}</div></a>
          </li>

          <li class="menu-item {{ (Request::route()->getName() == 'timesheet.index') ? ' active' : '' }}">
            <a href="{{route('timesheet.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Timesheet') }}</div></a>
          </li>
            @if(Auth::user()->type == 'user'&& $currentWorkspace->creater->id == Auth::user()->id)    
          <li class="menu-item {{\Request::route()->getName() == 'time.tracker'?'active':''}}">
            <a href="{{route('time.tracker',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Tracker') }}</div></a>
          </li>
           @endif  
          @if($currentWorkspace->creater->id == Auth::user()->id)
          <li class="menu-item {{ (Request::route()->getName() == 'invoices.index' || Request::segment(2) == 'invoices') ? ' active' : '' }}">
            <a href="{{ route('invoices.index',$currentWorkspace->slug) }}" class="menu-link"><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Invoices') }} </div></a>
          </li>
         @endif

                    @if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id)
                    <li class="menu-item {{ (Request::route()->getName() == 'contracts.index' || Request::route()->getName() == 'contracts.show') ? ' active' : '' }}">
                        <a href="#" class="menu-link"
                          ><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
                               <div data-i18n="Analytics">{{__('Contracts')}}</div
                          ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                        ></a>
                        <ul class="dash-submenu collapse  {{ (Request::route()->getName() == 'contracts.index') ? ' active' : '' }}">

                               <li class="menu-item {{ (Request::route()->getName() == 'contracts.index' || Request::route()->getName() == 'contracts.show') ? 'active' : '' }}">
                                    <a class="menu-link" href="{{route('contracts.index',$currentWorkspace->slug)}}">{{__('Contracts')}}</a>
                                </li>
                           
                                <li class="menu-item ">
                                    <a class="menu-link" href="{{route('contract_type.index',$currentWorkspace->slug)}}">{{__('Contract Type')}}</a>
                                </li>
                        </ul>
                    </li>
                    @endif
             

          <li class="menu-item {{ (Request::route()->getName() == 'calender.index') ? ' active' : '' }}">
            <a href="{{route('calender.index',$currentWorkspace->slug)}}" class="menu-link "> <img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Calendar') }}</div></a>
          </li>
          <li class="menu-item {{ (Request::route()->getName() == 'notes.index') ? ' active' : '' }}">
            <a href="{{route('notes.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Notes') }} </div></a>
          </li>
            @if(env('CHAT_MODULE') == 'on')
          <li class="menu-item {{ (Request::route()->getName() == 'chats') ? ' active' : '' }}">
            <a href="{{route('chats')}}" class="menu-link"><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Messenger') }}</div></a>
          
          </li>
            @endif
            <li class="menu-item {{ (Request::route()->getName() == 'project_report.index' || Request::segment(2) == 'project_report') ? ' active' : '' }}">
            <a href="{{ route('project_report.index',$currentWorkspace->slug) }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Project Report') }}</div></a>
          </li>
            <li class="menu-item {{ (Request::route()->getName() == 'zoom-meeting.index') ? ' active' : '' }}">
            <a href="{{route('zoom-meeting.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Zoom Meeting') }}</div></a>
      
          </li>
        @elseauth
            <li class="menu-item {{ (Request::route()->getName() == 'client.projects.index' || Request::segment(3) == 'projects') ? ' active' : '' }}">
            <a href="{{ route('client.projects.index',$currentWorkspace->slug) }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Projects') }}</div></a>
          </li>

            <li class="menu-item {{ (Request::route()->getName() == 'client.timesheet.index') ? ' active' : '' }}">
            <a href="{{route('client.timesheet.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Timesheet') }}</div></a>
          </li>

          <li class="menu-item {{ (Request::route()->getName() == 'client.invoices.index') ? ' active' : '' }}">
            <a href="{{ route('client.invoices.index',$currentWorkspace->slug) }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Invoices') }} </div></a>
          </li>

            <li class="menu-item {{ (Request::route()->getName() == 'client.project_report.index' || Request::segment(3) == 'project_report') ? ' active' : '' }}">
            <a href="{{ route('client.project_report.index',$currentWorkspace->slug) }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Project Report') }}</div></a>
          </li>


           <li class="menu-item {{ (Request::route()->getName() == 'client.contracts.index' || Request::route()->getName() == 'client.contracts.show') ? 'active' : '' }}">
            <a href="{{route('client.contracts.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Contracts') }}</div></a>
          </li>


          <li class="menu-item {{ (Request::route()->getName() == 'client.calender.index') ? ' active' : '' }}">
            <a href="{{route('client.calender.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Calendar') }}</div></a>
          </li>

          <li class="menu-item {{ (Request::route()->getName() == 'client.zoom-meeting.index') ? ' active' : '' }}">
            <a href="{{route('client.zoom-meeting.index',$currentWorkspace->slug)}}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Zoom Meeting') }}</div></a>
      
          </li>
           @endauth
                @endif

           @if(Auth::user()->type == 'admin')       
             <li class="menu-item {{ (Request::route()->getName() == 'users.index') ? ' active' : '' }}">
            <a href="{{ route('users.index','') }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Users') }}</div></a>
            </li>    
          @endif
            @if((Auth::user()->type == 'admin' || (isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id)) && Auth::user()->getGuard() != 'client')
             
            <li class="menu-item {{ (Request::route()->getName() == 'plans.index') ? ' active' : '' }}">
            <a href="{{ route('plans.index') }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Plans') }}</div></a>
            </li>


          <li class="menu-item {{ (Request::route()->getName() == 'order.index') ? ' active' : '' }}">
            <a href="{{ route('order.index') }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Orders') }}</div></a>
          </li>
          @if(Auth::user()->type == 'admin')
          <li class="menu-item {{ request()->is('plan_request*') ? 'active' : '' }}">
            <a href="{{ route('plan_request.index') }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{__('Plan Request')}}</div></a>
          
          </li>
            @endif
         @endif

      

         @if(Auth::user()->type == 'admin')

           <li class="menu-item {{ (Request::route()->getName() == 'coupons.index' || Request::segment(1) == 'coupons') ? ' active' : '' }}">
            <a href="{{ route('coupons.index') }}" class="menu-link ">
            <img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">>{{ __('Coupons') }}</div></a>
          </li>

          <li class="menu-item {{ (Request::route()->getName() == 'lang_workspace') ? ' active' : '' }}">
            <a href="{{ route('lang_workspace') }}" class="menu-link ">
            <img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">>{{ __('Languages') }}</div></a>
          </li>
            <li class="menu-item {{(Request::route()->getName() == 'email_template*' || Request::segment(1) == 'email_template_lang') ? ' active' : '' }}">
                <a class="menu-link" href="{{route('email_template.index')}}">
                <img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">>{{ __('Email Templates') }}</div>
                </a>
            </li>
           <li class="menu-item {{ (Request::route()->getName() == 'settings.index') ? ' active' : '' }}">
              <a href="{{ route('settings.index') }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics"> {{ __('Settings') }}</div></a>
            </li>

         @endif
         @if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id && Auth::user()->getGuard() != 'client')

          <li class="menu-item {{ (Request::route()->getName() == 'workspace.settings') ? ' active' : '' }}">
            <a href="{{ route('workspace.settings',$currentWorkspace->slug) }}" class="menu-link "><img class="menu-icon tf-icons" src="{{asset('public/new_assets/assets/img/icons/linear/message.svg')}}" />
            <div data-i18n="Analytics">{{ __('Settings') }}</div></a>
          </li>
         @endif
                    </ul>
                </aside>
                <!-- / Menu -->