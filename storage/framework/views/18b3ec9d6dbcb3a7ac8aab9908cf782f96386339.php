<?php
    $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
        ->where('seen', 0)
        ->count();
    $logo = \App\Models\Utility::get_file('users-avatar/');
?>
<?php
    if (Auth::user()->type == 'admin') {
        $setting = App\Models\Utility::getAdminPaymentSettings();
        if ($setting['color']) {
            $color = $setting['color'];
        } else {
            $color = 'theme-3';
        }
        $dark_mode = $setting['cust_darklayout'];
        $cust_theme_bg = $setting['cust_theme_bg'];
        $SITE_RTL = env('SITE_RTL');
    } else {
        $setting = App\Models\Utility::getcompanySettings($currentWorkspace->id);
        $color = $setting->theme_color;
        $dark_mode = $setting->cust_darklayout;
        $SITE_RTL = $setting->site_rtl;
        $cust_theme_bg = $setting->cust_theme_bg;
    }
    
    if ($color == '' || $color == null) {
        $settings = App\Models\Utility::getAdminPaymentSettings();
        $color = $settings['color'];
    }
    
    if ($dark_mode == '' || $dark_mode == null) {
        $dark_mode = $settings['cust_darklayout'];
    }
    
    if ($cust_theme_bg == '' || $dark_mode == null) {
        $cust_theme_bg = $settings['cust_theme_bg'];
    }
    
    if ($SITE_RTL == '' || $SITE_RTL == null) {
        $SITE_RTL = env('SITE_RTL');
    }
?>


<style type="text/css">
    .top_header {
        left: auto !important;
        top: 60px !important;
    }
</style>
<header class="dash-header <?php echo e(isset($cust_theme_bg) && $cust_theme_bg == 'on' ? 'transprent-bg' : ''); ?>">

    <div class="header-wrapper">
        <div class="dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php if(Auth::user()->type != 'admin'): ?>
                    <li class="dropdown dash-h-item">
                        <a class="dash-head-link dropdown-toggle arrow-none ms-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown drp-search drp-search-custom">
                            <form class="form-inline mr-auto mb-0">
                                <div class="search-element">
                                    <input class="" type="type here" placeholder="Search here. . ."
                                        aria-label="Search">

                                    <div class="search-backdrop"></div>
                                </div>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img class="theme-avtar"<?php if(Auth::user()->avatar): ?> src="<?php echo e(asset($logo . Auth::user()->avatar)); ?>" <?php else: ?> avatar="<?php echo e(Auth::user()->name); ?>" <?php endif; ?>
                            alt="<?php echo e(Auth::user()->name); ?>">
                        <span class="hide-mob ms-2"><?php echo e(__('Hi')); ?>,<?php echo e(Auth::user()->name); ?> !</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">


                        <?php $__currentLoopData = Auth::user()->workspace; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workspace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($workspace->is_active): ?>
                                <a href="<?php if($currentWorkspace->id == $workspace->id): ?> #<?php else: ?> <?php if(auth()->guard('web')->check()): ?><?php echo e(route('change-workspace', $workspace->id)); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.change-workspace', $workspace->id)); ?><?php endif; ?> <?php endif; ?>"
                                    title="<?php echo e($workspace->name); ?>" class="dropdown-item">
                                    <?php if($currentWorkspace->id == $workspace->id): ?>
                                        <i class="ti ti-checks text-success"></i>
                                    <?php endif; ?>
                                    <span><?php echo e($workspace->name); ?></span>

                                    <?php if(isset($workspace->pivot->permission)): ?>
                                        <?php if($workspace->pivot->permission == 'Owner'): ?>
                                            <span
                                                class="badge bg-primary"><?php echo e(__($workspace->pivot->permission)); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-dark"><?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                                <a href="#" class="dropdown-item" title="<?php echo e(__('Locked')); ?>">
                                    <i class="ti ti-lock"></i>
                                    <span><?php echo e($workspace->name); ?></span>
                                    <?php if(isset($workspace->pivot->permission)): ?>
                                        <?php if($workspace->pivot->permission == 'Owner'): ?>
                                            <span
                                                class="badge badge-success-primary"><?php echo e(__($workspace->pivot->permission)); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-dark"><?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!--   <hr class="dropdown-divider" /> -->
                        <?php if(auth()->guard('web')->check()): ?>
                            <?php if(Auth::user()->type == 'user'): ?>
                                <a href="#!" class="dropdown-item" data-toggle="modal"
                                    data-target="#modelCreateWorkspace">
                                    <i class="ti ti-circle-plus"></i>
                                    <span><?php echo e(__('Create New Workspace')); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>


                        <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                            <?php if(auth()->guard('web')->check()): ?>
                                <?php if(Auth::user()->id == $currentWorkspace->created_by): ?>
                                    <a href="#" class="dropdown-item bs-pass-para"
                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="remove-workspace-form">
                                        <i class="ti ti-circle-x"></i>
                                        <span><?php echo e(__('Remove Me From This Workspace')); ?></span>
                                    </a>
                                    <form id="remove-workspace-form"
                                        action="<?php echo e(route('delete-workspace', ['id' => $currentWorkspace->id])); ?>"
                                        method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php else: ?>
                                    <a href="#" class="dropdown-item bs-pass-para"
                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="remove-workspace-form">
                                        <i class="ti ti-circle-x"></i>
                                        <span><?php echo e(__('Leave Me From This Workspace')); ?></span>
                                    </a>
                                    <form id="remove-workspace-form"
                                        action="<?php echo e(route('leave-workspace', ['id' => $currentWorkspace->id])); ?>"
                                        method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <a href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('users.my.account')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.users.my.account')); ?><?php endif; ?>"
                            class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                        <!--   <?php if(env('CHAT_MODULE') == 'on'): ?>
                  <?php if(\Auth::user()->type == 'user'): ?>
