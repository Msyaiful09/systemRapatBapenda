@extends('auth.layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #f7f9f9; height: 100vh;">
    <div class="row h-100">
        <!-- Left Section with Image -->
        <div class="col-md-6 p-0">
            <img src="https://sippn.menpan.go.id/images/article/large/4a9e08d97917ea08e99923ed0f1ea549-20240527033130.jpg" alt="Gedung Bapenda" class="img-fluid w-100 h-100" style="object-fit: cover;">
        </div>

        <!-- Right Section with Login Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="w-75">
                <h2 class="text-center mb-4">Login ke Akun Anda</h2>

                <form method="POST" action="{{ route('loginUrl') }}">
                    @csrf

                    <!-- NIP Field -->
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP:</label>
                        <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autofocus>
                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">
                                <i class="bi bi-eye" id="password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Simpan riwayat</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Log in</button>
                    </div>

                    <!-- Registration Link -->
                    <div class="text-center mt-3">
                        <p>Registrasi akun? <a href="{{ route('register') }}">Daftar akun</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-4" style="background-color: #343a40; color: white; padding: 10px 0;">
        <p>&copy;2024 BAPENDA Kota Pontianak</p>
    </footer>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');
        const passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            passwordIcon.classList.remove('bi-eye');
            passwordIcon.classList.add('bi-eye-slash');
        } else {
            passwordField.setAttribute('type', 'password');
            passwordIcon.classList.remove('bi-eye-slash');
            passwordIcon.classList.add('bi-eye');
        }
    }
</script>
@endsection
