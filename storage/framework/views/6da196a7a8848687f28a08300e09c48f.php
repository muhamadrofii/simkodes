<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
    <?php if (isset($component)) { $__componentOriginal8b54caccbdedc8030792c13949386bbd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b54caccbdedc8030792c13949386bbd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Dashboard <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b54caccbdedc8030792c13949386bbd)): ?>
<?php $attributes = $__attributesOriginal8b54caccbdedc8030792c13949386bbd; ?>
<?php unset($__attributesOriginal8b54caccbdedc8030792c13949386bbd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b54caccbdedc8030792c13949386bbd)): ?>
<?php $component = $__componentOriginal8b54caccbdedc8030792c13949386bbd; ?>
<?php unset($__componentOriginal8b54caccbdedc8030792c13949386bbd); ?>
<?php endif; ?>

    
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 d-block mt-xxl-n4">
                <img class="img-fluid px-xl-4 mt-xxl-n5" src="<?php echo e(asset('images/bgkop.svg')); ?>">
            </div>
            <div class="col-lg-9">
                <h4 class="mt-3 mt-lg-0 mb-2">Selamat datang di <strong>Pendataan Anggota Koperasi Merah Putih Desa Sranak</strong>!</h4>
                <p class="text-muted fw-light mb-4">
                    Platform ini dirancang untuk mempermudah proses pencatatan, pengelolaan, dan pemutakhiran data anggota secara digital, guna mendukung transparansi dan efisiensi layanan koperasi di lingkungan Desa Sranak
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="me-4">
                            <img src="<?php echo e(asset('/storage/public/categories/'.$category->image)); ?>" class="img-thumbnail rounded-4" width="50" alt="Images">
                        </div>
                        <div>
                            <p class="text-muted mb-1"><small>Kategori <?php echo e($category->name); ?></small></p>
                            <h5 class="fw-bold mb-0"><?php echo e($category->members_count); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/dashboard/index.blade.php ENDPATH**/ ?>