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
    <div class="mx-auto" style="max-width: 500px;">
        <div class="bg-white rounded-4 shadow-sm p-4 p-md-5">
            <h4 class="mb-4">Daftar di <strong>Pendataan Anggota</strong></h4>

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Daftar</button>

                <p class="text-center text-muted mt-4 mb-0">
                    Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Masuk</a>
                </p>
            </form>
        </div>
    </div>
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
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/auth/register.blade.php ENDPATH**/ ?>