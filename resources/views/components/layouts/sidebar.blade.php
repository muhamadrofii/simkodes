<aside class="sidebar-new">
    {{-- Profile Area --}}
    <div class="sb-profile d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3 sb-brand-wrapper">
            <div class="sb-avatar">
                <i class="ti ti-building-community"></i>
            </div>
            <div class="sb-profile-info">
                <span class="sb-app-name">SIMKODES</span>
                <span class="sb-app-desc">Koperasi Desa Sranak</span>
            </div>
        </div>
        {{-- Toggle Button inside Sidebar --}}
        <button type="button" class="btn border-0 p-1 bg-transparent text-white-50 sb-toggle-btn" id="sidebarToggleInternal" style="display: flex;">
            <i class="ti ti-menu-2 fs-4"></i>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="sb-nav">
        <a href="{{ route('dashboard') }}" class="sb-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="sb-icon"><i class="ti ti-layout-dashboard"></i></span>
            <span class="sb-label">Dashboard</span>
        </a>

        <div class="sb-section-title">Keanggotaan</div>

        <a href="{{ route('members.index') }}" class="sb-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-blue"><i class="ti ti-users-group"></i></span>
            <span class="sb-label">Anggota</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('officers.index') }}" class="sb-item {{ request()->routeIs('officers.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-violet"><i class="ti ti-id-badge-2"></i></span>
            <span class="sb-label">Pengurus</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('supervisors.index') }}" class="sb-item {{ request()->routeIs('supervisors.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-amber"><i class="ti ti-eye-check"></i></span>
            <span class="sb-label">Pengawas</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('categories.index') }}" class="sb-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-rose"><i class="ti ti-category"></i></span>
            <span class="sb-label">Kategori</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <div class="sb-section-title">Persuratan</div>

        <a href="{{ route('incomingletters.index') }}" class="sb-item {{ request()->routeIs('incomingletters.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-teal"><i class="ti ti-mail-down"></i></span>
            <span class="sb-label">Surat Masuk</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('outgoingletters.index') }}" class="sb-item {{ request()->routeIs('outgoingletters.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-orange"><i class="ti ti-mail-up"></i></span>
            <span class="sb-label">Surat Keluar</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <div class="sb-section-title">Kelola</div>

        <a href="{{ route('inventories.index') }}" class="sb-item {{ request()->routeIs('inventories.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-cyan"><i class="ti ti-packages"></i></span>
            <span class="sb-label">Inventaris</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('subsidychecks.index') }}" class="sb-item {{ request()->routeIs('subsidychecks.index') || request()->routeIs('subsidychecks.check') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-emerald"><i class="ti ti-discount-check"></i></span>
            <span class="sb-label">Checker Subsidi</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('subsidies.index') }}" class="sb-item {{ request()->routeIs('subsidies.index') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-slate"><i class="ti ti-settings"></i></span>
            <span class="sb-label">Manajemen Subsidi</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('subsidies.reports.index') }}" class="sb-item {{ request()->routeIs('subsidies.reports.*') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-indigo"><i class="ti ti-file-analytics"></i></span>
            <span class="sb-label">Laporan Subsidi</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>

        <a href="{{ route('about') }}" class="sb-item {{ request()->routeIs('about') ? 'active' : '' }}">
            <span class="sb-icon sb-icon-slate"><i class="ti ti-info-circle"></i></span>
            <span class="sb-label">Tentang</span>
            <span class="sb-badge">
                <i class="ti ti-chevron-right"></i>
            </span>
        </a>
    </nav>

    {{-- User Profile Area with Dropdown (Three Dots) --}}
    <div class="sb-profile-bottom">
        <div class="dropdown">
            <button class="sb-profile-btn d-flex align-items-center justify-content-between w-100 border-0 bg-transparent text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center gap-2">
                    <div class="sb-user-avatar">
                        <i class="ti ti-user"></i>
                    </div>
                    <div class="sb-user-info">
                        <span class="sb-user-name text-truncate" style="max-width: 140px; display: block;">{{ Auth::user()->name ?? 'Admin User' }}</span>
                        <span class="sb-user-role">Administrator</span>
                    </div>
                </div>
                <div class="sb-user-dots">
                    <i class="ti ti-dots-vertical"></i>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark shadow border-0 rounded-3 w-100 mb-2">
                <li>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ url('/') }}">
                        <i class="ti ti-home"></i> Halaman Utama
                    </a>
                </li>
                <li><hr class="dropdown-divider border-secondary my-1"></li>
                <li>
                    <button type="button" class="dropdown-item py-2 text-danger fw-medium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#sidebarLogoutModal">
                        <i class="ti ti-logout"></i> Keluar
                    </button>
                </li>
            </ul>
        </div>
    </div>

    {{-- Bottom --}}
    <div class="sb-bottom">
        <div class="sb-bottom-card">
            <i class="ti ti-school"></i>
            <span>PKM — UNUGIRI 2025</span>
        </div>
    </div>
</aside>

{{-- Modal Logout Sidebar --}}
<div class="modal fade" id="sidebarLogoutModal" tabindex="-1" aria-labelledby="sidebarLogoutModalLabel" aria-hidden="true">
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