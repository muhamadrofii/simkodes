<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Dashboard</x-page-title>

    {{-- tampilkan pesan selamat datang --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 d-block mt-xxl-n4">
                <img class="img-fluid px-xl-4 mt-xxl-n5" src="{{ asset('images/bgkop.svg') }}">
            </div>
            <div class="col-lg-9">
                <h4 class="mt-3 mt-lg-0 mb-2">Selamat datang di <strong>Pendataan Anggota Koperasi Merah Putih Desa
                        Sranak</strong>!</h4>
                <p class="text-muted fw-light mb-4">
                    Platform ini dirancang untuk mempermudah proses pencatatan, pengelolaan, dan pemutakhiran data
                    anggota secara digital, guna mendukung transparansi dan efisiensi layanan koperasi di lingkungan
                    Desa Sranak
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    {{-- <a href="https://pustakakoding.com/" target="_blank" class="btn btn-primary btn-action-icon">
                        Show Projects <i class="ti ti-chevron-right ms-2"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- ringkasan data --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Total Anggota</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['members'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-users"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Pengurus</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['officers'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-id-badge-2"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Pengawas</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['supervisors'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning-subtle text-warning"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-eye-check"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Inventaris</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['inventories'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-info-subtle text-info"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-archive"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Surat Masuk</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['incoming_letters'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-mail-opened"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Surat Keluar</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['outgoing_letters'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger-subtle text-danger"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-send"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1"><small>Jumlah Kategori</small></p>
                        <h4 class="fw-bold mb-0">{{ $summaryCounts['categories'] }}</h4>
                    </div>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-secondary-subtle text-secondary"
                        style="width: 42px; height: 42px;">
                        <i class="ti ti-category-2"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- infografis --}}
    <div class="row g-4 mb-5">
        <div class="col-12 col-xl-7">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <h6 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                    <i class="ti ti-chart-bar text-primary"></i>
                    Rangkuman Modul
                </h6>
                <canvas id="summaryChart" height="140"></canvas>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <h6 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                    <i class="ti ti-chart-donut text-success"></i>
                    Anggota per Kategori
                </h6>
                <div class="mx-auto" style="max-width: 320px;">
                    <canvas id="memberCategoryChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <h6 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                    <i class="ti ti-chart-line text-info"></i>
                    Surat Masuk & Keluar (6 Bulan Terakhir)
                </h6>
                <canvas id="letterTrendChart" height="90"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- menampilkan informasi jumlah member per kategori --}}
        @foreach ($categories as $category)
            <div class="col-lg-6 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="me-4">
                            <img src="{{ asset('category_images/' . $category->image) }}" class="img-thumbnail rounded-4"
                                width="50" alt="Images">
                        </div>
                        <div>
                            <p class="text-muted mb-1"><small>Kategori {{ $category->name }}</small></p>
                            <h5 class="fw-bold mb-0">
                                {{ $category->members_count + $category->officers_count + $category->supervisors_count }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



        {{-- @foreach ($categories as $category)
        <p>{{ asset('categories/' . $category->image) }}</p>
        <img src="{{ asset('categories/' . $category->image) }}" width="100" alt="Debug Image">
        @endforeach --}}

    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            const summaryLabels = [
                'Anggota',
                'Pengurus',
                'Pengawas',
                'Inventaris',
                'Surat Masuk',
                'Surat Keluar',
                'Kategori',
            ];
            const summaryData = [
                {{ $summaryCounts['members'] }},
                {{ $summaryCounts['officers'] }},
                {{ $summaryCounts['supervisors'] }},
                {{ $summaryCounts['inventories'] }},
                {{ $summaryCounts['incoming_letters'] }},
                {{ $summaryCounts['outgoing_letters'] }},
                {{ $summaryCounts['categories'] }},
            ];

            const memberCategoryLabels = @json($memberCategoryLabels);
            const memberCategoryCounts = @json($memberCategoryCounts);
            const monthLabels = @json($monthLabels);
            const incomingSeries = @json($incomingSeries);
            const outgoingSeries = @json($outgoingSeries);

            new Chart(document.getElementById('summaryChart'), {
                type: 'bar',
                data: {
                    labels: summaryLabels,
                    datasets: [{
                        label: 'Jumlah',
                        data: summaryData,
                        backgroundColor: '#0d6efd'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            new Chart(document.getElementById('memberCategoryChart'), {
                type: 'doughnut',
                data: {
                    labels: memberCategoryLabels,
                    datasets: [{
                        data: memberCategoryCounts,
                        backgroundColor: [
                            '#0d6efd', '#198754', '#ffc107', '#dc3545',
                            '#6f42c1', '#20c997', '#fd7e14', '#0dcaf0'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });

            new Chart(document.getElementById('letterTrendChart'), {
                type: 'line',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Surat Masuk',
                        data: incomingSeries,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Surat Keluar',
                        data: outgoingSeries,
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>

