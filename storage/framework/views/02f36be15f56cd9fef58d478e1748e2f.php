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
<?php $component->withAttributes([]); ?>Surat Keluar <?php echo $__env->renderComponent(); ?>
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
        <div class="row align-items-center justify-content-between g-3">
            
            <div class="col-md-6 col-lg-5">
                <a href="<?php echo e(route('outgoingletters.create')); ?>" class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Surat Keluar
                </a>
            </div>

            
            <div class="col-md-6 col-lg-7">
                <form action="<?php echo e(route('outgoingletters.index')); ?>" method="GET" class="d-flex">
                    <input 
                        type="text"
                        name="search"
                        class="form-control rounded-start"
                        placeholder="Search incoming letter..."
                        value="<?php echo e(request('search')); ?>"
                        autocomplete="off">
                    <button class="btn btn-primary rounded-end ms-0" type="submit">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $outgoingletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm p-4 text-center h-100">
                    <div class="mb-3">
                        <i class="ti ti-mail text-primary fs-1"></i>
                    </div>
                    <h6 class="fw-semibold mb-1"><?php echo e($letter->title); ?></h6>
                    <p class="text-muted small mb-1">No. Surat: <?php echo e($letter->reference_number); ?></p>
                    <p class="text-muted small mb-3">Kategori : <?php echo e($letter->category); ?></p>
                    <a href="<?php echo e(route('outgoingletters.show', $letter->id)); ?>" class="btn btn-primary btn-sm">
                        Detail <i class="ti ti-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info d-flex align-items-center rounded-4 shadow-sm" role="alert">
                    <i class="ti ti-info-circle fs-5 me-2"></i>
                    <div>No data available.</div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="d-flex justify-content-center mt-5">
        
        <?php echo e($outgoingletters->appends(['search' => request('search')])->links('pagination::bootstrap-5')); ?>

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
<?php endif; ?>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/letters/outgoing/index.blade.php ENDPATH**/ ?>