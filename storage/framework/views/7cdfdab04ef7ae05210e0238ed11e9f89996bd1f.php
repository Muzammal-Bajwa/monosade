<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plans')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('links'); ?>
    <?php if(\Auth::guard('client')->check()): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('client.home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <?php else: ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <?php endif; ?>
    <li class="breadcrumb-item"> <?php echo e(__('plans')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(Auth::user()->type == 'admin'): ?>
        <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Add Plan')); ?>"
            data-toggle="tooltip" title="<?php echo e(__('Add Plan')); ?>" data-url="<?php echo e(route('plans.create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<style type="text/css">
    .price-card .p-price {
        font-size: 44px !important;
    }

</style>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3">

                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body">
                        <div class="text-end">
                            <?php if((isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on') || (isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on') || (isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on') || (isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on') || (isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on') || (isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on') || (isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on') || (isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on') || (isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on') || (isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on')): ?>
                                <span class="btn btn-sm btn-primary">
                                    <a href="#" class="" data-url="<?php echo e(route('plans.edit', $plan->id)); ?>"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip"
                                        data-size="lg" title="<?php echo e(__('Edit')); ?>">
                                        <span class=""> <i class="ti ti-pencil text-white"></i></span>

                                    </a></span>
                            <?php endif; ?>
                        </div>

                        <span class="price-badge bg-primary"> <?php echo e($plan->name); ?></span>

                        <span
                            class="mb-4 f-w-600 p-price"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->monthly_price); ?>

                            <small class="text-sm">/<?php echo e(__('Monthly Price')); ?></small></span><br>
                        <span
                            class="mb-4 f-w-600 p-price"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->annual_price); ?>

                            <small class="text-sm">/<?php echo e(__('Annual Price')); ?></small></span>

                        <p class="mb-0">
                            <?php echo e($plan->description); ?>

                        </p>
                        <ul class="list-unstyled my-5">
                            <?php if($plan->id != 1): ?>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>

                                    <?php echo e($plan->trial_days < 0 ? __('Unlimited') : $plan->trial_days); ?>

                                    <?php echo e(__('Trial Days')); ?>


                                </li>
                            <?php endif; ?>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->max_workspaces < 0 ? __('Unlimited') : $plan->max_workspaces); ?>

                                <?php echo e(__('Workspaces')); ?>

                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->max_users < 0 ? __('Unlimited') : $plan->max_users); ?>

                                <?php echo e(__('Users Per Workspace')); ?>

                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->max_clients < 0 ? __('Unlimited') : $plan->max_clients); ?>

                                <?php echo e(__('Clients Per Workspace')); ?>

                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->max_projects < 0 ? __('Unlimited') : $plan->max_projects); ?>

                                <?php echo e(__('Projects Per Workspace')); ?>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\saas\resources\views/plans/admin.blade.php ENDPATH**/ ?>