<?php $__env->startSection('page-title'); ?> <?php echo e(__('Coupons')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('links'); ?>
<?php if(\Auth::guard('client')->check()): ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('client.home')); ?>"><?php echo e(__('Home')); ?></a></li>
 <?php else: ?>
 <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
 <?php endif; ?>
<li class="breadcrumb-item"> <?php echo e(__('Coupon')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <a href="#" class="btn btn-sm btn-primary" data-toggle="tooltip" title="<?php echo e(__('Add Coupon')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Add Coupon')); ?>" data-url="<?php echo e(route('coupons.create')); ?>">
        <i class="ti ti-plus"></i>
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Code')); ?></th>
                                <th> <?php echo e(__('Discount (%)')); ?></th>
                                <th> <?php echo e(__('Limit')); ?></th>
                                <th> <?php echo e(__('Used')); ?></th>
                                <th> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($coupon->name); ?></td>
                                    <td><?php echo e($coupon->code); ?></td>
                                    <td><?php echo e($coupon->discount); ?></td>
                                    <td><?php echo e($coupon->limit); ?></td>
                                    <td><?php echo e($coupon->used_coupon()); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('coupons.show',$coupon->id)); ?>" class="action-btn btn-warning  btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" title="<?php echo e(__('Show')); ?>">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn btn-info  btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('coupons.edit',$coupon->id)); ?>" data-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"     data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Coupon')); ?>">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <a href="#" class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center bs-pass-para" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="delete-form-<?php echo e($coupon->id); ?>" data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"            >
                                            <i class="ti ti-trash"></i>
                                        </a>




                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['coupons.destroy',$coupon->id],'id'=>'delete-form-'.$coupon->id]); ?>

                                        <?php echo Form::close(); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\saas\resources\views/coupon/index.blade.php ENDPATH**/ ?>