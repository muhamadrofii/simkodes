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
<?php $component->withAttributes([]); ?>Detail Kategori <?php echo $__env->renderComponent(); ?>
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
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
            <div class="d-grid gap-3 d-sm-flex">
                
                <a href="<?php echo e(route('categories.edit', $category->id)); ?>" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                
                <button type="button" class="btn btn-danger btn-action-icon" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo e($category->id); ?>"> 
                    <i class="ti ti-trash me-2"></i> Hapus
                </button>
            </div>
            
            <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-secondary btn-action-icon me-sm-auto">
                <i class="ti ti-chevron-left me-2"></i> Tutup
            </a>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        
        <div class="d-flex flex-column flex-xl-row">
            <div class="flex-shrink-0 mb-4 mb-xl-0">
                <img src="<?php echo e(asset('/storage/public/categories/'.$category->image)); ?>" class="img-thumbnail rounded-5 shadow-sm" width="100" alt="Image">
            </div>
            <div class="flex-grow-1 pt-2 ms-xl-4">
                <h6 class="text-muted fw-light mb-2">Nama</h6>
                <p class="mb-4"><?php echo e($category->name); ?></p>
            
                <h6 class="text-muted fw-light mb-2">Deskripsi</h6>
                <p style="text-align: justify" class="mb-4 fw-light"><?php echo e($category->description); ?></p>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalDelete<?php echo e($category->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="ti ti-trash me-2"></i> Hapus Kategori
                    </h1>
                </div>
                <div class="modal-body">
                    
                    <p class="mb-2">
                        Anda Akan Menghapus Kategori : <span class="fw-medium mb-2"><?php echo e($category->name); ?></span>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action-icon" data-bs-dismiss="modal">Batal</button>
                    
                    <form action="<?php echo e(route('categories.destroy', $category->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-action-icon"> Ya, Hapus ini ! </button>
                    </form>
                </div>
            </div>
        </div>
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
<?php endif; ?><?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/categories/show.blade.php ENDPATH**/ ?>