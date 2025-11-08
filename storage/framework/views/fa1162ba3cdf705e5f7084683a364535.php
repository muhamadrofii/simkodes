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
<?php $component->withAttributes([]); ?>Data Pengurus <?php echo $__env->renderComponent(); ?>
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
        <div class="row">
            <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                
                <a href="<?php echo e(route('officers.create')); ?>" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-plus me-2"></i> Tambah Data Pengurus
                </a>
            </div>
            <div class="col-lg-7 col-xl-6">
                
                <form action="<?php echo e(route('officers.index')); ?>" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search" 
                               value="<?php echo e(request('search')); ?>" placeholder="Cari nama pengurus ..." autocomplete="off">
                        <button class="btn btn-primary btn-search" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <?php $__empty_1 = true; $__currentLoopData = $officers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $officer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <div class="col-lg-6 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm text-center p-4 mb-4">
                    

                    <h6><?php echo e($officer->nama); ?></h6>
                    
                    <p class="text-muted mb-4">
                        Kategori: <?php echo e($officer->category->name ?? 'Tidak Ada Kategori'); ?>

                    </p>

                    
                    <a href="<?php echo e(route('officers.show', $officer->id)); ?>" 
                       class="btn btn-primary btn-action-icon">
                        Detail <i class="ti ti-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <div class="col">
                <div class="alert alert-primary rounded-4 d-flex align-items-center" role="alert">
                    <i class="ti ti-info-circle fs-5 me-2"></i>
                    <div>Tidak Ada Data Pengurus.</div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="pagination-links mb-4">
        <?php echo e($officers->links()); ?>

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
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/officers/index.blade.php ENDPATH**/ ?>