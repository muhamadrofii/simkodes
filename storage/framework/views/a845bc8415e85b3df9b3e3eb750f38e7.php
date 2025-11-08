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
<?php $component->withAttributes([]); ?>Detail Pengurus <?php echo $__env->renderComponent(); ?>
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
                <a href="<?php echo e(route('officers.edit', $officer->id)); ?>" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-action-icon" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo e($officer->id); ?>">
                    <i class="ti ti-trash me-2"></i> Hapus
                </button>
            </div>
            <a href="<?php echo e(route('officers.index')); ?>" class="btn btn-secondary btn-action-icon me-sm-auto">
                <i class="ti ti-chevron-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex flex-column flex-xl-row align-items-start">
            
            <div class="col-md-4 text-center mb-4 mb-xl-0">
                <?php if($officer->image): ?>
                    <img src="<?php echo e(asset('storage/public/officers/' . $officer->image)); ?>"
                         class="img-thumbnail rounded-5 shadow-sm"
                         width="150"
                         alt="<?php echo e($officer->nama); ?>">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/default-profile.png')); ?>"
                         class="img-thumbnail rounded-5 shadow-sm"
                         width="150"
                         alt="Default">
                <?php endif; ?>

                
                <?php if($officer->ttd): ?>
                    <div class="mt-3">
                        <img src="<?php echo e(asset('storage/officers/' . $officer->ttd)); ?>"
                             class="img-thumbnail rounded-4 shadow-sm"
                             width="120"
                             alt="TTD">
                        <p class="text-muted small mt-1 mb-0">Tanda Tangan</p>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="flex-grow-1 ms-xl-5 w-100">
                <div class="table-responsive">
                    <table class="table table-striped lh-lg">
                        <tr><td width="220">Kategori</td><td width="10">:</td><td><?php echo e($officer->category->name ?? '-'); ?></td></tr>
                        <tr><td>Nama Lengkap</td><td>:</td><td><?php echo e($officer->nama); ?></td></tr>
                        <tr><td>Jenis Kelamin</td><td>:</td><td><?php echo e($officer->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td></tr>
                        <tr><td>Umur</td><td>:</td><td><?php echo e($officer->umur ?? '-'); ?></td></tr>
                        <tr><td>Jabatan</td><td>:</td><td><?php echo e($officer->jabatan ?? '-'); ?></td></tr>
                        <tr><td>No. Anggota Koperasi</td><td>:</td><td><?php echo e($officer->no_anggota_koperasi ?? '-'); ?></td></tr>
                        <tr><td>Tempat Tinggal</td><td>:</td><td><?php echo e($officer->tempat_tinggal ?? '-'); ?></td></tr>
                        <tr><td>Tanggal Diangkat</td><td>:</td><td><?php echo e($officer->tanggal_diangkat ? date('d-m-Y', strtotime($officer->tanggal_diangkat)) : '-'); ?></td></tr>
                        <tr><td>Tanggal Berhenti</td><td>:</td><td><?php echo e($officer->tanggal_berhenti ? date('d-m-Y', strtotime($officer->tanggal_berhenti)) : '-'); ?></td></tr>
                        <tr><td>Keterangan</td><td>:</td><td><?php echo e($officer->keterangan ?? '-'); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalDelete<?php echo e($officer->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><i class="ti ti-trash me-2"></i> Hapus Data</h1>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong><?php echo e($officer->nama); ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action-icon" data-bs-dismiss="modal">Batal</button>
                    <form action="<?php echo e(route('officers.destroy', $officer->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-action-icon">Ya, hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <a href="<?php echo e(route('officers.kta', $officer->id)); ?>" class="btn btn-success btn-action-icon mt-3">
        <i class="ti ti-printer me-2"></i> Cetak KTA
    </a>
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
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/officers/show.blade.php ENDPATH**/ ?>