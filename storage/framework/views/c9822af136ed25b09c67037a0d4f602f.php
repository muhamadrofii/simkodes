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
<?php $component->withAttributes([]); ?>Filter <?php echo $__env->renderComponent(); ?>
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
        
        <div class="alert alert-secondary rounded-4 mb-5" role="alert">
            <i class="ti ti-calendar-search fs-5 me-2"></i> Filter Berdasarkan Tanggal Bergabung.
        </div>
        
        <form action="<?php echo e(route('report.filter')); ?>" method="GET" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
                    <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="text" name="start_date" class="form-control datepicker <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('start_date', request('start_date'))); ?>" autocomplete="off">
                        
                    
                    <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-2">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <label class="form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                    <input type="text" name="end_date" class="form-control datepicker <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('end_date', request('end_date'))); ?>" autocomplete="off">
                        
                    
                    <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-2">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
    
            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    
                    <button type="submit" class="btn btn-primary btn-action">
                        Tampilkan <i class="ti ti-chevron-right ms-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php if(request(['start_date', 'end_date'])): ?>
        <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
            <div class="d-flex flex-column flex-lg-row mb-4">
                <div class="flex-grow-1 d-flex align-items-center">
                    
                    <h6 class="mb-0">
                        <i class="ti ti-file-text fs-5 align-text-top me-1"></i> 
                        Data Aggota Per <?php echo e(date('F j, Y', strtotime(request('start_date')))); ?> - <?php echo e(date('F j, Y', strtotime(request('end_date')))); ?>.
                    </h6>
                </div>
                <div class="d-grid gap-3 d-sm-flex mt-3 mt-lg-0">
                    
                    <a href="<?php echo e(route('report.print', [request('start_date'), request('end_date')])); ?>" target="_blank" class="btn btn-warning btn-action-icon">
                        <i class="ti ti-printer me-2"></i> Cetak
                    </a>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4">

            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover lh-lg" style="width:100%">
                    <thead>
                        <th class="text-center fw-medium">No.</th>
                        <th class="text-center fw-medium">Kategori</th>
                        <th class="text-center fw-medium">Tanggal Bergabung</th>
                        <th class="text-center fw-medium">Nama Lengkap</th>
                        <th class="text-center fw-medium">Jenis Kelamin</th>
                        <th class="text-center fw-medium">Alamat</th>
                        <th class="text-center fw-medium">Email</th>
                        <th class="text-center fw-medium">Nomor Telepon</th>
                    </thead>
                    <tbody class="fs-7">
                    <?php
                        $no = 1;
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <tr>
                            <td width="30" class="text-center"><?php echo e($no++); ?></td>
                            <td width="100" class="text-center"><?php echo e($member->category->name); ?></td>
                            <td width="150" class="text-center"><?php echo e(date('F j, Y', strtotime($member->join_date))); ?></td>
                            <td width="200"><?php echo e($member->full_name); ?></td>
                            <td width="60" class="text-center"><?php echo e($member->gender); ?></td>
                            <td width="250"><?php echo e($member->address); ?></td>
                            <td width="60"><?php echo e($member->email); ?></td>
                            <td width="60" class="text-center"><?php echo e($member->phone_number); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        
                        <tr>
                            <td colspan="8">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="ti ti-info-circle fs-5 me-2"></i>
                                    <div>Tidak ada data.</div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/report/index.blade.php ENDPATH**/ ?>