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
<?php $component->withAttributes([]); ?>📘 Buku Inventaris <?php echo $__env->renderComponent(); ?>
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
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-semibold text-secondary mb-0">Daftar Barang Inventaris</h5>
            <a href="<?php echo e(route('inventories.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Barang
            </a>
        </div>

        
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light border-bottom border-2">
                    <tr class="text-secondary">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total Harga (Rp)</th>
                        <th>Umur Teknis</th>
                        <th>Umur Ekonomis</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td class="fw-semibold"><?php echo e($item->nama_barang); ?></td>
                            <td><?php echo e($item->tanggal); ?></td>
                            <td><?php echo e($item->jumlah); ?></td>
                            <td><?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></td>
                            <td><?php echo e(number_format($item->total_harga, 0, ',', '.')); ?></td>
                            <td><?php echo e($item->umur_teknis); ?></td>
                            <td><?php echo e($item->umur_ekonomis); ?></td>
                            <td class="text-wrap"><?php echo e($item->keterangan); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    
                                    <a href="<?php echo e(route('inventories.show', $item->id)); ?>" 
                                    class="btn btn-info btn-sm text-white d-flex align-items-center gap-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    
                                    <a href="<?php echo e(route('inventories.edit', $item->id)); ?>" 
                                    class="btn btn-warning btn-sm d-flex align-items-center gap-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>

                                    
                                    <button type="button" class="btn btn-danger btn-sm d-flex align-items-center gap-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal<?php echo e($item->id); ?>">
                                        <i class="bi bi-trash"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>


                                
                                <div class="modal fade" id="deleteModal<?php echo e($item->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($item->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fw-semibold text-danger" id="deleteModalLabel<?php echo e($item->id); ?>">
                                                    Hapus Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin mau hapus <strong><?php echo e($item->nama_barang); ?></strong> dari daftar inventaris?</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="<?php echo e(route('inventories.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="10" class="text-muted py-4">Belum ada data inventaris.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/inventories/index.blade.php ENDPATH**/ ?>