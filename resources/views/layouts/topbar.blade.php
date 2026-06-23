<nav class="topbar shadow-sm">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center h-100">
        
        {{-- Brand / Logo --}}
        <div class="topbar-brand d-flex align-items-center gap-3">
            <div class="topbar-logo-wrapper">
                <img src="{{ asset('images/logokop.svg') }}" alt="Logo" class="topbar-logo">
            </div>
            <div class="topbar-title-group d-none d-lg-block">
                <h5 class="topbar-title mb-0">SIMKODES</h5>
                <span class="topbar-subtitle">Koperasi Desa Sranak</span>
            </div>
        </div>

        {{-- Desktop Navigation Links --}}
        <div class="topbar-menu d-none d-xl-flex align-items-center gap-1">
            <a href="{{ route('dashboard') }}" class="topbar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="ti ti-layout-dashboard"></i> Dashboard
            </a>
            
            {{-- Dropdown Data Koperasi --}}
            <div class="dropdown topbar-dropdown">
                <button class="topbar-link dropdown-toggle {{ request()->routeIs('members.*') || request()->routeIs('officers.*') || request()->routeIs('supervisors.*') || request()->routeIs('categories.*') ? 'active' : '' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-database"></i> Data Koperasi
                </button>
                <ul class="dropdown-menu shadow-sm border-0 rounded-3 mt-2">
                    <li><a class="dropdown-item py-2" href="{{ route('members.index') }}"><i class="ti ti-users-group me-2 text-primary"></i> Anggota</a></li>
                    <li><a class="dropdown-item py-2" href="{{ route('officers.index') }}"><i class="ti ti-id-badge-2 me-2 text-primary"></i> Pengurus</a></li>
                    <li><a class="dropdown-item py-2" href="{{ route('supervisors.index') }}"><i class="ti ti-eye-check me-2 text-primary"></i> Pengawas</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2" href="{{ route('categories.index') }}"><i class="ti ti-category me-2 text-primary"></i> Kategori</a></li>
                </ul>
            </div>

            {{-- Dropdown Administrasi --}}
            <div class="dropdown topbar-dropdown">
                <button class="topbar-link dropdown-toggle {{ request()->routeIs('incomingletters.*') || request()->routeIs('outgoingletters.*') || request()->routeIs('inventories.*') ? 'active' : '' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-folder"></i> Administrasi
                </button>
                <ul class="dropdown-menu shadow-sm border-0 rounded-3 mt-2">
                    <li><a class="dropdown-item py-2" href="{{ route('incomingletters.index') }}"><i class="ti ti-mail-down me-2 text-success"></i> Surat Masuk</a></li>
                    <li><a class="dropdown-item py-2" href="{{ route('outgoingletters.index') }}"><i class="ti ti-mail-up me-2 text-warning"></i> Surat Keluar</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2" href="{{ route('inventories.index') }}"><i class="ti ti-packages me-2 text-info"></i> Inventaris</a></li>
                </ul>
            </div>

            {{-- Layanan --}}
            <a href="{{ route('subsidychecks.index') }}" class="topbar-link {{ request()->routeIs('subsidychecks.*') ? 'active' : '' }}">
                <i class="ti ti-discount-check"></i> Checker Subsidi
            </a>
            
            <a href="{{ route('about') }}" class="topbar-link {{ request()->routeIs('about') ? 'active' : '' }}">
                <i class="ti ti-info-circle"></i> Tentang
            </a>
        </div>

        {{-- Right Section: Profile & Mobile Toggle --}}
        <div class="topbar-right d-flex align-items-center gap-3">
            {{-- Profile Dropdown --}}
            <div class="dropdown">
                <button class="topbar-profile d-flex align-items-center gap-2 border-0 bg-transparent" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="topbar-avatar">
                        <i class="ti ti-user"></i>
                    </div>
                    <div class="topbar-user-info d-none d-sm-flex flex-column align-items-start">
                        <span class="fw-bold text-dark" style="font-size: 13px;">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="text-muted" style="font-size: 11px;">Administrator</span>
                    </div>
                    <i class="ti ti-chevron-down text-muted ms-1 d-none d-sm-block" style="font-size: 14px;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                    <li>
                        <button type="button" class="dropdown-item py-2 text-danger fw-medium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="ti ti-logout"></i> Keluar
                        </button>
                    </li>
                </ul>
            </div>

            {{-- Mobile Menu Toggle --}}
            <button class="btn btn-light d-xl-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas" aria-controls="mobileMenuOffcanvas">
                <i class="ti ti-menu-2 fs-4"></i>
            </button>
        </div>
    </div>
</nav>

{{-- Offcanvas for Mobile Navigation --}}
<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="mobileMenuOffcanvas" aria-labelledby="mobileMenuOffcanvasLabel">
    <div class="offcanvas-header bg-light border-bottom">
        <h5 class="offcanvas-title fw-bold" id="mobileMenuOffcanvasLabel">Menu Utama</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action py-3 border-0 {{ request()->routeIs('dashboard') ? 'text-primary fw-bold' : '' }}">
                <i class="ti ti-layout-dashboard me-2"></i> Dashboard
            </a>
            
            <div class="bg-light px-3 py-2 text-muted fw-bold" style="font-size: 11px; letter-spacing: 1px;">DATA KOPERASI</div>
            <a href="{{ route('members.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-users-group me-2"></i> Anggota
            </a>
            <a href="{{ route('officers.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-id-badge-2 me-2"></i> Pengurus
            </a>
            <a href="{{ route('supervisors.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-eye-check me-2"></i> Pengawas
            </a>
            <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-category me-2"></i> Kategori
            </a>

            <div class="bg-light px-3 py-2 text-muted fw-bold" style="font-size: 11px; letter-spacing: 1px;">ADMINISTRASI</div>
            <a href="{{ route('incomingletters.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-mail-down me-2"></i> Surat Masuk
            </a>
            <a href="{{ route('outgoingletters.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-mail-up me-2"></i> Surat Keluar
            </a>
            <a href="{{ route('inventories.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-packages me-2"></i> Inventaris
            </a>

            <div class="bg-light px-3 py-2 text-muted fw-bold" style="font-size: 11px; letter-spacing: 1px;">LAYANAN</div>
            <a href="{{ route('subsidychecks.index') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-discount-check me-2"></i> Checker Subsidi
            </a>
            <a href="{{ route('about') }}" class="list-group-item list-group-item-action py-3 border-0">
                <i class="ti ti-info-circle me-2"></i> Tentang
            </a>
        </div>
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

