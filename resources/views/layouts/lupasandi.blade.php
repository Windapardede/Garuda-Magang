<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />

</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center custom-container-height">
        <div class="card p-4 shadow-lg custom-card-width custom-card-height rounded-lg">
            <h2 class="mb-4 text-center fw-bold custom-title-spacing">Lupa Kata Sandi</h2>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show custom-alert-success" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show custom-alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                @if(str_contains(session('error'), 'Tidak Terdaftar'))
                <a href="{{ route('register') }}" class="alert-link ms-2">Daftar</a>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label text-muted custom-label">Masukkan Email Yang Terdaftar</label>
                    <input type="email" class="form-control form-control-md @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-danger btn-lg py-2 rounded-pill custom-btn-kirim">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>