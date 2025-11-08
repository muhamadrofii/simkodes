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
<?php $component->withAttributes([]); ?>Detail Barang Inventaris <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b54caccbdedc8030792c13949386bbd)): ?>
<?php $attributes = $__attributesOriginal8b54caccbdedc8030792c13949386bbd; ?>
<?php unset($__attributesOriginal8b54caccbdedc8030792c13949386bbd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b54caccbdedc8030792c13949386bbd)): ?>
<?php $component = $__componentOriginal8b54caccbdedc8030792c13949386bbd; ?>
<?php unset($__componentOriginal8b54caccbdedc8030792c13949386bbd); ?>
<?php endif; ?>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <h5 class="fw-semibold text-secondary mb-4">Informasi Barang</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <div class="form-control bg-light"><?php echo e($inventory->nama_barang); ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Pembelian</label>
                <div class="form-control bg-light"><?php echo e($inventory->tanggal); ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Jumlah</label>
                <div class="form-control bg-light"><?php echo e($inventory->jumlah); ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                <div class="form-control bg-light"><?php echo e(number_format($inventory->harga_satuan, 0, ',', '.')); ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Total Harga (Rp)</label>
                <div class="form-control bg-light"><?php echo e(number_format($inventory->total_harga, 0, ',', '.')); ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Umur Teknis</label>
                <div class="form-control bg-light"><?php echo e($inventory->umur_teknis); ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Umur Ekonomis</label>
                <div class="form-control bg-light"><?php echo e($inventory->umur_ekonomis); ?></div>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Keterangan</label>
                <div class="form-control bg-light"><?php echo e($inventory->keterangan); ?></div>
            </div>
        </div>

        <div class="pt-3 border-top">
            <a href="<?php echo e(route('inventories.index')); ?>" class="btn btn-secondary">← Kembali</a>
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
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/inventories/show.blade.php ENDPATH**/ ?>