@extends('components.user.header1')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center custom-container-height">
    <div class="card p-4 shadow-lg custom-card-width custom-card-height rounded-lg">
        <h2 class="mb-4 text-center fw-bold">Ganti Kata Sandi</h2>

        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('user.update-password') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label text-muted">Kata Sandi Sekarang</label>
                <div class="input-group input-group-md">
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required autocomplete="current-password">
                    <button class="btn btn-outline-secondary border-start-0 toggle-password-btn" type="button" data-target="current_password">
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label text-muted">Kata Sandi Baru</label>
                <div class="input-group input-group-md">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required autocomplete="new-password">
                    <button class="btn btn-outline-secondary border-start-0 toggle-password-btn" type="button" data-target="new_password">
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('new_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="new_password_confirmation" class="form-label text-muted">Masukkan Ulang Kata Sandi Baru</label>
                <div class="input-group input-group-md">
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required autocomplete="new-password">
                    <button class="btn btn-outline-secondary border-start-0 toggle-password-btn" type="button" data-target="new_password_confirmation">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-danger btn-lg py-2 rounded-pill">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password-btn').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (icon) {
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                }
            });
        });
    });
</script>
@include('components.user.footer')
@endsection
