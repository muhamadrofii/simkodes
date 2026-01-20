<section class="bottom-navbar d-block d-md-none shadow-lg">
    {{-- Bottom Navbar Menu --}}
    <div class="bottom-navbar-menu">
        <x-navbar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <i class="ti ti-layout-dashboard"></i>
            <span>Dashboard</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('members.index') }}" :active="request()->routeIs('members.*')">
            <i class="ti ti-user"></i>
            <span>Anggota</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('officers.index') }}" :active="request()->routeIs('officers.*')">
            <i class="ti ti-id-badge"></i>
            <span>Pengurus</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('supervisors.index') }}" :active="request()->routeIs('supervisors.*')">
            <i class="ti ti-eye-check"></i>
            <span>Pengawas</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.*')">
            <i class="ti ti-list-details"></i>
            <span>Kategori</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('incomingletters.index') }}" :active="request()->routeIs('incomingletters.*')">
            <i class="ti ti-mail"></i>
            <span>S. Masuk</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('outgoingletters.index') }}" :active="request()->routeIs('outgoingletters.*')">
            <i class="ti ti-send"></i>
            <span>S. Keluar</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('inventories.index') }}" :active="request()->routeIs('inventories.*')">
            <i class="ti ti-archive"></i>
            <span>Inventaris</span>
        </x-navbar-link>
        <x-navbar-link href="{{ route('about') }}" :active="request()->routeIs('about')">
            <i class="ti ti-file-info"></i>
            <span>Tentang</span>
        </x-navbar-link>
    </div>
</section>