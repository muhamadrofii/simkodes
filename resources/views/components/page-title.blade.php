{{-- Header Bar --}}
<div class="header-bar mb-4">
    <div class="header-left d-flex align-items-center gap-3">
        {{-- Sidebar Toggle Button --}}
        <button type="button" class="btn border-0 p-2 bg-light rounded-3 text-dark d-flex align-items-center justify-content-center sidebar-toggle-btn" id="sidebarToggle" style="width: 38px; height: 38px; transition: background-color 0.2s;">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div>
            <h4 class="header-title mb-0">{{ $slot }}</h4>
            <nav class="header-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="ti ti-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $slot }}</li>
                </ol>
            </nav>
        </div>
    </div>
    
    {{-- Greeting & Logout (Desktop only) --}}
    <div class="header-right d-none d-lg-flex">
        <div class="header-greeting">
            <div class="header-greeting-icon">
                <i class="ti ti-user"></i>
            </div>
            <div class="header-greeting-text">
                <span class="header-greeting-hi">Hi,</span>
                <span class="header-greeting-name">{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </div>
        <button type="button" class="header-logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="ti ti-logout"></i> Keluar
        </button>
    </div>
</div>

{{-- Modal Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body text-center p-4 p-md-5">
                <div class="modal-logout-icon" style="width:64px;height:64px;border-radius:50%;background:#fef2f2;display:inline-flex;align-items:center;justify-content:center;margin:0 auto;">
                    <i class="ti ti-logout" style="font-size:28px;color:#dc2626;"></i>
                </div>
                <h5 class="mt-3 mb-2 fw-bold text-dark">Keluar dari SIMKODES?</h5>
                <p class="text-muted mb-4">Anda perlu login kembali untuk mengakses sistem.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="ti ti-logout me-1"></i> Ya, Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

