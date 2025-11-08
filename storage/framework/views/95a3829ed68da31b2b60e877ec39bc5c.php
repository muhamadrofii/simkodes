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
<?php $component->withAttributes([]); ?>Incoming Letter Details <?php echo $__env->renderComponent(); ?>
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
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Judul</label>
                <div class="form-control bg-light"><?php echo e($letter->title); ?></div>
            </div>

            
            <div class="col-md-6">
                <label class="form-label fw-semibold">No. Surat</label>
                <div class="form-control bg-light"><?php echo e($letter->ref_number ?? '-'); ?></div>
            </div>

            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Kategori</label>
                <div class="form-control bg-light"><?php echo e($letter->category ?? '-'); ?></div>
            </div>

            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Attached File</label>
                <?php if($letter->file): ?>
                    <div class="border rounded p-3 bg-light d-flex align-items-center justify-content-between">
                        <a href="<?php echo e(asset($letter->file)); ?>" target="_blank" class="text-decoration-none">
                            <?php echo e(basename($letter->file)); ?>

                        </a>
                        <i class="ti ti-file-text fs-5 text-primary"></i>
                    </div>
                <?php else: ?>
                    <div class="form-control bg-light">No file uploaded.</div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="pt-4 border-top mt-4 d-flex justify-content-between">
            <a href="<?php echo e(route('incomingletters.index')); ?>" class="btn btn-secondary">
                ← Back
            </a>
            <div class="d-flex gap-2">
                <a href="<?php echo e(route('incomingletters.edit', $letter->id)); ?>" class="btn btn-warning">
                    <i class="ti ti-edit me-1"></i> Edit
                </a>

                
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="ti ti-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                    <p class="mb-0">Yakin, Ingin Hapus File ini ? <strong><?php echo e($letter->title); ?></strong>?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <form action="<?php echo e(route('incomingletters.destroy', $letter->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="ti ti-trash me-1"></i> Hapus
                        </button>
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
<?php endif; ?>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/letters/incoming/show.blade.php ENDPATH**/ ?>