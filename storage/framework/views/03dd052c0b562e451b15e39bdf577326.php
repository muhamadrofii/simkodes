<?php if (isset($component)) { $__componentOriginal7ddf49af801524849d67e38f92bf39c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ddf49af801524849d67e38f92bf39c7 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\Guest::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.guest'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\Guest::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="mx-auto" style="max-width: 500px;">
            <div class="bg-white rounded-4 shadow-lg p-4 p-md-5 text-center">
                
                
                <div class="d-inline-flex align-items-center justify-content-center mb-4"
                     style="width: 180px; height: 180px; background-color: #0b1e3f; border-radius: 30px; overflow: hidden;">
                    <img src="<?php echo e(asset('images/logokop.svg')); ?>" 
                         alt="Logo Koperasi" 
                         class="logo-zoom"
                         style="width: 160px; height: 160px; object-fit: cover; transition: transform 0.4s ease;">
                </div>
                
                <h4 class="mb-4 text-dark">Masuk ke <strong>Pendataan Anggota</strong></h4>

                
                <?php if(session('error')): ?>
                    <div class="alert alert-danger rounded-3 py-2 px-3">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3 text-start">
                        <label class="form-label text-dark">Email</label>
                        <input type="email" name="email" class="form-control rounded-3" required autofocus>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label text-dark">Kata Sandi</label>
                        <input type="password" name="password" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3 form-check text-start">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label text-dark" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>

                    <p class="text-center text-muted mt-4 mb-0">
                        by <strong>Pengabdian Kepada Masyarakat - UNUGIRI</strong>
                    </p>
                </form>
            </div>
        </div>
    </div>

    
    <style>
        .logo-zoom:hover {
            transform: scale(1.1);
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ddf49af801524849d67e38f92bf39c7)): ?>
<?php $attributes = $__attributesOriginal7ddf49af801524849d67e38f92bf39c7; ?>
<?php unset($__attributesOriginal7ddf49af801524849d67e38f92bf39c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ddf49af801524849d67e38f92bf39c7)): ?>
<?php $component = $__componentOriginal7ddf49af801524849d67e38f92bf39c7; ?>
<?php unset($__componentOriginal7ddf49af801524849d67e38f92bf39c7); ?>
<?php endif; ?>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/auth/login.blade.php ENDPATH**/ ?>