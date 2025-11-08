<x-layouts.guest>
    <div class="mx-auto" style="max-width: 500px;">
        <div class="bg-white rounded-4 shadow-sm p-4 p-md-5">
            <h4 class="mb-4">Daftar di <strong>Pendataan Anggota</strong></h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Daftar</button>

                <p class="text-center text-muted mt-4 mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </p>
            </form>
        </div>
    </div>
</x-layouts.guest>
