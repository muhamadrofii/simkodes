<div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-4">
    
    <div class="flex-grow-1">
        <h3 class="mb-1"><?php echo e($slot); ?></h3>

        
        <button type="button" class="btn btn-sm border-0 p-0 bg-transparent text-danger"
                data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="ti ti-logout"></i> Logout
        </button>
    </div>

    
    <div class="pt-2 pt-lg-0">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="https://pustakakoding.com/" class="text-dark text-decoration-none">
                        <i class="ti ti-home fs-5"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo e($slot); ?>

                </li>
            </ol>
        </nav>
    </div>
</div>


<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-sm">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar dari aplikasi?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-4" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger rounded-4">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/components/page-title.blade.php ENDPATH**/ ?>