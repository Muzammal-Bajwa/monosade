<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>  

<?php $__env->startSection('page-title'); ?> <?php echo e(__('Login')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

                <div class="card" style="margin-bottom: 120px !important">
                <div class="row align-items-center text-start">
                    <div class="col-xl-6">
                        <div class="card-body">
                            <div class="">
                                <h2 class="mb-3 f-w-600"><?php echo e(__('Login')); ?></h2>
                            </div>
                             <?php if(env('RECAPTCHA_MODULE') != 'on'): ?>
                               <?php if($errors->any()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="text-danger"><?php echo e($error); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            <form method="POST" id="form_data" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label"><?php echo e(__('Email')); ?></label>
                                    <input type="email" class="form-control  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" id="emailaddress" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="<?php echo e(__('Enter Your Email')); ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" id="password" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                                </div> 
                                <div class="form-group mb-3 text-start">
                                      <a href="<?php echo e(route('password.request', $lang)); ?>" class=""><small><b><?php echo e(__('Forgot your password?')); ?></b></small></a>
                                </div>

                                   <?php if(env('RECAPTCHA_MODULE') == 'on'): ?>
                                    <div class="form-group col-lg-12 col-md-12 mt-3">
                                        <?php echo NoCaptcha::display(); ?>

                                        <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="small text-danger" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="d-grid">
                                    <button type="submit" id="login_button" class="btn btn-primary btn-block mt-2"><?php echo e(__('Login')); ?></button>
                                </div>
                               <!--  <p class="my-4 text-center">or register with</p> -->

                                    <?php if(env('signup_button') == 'on'): ?>
                                     <p class="my-4 text-center">Don't have an account? <a href="<?php echo e(route('register', $lang)); ?>" class="my-4 text-center text-primary"> Register</a></p>
                                    <?php endif; ?>
                                    </form>
 
                                      
                                       <!--  <div class="col-6 py-2 text-start">
                                            <button type="button" id="" class="btn btn-primary text-xs btn-block login-deafult"><a href="#" class="" style="color:#fff"><?php echo e(__('User Login')); ?></a></button>
                                        </div> -->
                                       <div class="d-grid mt-3">
                                            <button type="button" id="" class="btn btn-primary btn-block  "><a href="<?php echo e(route('client.login', $lang)); ?>" class="" style="color:#fff"> <?php echo e(__('Client Login')); ?></a></button>
                                        </div>             
                                  
                                    <div class="row mt-4">   
                                        <div class="">
                                             <?php $__env->startSection('language-bar'); ?>
                                            <a href="#" class="  btn-primary  ">
                                                <select name="language" id="language" class=" btn-primary btn " onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                    <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option class="login_lang" <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('login',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </a>
                                            <?php $__env->stopSection(); ?>
                                        </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 img-card-side">
                        <div class="auth-img-content">
                            <img src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>" alt="" class="img-fluid">
                            <h3 class="text-white mb-4 mt-5">“Attention is the new currency”</h3>
                            <p class="text-white">The more effortless the writing looks, the more effort the writer
                                actually put into the process.</p>
                        </div>
                    </div>
                </div>
    

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>

<script src="<?php echo e(asset('assets/custom/libs/jquery/dist/jquery.min.js')); ?>"></script>
<script>
$(document).ready(function () {
  $("#form_data").submit(function (e) {
      $("#login_button").attr("disabled", true);
      return true;
  });
});
</script>
<?php if(env('RECAPTCHA_MODULE') == 'on'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

<?php endif; ?>
<?php $__env->stopPush(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<style>
    .login-deafult {
    width: 139px !important;
}
    </style><?php /**PATH D:\wamp64\www\saas\resources\views/auth/login.blade.php ENDPATH**/ ?>