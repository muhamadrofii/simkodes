<section class="bottom-navbar d-block d-md-none bg-white shadow-lg">
    {{-- Bottom Navbar Menu --}}
    <div class="bottom-navbar-menu row justify-content-center">
        <x-navbar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <i class="ti ti-layout-dashboard fs-5"></i>
        </x-navbar-link>
        <x-navbar-link href="{{ route('members.index') }}" :active="request()->routeIs('members.*')">
            <i class="ti ti-users fs-5"></i>
        </x-navbar-link>
        <x-navbar-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.*')">
            <i class="ti ti-list-details fs-5"></i>
        </x-navbar-link>
        <x-navbar-link href="{{ route('report.index') }}" :active="request()->routeIs('report.*')">
            <i class="ti ti-file-text fs-5"></i>
        </x-navbar-link>
        <x-navbar-link href="{{ route('about') }}" :active="request()->routeIs('about')">
            <i class="ti ti-file-info fs-5"></i>
        </x-navbar-link>
    </div>
</section>