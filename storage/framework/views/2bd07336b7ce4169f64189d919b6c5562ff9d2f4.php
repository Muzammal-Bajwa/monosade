       <?php
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
      ?>
      <nav class="dash-sidebar light-sidebar <?php echo e((isset($cust_theme_bg) && $cust_theme_bg == 'on') ? 'transprent-bg':''); ?>">
    <div class="navbar-wrapper">
      <div class="m-header main-logo">
        <a href="<?php echo e(route('home')); ?>" class="b-brand">
          <!-- ========   change your logo hear   ============ -->
           <img src="<?php echo e(asset($logo.$company_logo)); ?>" alt="logo" class="sidebar_logo_size" />
        </a>
      </div>
      <div class="navbar-content">
        <ul class="dash-navbar">
           <?php if(\Auth::guard('client')->check()): ?>
              <li class="dash-item dash-hasmenu">
                <a href="<?php echo e(route('client.home')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == NULL || Request::route()->getName() == 'client.home') ? ' active' : ''); ?>">
                  <span class="dash-micon"><i class="ti ti-home"></i></span>
                  <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                </a>
              </li>
           <?php else: ?>
             <li class="dash-item dash-hasmenu">
                <a href="<?php echo e(route('home')); ?>" class="dash-link  <?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == NULL || Request::route()->getName() == 'client.home') ? ' active' : ''); ?>">
                  <span class="dash-micon"><i class="ti ti-home"></i></span>
                  <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
            <?php if(auth()->guard('web')->check()): ?>  
          <li class="dash-item dash-hasmenu">
            <a href="<?php echo e(route('users.index',$currentWorkspace->slug)); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>"><span class="dash-micon"> <i data-feather="user"></i></span><span
                    class="dash-mtext"><?php echo e(__('Users')); ?></span></a>
          </li>
            <?php if($currentWorkspace->creater->id == Auth::user()->id): ?>   
            <li class="dash-item dash-hasmenu">
                <a href="<?php echo e(route('clients.index',$currentWorkspace->slug)); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'clients.index') ? ' active' : ''); ?>"><span class="dash-micon"> <i class="ti ti-brand-python"></i></span><span
                        class="dash-mtext"> <?php echo e(__('Clients')); ?></span></a>
            </li>
            <?php endif; ?>  
          <li class="dash-item <?php echo e((Request::route()->getName() == 'projects.index' || Request::segment(2) == 'projects') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('projects.index',$currentWorkspace->slug)); ?>" class="dash-link"><span class="dash-micon"> <i data-feather="briefcase"></i></span><span
                    class="dash-mtext"><?php echo e(__('Projects')); ?></span></a>
          </li>
          <li class="dash-item <?php echo e((Request::route()->getName() == 'tasks.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('tasks.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="list"></i></span><span
                    class="dash-mtext"><?php echo e(__('Tasks')); ?></span></a>
          </li>

          <li class="dash-item <?php echo e((Request::route()->getName() == 'timesheet.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('timesheet.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="clock"></i></span><span
                    class="dash-mtext"><?php echo e(__('Timesheet')); ?></span></a>
          </li>
            <?php if(Auth::user()->type == 'user'&& $currentWorkspace->creater->id == Auth::user()->id): ?>    
          <li class="dash-item <?php echo e(\Request::route()->getName() == 'time.tracker'?'active':''); ?>">
            <a href="<?php echo e(route('time.tracker',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="watch"></i></span><span
                    class="dash-mtext"><?php echo e(__('Tracker')); ?></span></a>
          </li>
           <?php endif; ?>  
          <?php if($currentWorkspace->creater->id == Auth::user()->id): ?>
          <li class="dash-item <?php echo e((Request::route()->getName() == 'invoices.index' || Request::segment(2) == 'invoices') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('invoices.index',$currentWorkspace->slug)); ?>" class="dash-link"><span class="dash-micon"><i data-feather="printer"></i></span><span
                    class="dash-mtext"><?php echo e(__('Invoices')); ?> </span></a>
          </li>
         <?php endif; ?>

                    <?php if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::route()->getName() == 'contracts.index' || Request::route()->getName() == 'contracts.show') ? ' active' : ''); ?>">
                        <a href="#" class="dash-link"
                          ><span class="dash-micon"><i class="ti ti-device-floppy"></i></span
                          ><span class="dash-mtext"><?php echo e(__('Contracts')); ?></span
                          ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                        ></a>
                        <ul class="dash-submenu collapse  <?php echo e((Request::route()->getName() == 'contracts.index') ? ' active' : ''); ?>">

                               <li class="dash-item <?php echo e((Request::route()->getName() == 'contracts.index' || Request::route()->getName() == 'contracts.show') ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('contracts.index',$currentWorkspace->slug)); ?>"><?php echo e(__('Contracts')); ?></a>
                                </li>
                           
                                <li class="dash-item ">
                                    <a class="dash-link" href="<?php echo e(route('contract_type.index',$currentWorkspace->slug)); ?>"><?php echo e(__('Contract Type')); ?></a>
                                </li>
                        </ul>
                    </li>
                    <?php endif; ?>
             

          <li class="dash-item <?php echo e((Request::route()->getName() == 'calender.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('calender.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="calendar"></i></span><span
                    class="dash-mtext"><?php echo e(__('Calendar')); ?></span></a>
          </li>
          <li class="dash-item <?php echo e((Request::route()->getName() == 'notes.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('notes.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="clipboard"></i></span><span
                    class="dash-mtext"><?php echo e(__('Notes')); ?> </span></a>
          </li>
            <?php if(env('CHAT_MODULE') == 'on'): ?>
          <li class="dash-item <?php echo e((Request::route()->getName() == 'chats') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('chats')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-message-circle"></i></span><span
                    class="dash-mtext"><?php echo e(__('Messenger')); ?></span></a>
          
          </li>
            <?php endif; ?>
            <li class="dash-item <?php echo e((Request::route()->getName() == 'project_report.index' || Request::segment(2) == 'project_report') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('project_report.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i class="ti ti-chart-line"></i></span><span
                class="dash-mtext"><?php echo e(__('Project Report')); ?></span></a>
          </li>
            <li class="dash-item <?php echo e((Request::route()->getName() == 'zoom-meeting.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('zoom-meeting.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="video"></i></span><span
                class="dash-mtext"><?php echo e(__('Zoom Meeting')); ?></span></a>
      
          </li>
        <?php elseif(auth()->guard()->check()): ?>
            <li class="dash-item <?php echo e((Request::route()->getName() == 'client.projects.index' || Request::segment(3) == 'projects') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('client.projects.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="briefcase"></i></span><span
                class="dash-mtext"><?php echo e(__('Projects')); ?></span></a>
          </li>

            <li class="dash-item <?php echo e((Request::route()->getName() == 'client.timesheet.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('client.timesheet.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="clock"></i></span><span
                class="dash-mtext"><?php echo e(__('Timesheet')); ?></span></a>
          </li>

          <li class="dash-item <?php echo e((Request::route()->getName() == 'client.invoices.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('client.invoices.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="printer"></i></span><span
                class="dash-mtext"><?php echo e(__('Invoices')); ?> </span></a>
          </li>

            <li class="dash-item <?php echo e((Request::route()->getName() == 'client.project_report.index' || Request::segment(3) == 'project_report') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('client.project_report.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i class="ti ti-chart-line"></i></span><span
                class="dash-mtext"><?php echo e(__('Project Report')); ?></span></a>
          </li>


           <li class="dash-item <?php echo e((Request::route()->getName() == 'client.contracts.index' || Request::route()->getName() == 'client.contracts.show') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('client.contracts.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i class="ti ti-device-floppy"></i></span><span
                class="dash-mtext"><?php echo e(__('Contracts')); ?></span></a>
          </li>


          <li class="dash-item <?php echo e((Request::route()->getName() == 'client.calender.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('client.calender.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="calendar"></i></span><span
                class="dash-mtext"><?php echo e(__('Calendar')); ?></span></a>
          </li>

          <li class="dash-item <?php echo e((Request::route()->getName() == 'client.zoom-meeting.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('client.zoom-meeting.index',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="video"></i></span><span
                    class="dash-mtext"><?php echo e(__('Zoom Meeting')); ?></span></a>
      
          </li>
           <?php endif; ?>
                <?php endif; ?>

           <?php if(Auth::user()->type == 'admin'): ?>       
             <li class="dash-item <?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('users.index','')); ?>" class="dash-link "><span class="dash-micon"> <i data-feather="user"></i></span><span
                class="dash-mtext"><?php echo e(__('Users')); ?></span></a>
            </li>    
          <?php endif; ?>
            <?php if((Auth::user()->type == 'admin' || (isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id)) && Auth::user()->getGuard() != 'client'): ?>
             
            <li class="dash-item <?php echo e((Request::route()->getName() == 'plans.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('plans.index')); ?>" class="dash-link "><span class="dash-micon"> <i class="ti ti-trophy"></i></span><span
                class="dash-mtext"><?php echo e(__('Plans')); ?></span></a>
            </li>


          <li class="dash-item <?php echo e((Request::route()->getName() == 'order.index') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('order.index')); ?>" class="dash-link "><span class="dash-micon"><i data-feather="credit-card"></i></span><span class="dash-mtext"><?php echo e(__('Orders')); ?></span></a>
          </li>
          <?php if(Auth::user()->type == 'admin'): ?>
          <li class="dash-item <?php echo e(request()->is('plan_request*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link "><span class="dash-micon"><i class="ti ti-brand-telegram"></i></span><span
                    class="dash-mtext"><?php echo e(__('Plan Request')); ?></span></a>
          
          </li>
            <?php endif; ?>
         <?php endif; ?>

      

         <?php if(Auth::user()->type == 'admin'): ?>

           <li class="dash-item <?php echo e((Request::route()->getName() == 'coupons.index' || Request::segment(1) == 'coupons') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link "><span class="dash-micon"> <i class="ti ti-tag"></i></span><span
                class="dash-mtext"><?php echo e(__('Coupons')); ?></span></a>
          </li>

          <li class="dash-item <?php echo e((Request::route()->getName() == 'lang_workspace') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('lang_workspace')); ?>" class="dash-link "><span class="dash-micon"><i class="ti ti-world nocolor"></i></span><span
                class="dash-mtext"><?php echo e(__('Languages')); ?></span></a>
          </li>
            <li class="dash-item <?php echo e((Request::route()->getName() == 'email_template*' || Request::segment(1) == 'email_template_lang') ? ' active' : ''); ?>">
                <a class="dash-link" href="<?php echo e(route('email_template.index')); ?>">
                    <span class="dash-micon"><i class="ti ti-mail"></i></span><span class="dash-mtext"><?php echo e(__('Email Templates')); ?></span>
                </a>
            </li>
           <li class="dash-item <?php echo e((Request::route()->getName() == 'settings.index') ? ' active' : ''); ?>">
              <a href="<?php echo e(route('settings.index')); ?>" class="dash-link "><span class="dash-micon"><i data-feather="settings"></i></span><span
                  class="dash-mtext"> <?php echo e(__('Settings')); ?></span></a>
            </li>

         <?php endif; ?>
         <?php if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id && Auth::user()->getGuard() != 'client'): ?>

          <li class="dash-item <?php echo e((Request::route()->getName() == 'workspace.settings') ? ' active' : ''); ?>">
            <a href="<?php echo e(route('workspace.settings',$currentWorkspace->slug)); ?>" class="dash-link "><span class="dash-micon"><i data-feather="settings"></i></span><span
                    class="dash-mtext"><?php echo e(__('Settings')); ?></span></a>
          </li>
         <?php endif; ?>
        

      </div>
    </div>
  </nav><?php /**PATH D:\wamp64\www\saas\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>