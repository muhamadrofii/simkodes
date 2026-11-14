{{-- Native Bootstrap 5 Notification Modal (Zero External Dependency) --}}
@php
    $hasNotification = session('success') || session('error') || session('warning') || session('import_errors') || $errors->any();
    $modalType = 'info';
    $modalIcon = 'ti-info-circle text-primary';
    $modalTitle = 'Informasi';
    $modalButtonClass = 'btn-primary';
    $modalButtonStyle = 'background: #001f3f; border-color: #001f3f;';
    $modalButtonText = 'Tutup';

    if (session('error')) {
        $modalType = 'error';
        $modalIcon = 'ti-alert-circle text-danger';
        $modalTitle = auth()->check() ? 'Terjadi Kesalahan' : 'Gagal Masuk / Terjadi Kesalahan';
        $modalButtonClass = 'btn-primary';
        $modalButtonStyle = 'background: #001f3f; border-color: #001f3f;';
        $modalButtonText = auth()->check() ? 'Tutup' : 'Tutup / Coba Lagi';
    } elseif ($errors->any()) {
        $modalType = 'validation';
        $modalIcon = 'ti-alert-triangle text-danger';
        $modalTitle = 'Validasi Gagal';
        $modalButtonClass = 'btn-primary';
        $modalButtonStyle = 'background: #001f3f; border-color: #001f3f;';
        $modalButtonText = 'Perbaiki Data';
    } elseif (session('warning') || session('import_errors')) {
        $modalType = 'warning';
        $modalIcon = 'ti-alert-triangle text-warning';
        $modalTitle = session('import_errors') ? 'Perhatian: Hasil Import Data' : 'Peringatan';
        $modalButtonClass = 'btn-warning text-dark';
        $modalButtonStyle = '';
        $modalButtonText = 'Mengerti';
    } elseif (session('success')) {
        $modalType = 'success';
        $modalIcon = 'ti-circle-check text-success';
        $modalTitle = 'Berhasil!';
        $modalButtonClass = 'btn-success';
        $modalButtonStyle = '';
        $modalButtonText = 'Selesai';
    }
@endphp

@if ($hasNotification)
    <div class="modal fade" id="statusNotificationModal" tabindex="-1" aria-labelledby="statusNotificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content border-0 rounded-4 shadow-lg p-3 p-sm-4 text-center">
                <div class="modal-body p-0">
                    {{-- Icon Container with Subtle Background --}}
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                        style="width: 72px; height: 72px; background: rgba(0, 31, 63, 0.06);">
                        <i class="ti {{ $modalIcon }}" style="font-size: 2.5rem;"></i>
                    </div>

                    {{-- Title --}}
                    <h5 class="fw-bold text-dark mb-2" id="statusNotificationModalLabel">{{ $modalTitle }}</h5>

                    {{-- Content Body --}}
                    <div class="text-secondary small mb-4">
                        @if (session('error'))
                            <p class="mb-0 fw-medium text-dark">{!! nl2br(e(session('error'))) !!}</p>
                        @elseif ($errors->any())
                            <p class="mb-2 text-muted">Silakan periksa kembali data input berikut:</p>
                            <div class="text-start bg-light rounded-3 p-3">
                                <ul class="mb-0 text-danger ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (session('import_errors'))
                            <p class="mb-2 text-muted">Beberapa baris data dilewati saat import:</p>
                            <div class="text-start bg-light rounded-3 p-2" style="max-height: 180px; overflow-y: auto;">
                                <ul class="mb-0 text-danger ps-3 small">
                                    @foreach (session('import_errors') as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (session('warning'))
                            <p class="mb-0 fw-medium text-dark">{!! nl2br(e(session('warning'))) !!}</p>
                        @elseif (session('success'))
                            <p class="mb-0 fw-medium text-dark">{!! nl2br(e(session('success'))) !!}</p>
                        @endif
                    </div>

                    {{-- Action Button --}}
                    <button type="button" class="btn {{ $modalButtonClass }} w-100 py-2.5 rounded-3 fw-bold shadow-sm" @if(!empty($modalButtonStyle)) style="{{ $modalButtonStyle }}" @endif data-bs-dismiss="modal">
                        {{ $modalButtonText }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            function showStatusModal() {
                const modalEl = document.getElementById('statusNotificationModal');
                if (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modalInstance.show();
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', showStatusModal);
            } else {
                showStatusModal();
            }

            document.addEventListener('turbo:load', showStatusModal);
        })();
    </script>
@endif
