<x-layouts.guest>
    <div class="bg-white rounded-4 shadow-lg p-3 p-sm-4 p-md-5 text-center border-0 card-login w-100" style="max-width: 450px; margin: auto;">

        {{-- Logo dengan background biru dongker & bayangan --}}
        <div class="d-inline-flex align-items-center justify-content-center mb-4 logo-container shadow-sm">
            <img src="{{ asset('images/logokop.svg') }}" alt="Logo Koperasi" class="logo-zoom">
        </div>

        <h4 class="mb-1 text-dark fw-bold">Masuk ke SIMKODES</h4>
        <p class="text-muted small mb-4">Sistem Informasi Manajemen Koperasi Desa Sranak</p>

        {{-- Pesan error jika login gagal --}}
        @if (session('error'))
            <div class="alert alert-danger rounded-3 py-2 px-3 small border-0 shadow-sm mb-4">
                <i class="ti ti-alert-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label text-dark fw-medium small ms-1">Email</label>
                <div class="custom-input-group d-flex align-items-center">
                    <span class="input-icon"><i class="ti ti-mail"></i></span>
                    <input type="email" name="email" class="form-control-custom" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4 text-start">
                <label class="form-label text-dark fw-medium small ms-1">Kata Sandi</label>
                <div class="custom-input-group d-flex align-items-center">
                    <span class="input-icon"><i class="ti ti-lock"></i></span>
                    <input type="password" name="password" id="passwordInput" class="form-control-custom" placeholder="••••••••" required>
                    <button type="button" class="btn-toggle-password" id="togglePasswordBtn">
                        <i class="ti ti-eye-off" id="passwordIcon"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4 text-start">
                <div class="form-check mb-0">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label text-dark small" for="remember">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn btn-accent-login w-100 py-2.5 rounded-3 fw-bold shadow-sm">
                <i class="ti ti-login me-1"></i> Masuk Sekarang
            </button>

            <p class="text-center text-muted mt-5 mb-0" style="font-size: 11px; letter-spacing: 0.5px;">
                PKM — <strong>UNUGIRI 2025</strong>
            </p>
        </form>
    </div>

    {{-- Styling & Scripts --}}
    <style>
        .card-login {
            border: 1px solid rgba(255, 255, 255, 0.8) !important;
            box-shadow: 0 20px 40px rgba(0, 31, 63, 0.3) !important;
        }

        .logo-container {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #001f3f, #003366);
            border-radius: 24px;
            overflow: hidden;
            border: 3px solid #fff;
            box-shadow: 0 10px 25px rgba(0, 31, 63, 0.15) !important;
        }

        .logo-zoom {
            width: 100px;
            height: 100px;
            object-fit: contain;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-zoom:hover {
            transform: scale(1.08);
        }

        @media (min-width: 576px) {
            .logo-container {
                width: 160px;
                height: 160px;
                border-radius: 32px;
                border-width: 4px;
            }
            .logo-zoom {
                width: 140px;
                height: 140px;
            }
        }

        /* Modern Custom Inputs */
        .custom-input-group {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 2px 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
        }

        .custom-input-group:focus-within {
            border-color: #003366;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(0, 51, 102, 0.08);
        }

        .input-icon {
            color: #94a3b8;
            margin-right: 12px;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
            flex-shrink: 0;
        }

        .custom-input-group:focus-within .input-icon {
            color: #003366;
        }

        .form-control-custom {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            flex-grow: 1;
            min-width: 0;
            padding: 10px 0;
            color: #1e293b;
            font-size: 0.95rem;
        }

        .form-control-custom::placeholder {
            color: #94a3b8;
        }

        .btn-toggle-password {
            border: none;
            background: transparent;
            color: #94a3b8;
            padding: 0;
            margin-left: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
            flex-shrink: 0;
        }

        .btn-toggle-password:hover {
            color: #003366;
        }

        /* Accent Button styling */
        .btn-accent-login {
            background: linear-gradient(135deg, #001f3f, #003366);
            color: #fff;
            border: none;
            transition: all 0.25s ease;
        }

        .btn-accent-login:hover {
            background: linear-gradient(135deg, #003366, #004488);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 31, 63, 0.25);
        }

        .btn-accent-login:active {
            transform: translateY(0);
        }
    </style>

    <script>
        function initPasswordToggle() {
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('passwordInput');
            const passwordIcon = document.getElementById('passwordIcon');

            if (togglePasswordBtn && passwordInput && passwordIcon) {
                togglePasswordBtn.onclick = function(e) {
                    e.preventDefault();
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        passwordIcon.className = 'ti ti-eye-off fs-5';
                    } else {
                        passwordIcon.className = 'ti ti-eye fs-5';
                    }
                };
            }
        }

        // Jalankan untuk Turbo & Normal Load
        document.addEventListener('turbo:load', initPasswordToggle);
        document.addEventListener('DOMContentLoaded', initPasswordToggle);
    </script>
</x-layouts.guest>