<a href="<?php echo e(url('chats')); ?>" class="dropdown-item">
                 <i class="ti ti-message-circle"></i>
                  <span><?php echo e(__('Chats')); ?></span>
                </a>
<?php endif; ?>
                <?php endif; ?> -->
                        <a href="#"
                            class="dropdown-item "onclick="event.preventDefault();document.getElementById('logout-form1').submit();">
                            <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="logout-form1"
                            action="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('logout')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.logout')); ?><?php endif; ?>"
                            method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>


            </ul>
        </div>
        <!-- Brand + Toggler (for mobile devices) -->

        <div class="ms-auto">
            <ul class="list-unstyled">

                <?php if(env('CHAT_MODULE') == 'on'): ?>
                    <?php if(\Auth::user()->type == 'user'): ?>
                        <li class="dash-h-item">
                            <a class="dash-head-link me-0" href="<?php echo e(url('chats')); ?>">
                                <i class="ti ti-message-circle"></i>
                                <span
                                    class="bg-danger dash-h-badge message-counter custom_messanger_counter"><?php echo e($unseenCounter); ?><span
                                        class="sr-only"></span>
                                </span></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>




                


                
                <?php ($currantLang = basename(App::getLocale())); ?>
                
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob"><?php echo e(Str::upper($currantLang)); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        <?php if(\Auth::guard('client')->check()): ?>
                            <?php $__currentLoopData = $currentWorkspace->languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('change_lang_workspace1', [$currentWorkspace->id, $lang])); ?>"
                                    class="dropdown-item <?php echo e($currantLang == $lang ? 'text-danger' : ''); ?>">
                                    <span><?php echo e(Str::upper($lang)); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(\Auth::user()->type == 'admin'): ?>
                            <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('change_lang_admin', $lang)); ?>"
                                    class="dropdown-item <?php echo e($currantLang == $lang ? 'text-danger' : ''); ?>">
                                    <span><?php echo e(Str::upper($lang)); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php elseif(isset($currentWorkspace) && $currentWorkspace && (\Auth::guard('web')->check())): ?> 
                            <?php $__currentLoopData = $currentWorkspace->languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('change_lang_workspace', [$currentWorkspace->id, $lang])); ?>"
                                    class="dropdown-item <?php echo e($currantLang == $lang ? 'text-danger' : ''); ?>">
                                    <span><?php echo e(Str::upper($lang)); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH D:\wamp64\www\saas\resources\views/partials/topnav.blade.php ENDPATH**/ ?>