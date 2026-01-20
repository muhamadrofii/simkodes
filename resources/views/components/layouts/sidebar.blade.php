<section class="sidebar d-none d-md-block text-white shadow-sm">
    {{-- Brand --}}
    <div class="sidebar-brand text-center mb-5">
        {{-- Logo --}}
        <img src="{{ asset('images/logokop.svg') }}" alt="Logo">
        {{-- Title --}}
        <h5 class="mt-4 mb-3"> SIMKODES </h5>
    </div>
    {{-- Sidebar Menu --}}
    <div class="sidebar-menu">
        <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <i class="ti ti-layout-dashboard fs-4 me-3"></i>
            <span>Dashboard</span>
        </x-sidebar-link>


        <x-sidebar-link href="{{ route('members.index') }}" :active="request()->routeIs('members.*')">
            <i class="ti ti-user fs-4 me-3"></i>
            <span>Anggota</span>
        </x-sidebar-link>

        <x-sidebar-link href="{{ route('officers.index') }}" :active="request()->routeIs('officers.*')">
            <i class="ti ti-id-badge fs-4 me-3"></i>
            <span>Pengurus</span>
        </x-sidebar-link>

        <x-sidebar-link href="{{ route('supervisors.index') }}" :active="request()->routeIs('supervisors.*')">
            <i class="ti ti-eye-check fs-4 me-3"></i>
            <span>Pengawas</span>
        </x-sidebar-link>


        <x-sidebar-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.*')">
            <i class="ti ti-list-details fs-4 me-3"></i>
            <span>Kategori</span>
        </x-sidebar-link>

        <x-sidebar-link href="{{ route('incomingletters.index') }}" :active="request()->routeIs('incomingletters.*')">
            <i class="ti ti-mail fs-4 me-3"></i>
            <span>Surat Masuk</span>
        </x-sidebar-link>

        {{-- Outgoing Letters --}}
        <x-sidebar-link href="{{ route('outgoingletters.index') }}" :active="request()->routeIs('outgoingletters.*')">
            <i class="ti ti-send fs-4 me-3"></i>
            <span>Surat Keluar</span>
        </x-sidebar-link>

        <x-sidebar-link href="{{ route('inventories.index') }}" :active="request()->routeIs('inventories.*')">
            <i class="ti ti-archive fs-4 me-3"></i>
            <span>Inventaris</span>
        </x-sidebar-link>


        <!--<x-sidebar-link href="{{ route('report.index') }}" :active="request()->routeIs('report.*')">-->
        <!--    <i class="ti ti-file-text fs-4 me-3"></i>-->
        <!--    <span>Filter</span>-->
        <!--</x-sidebar-link>-->
        <x-sidebar-link href="{{ route('about') }}" :active="request()->routeIs('about')">
            <i class="ti ti-file-info fs-4 me-3"></i>
            <span>Tentang</span>
        </x-sidebar-link>
    </div>

    <div class="text-center mt-5" style="font-size: 10px; opacity: 0.9;">
        by Pengabdian Kepada Masyarakat - UNUGIRI 2025
    </div>
</section>