@extends('layouts.otp') {{-- Layout utama --}}

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center custom-container-height">
    <div class="card p-4 shadow-lg custom-card-width custom-card-height rounded-lg">
        <h2 class="mb-2 text-center fw-bold">Masukkan Kode OTP</h2>
        <p class="text-center text-muted mb-4">Ketik 6 digit kode yang dikirimkan ke email</p>

        {{-- Alert sukses atau error --}}
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

        <form action="#" method="POST">
            @csrf
            <div class="d-flex justify-content-center gap-2 mb-4">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" name="otp[]" maxlength="1" class="form-control text-center fs-4 otp-input" required style="width: 50px; height: 50px; border-radius: 10px;">
                    @endfor
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-danger btn-lg rounded-pill">Verifikasi</button>
            </div>
        </form>

        <p class="text-center text-muted mt-4" id="resend-text">Kirim ulang OTP dalam <span id="timer">30</span> detik</p>
    </div>
</div>

{{-- JavaScript --}}
<script>
    // Fokus otomatis
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, i) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && i < inputs.length - 1) {
                inputs[i + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && i > 0) {
                inputs[i - 1].focus();
            }
        });
    });

    // Timer untuk resend OTP
    let timer = 30;
    const timerEl = document.getElementById('timer');
    const resendEl = document.getElementById('resend-text');

    const countdown = setInterval(() => {
        timer--;
        timerEl.textContent = timer;
        if (timer <= 0) {
            clearInterval(countdown);
            resendEl.innerHTML = `<a href="#">Kirim ulang OTP</a>`;
        }
    }, 1000);
</script>
@endsection