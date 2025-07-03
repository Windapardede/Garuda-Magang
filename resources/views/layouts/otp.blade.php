<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />

</head>

<body>
     @include('layouts.alert-noicon')
    <div class="container d-flex justify-content-center align-items-center otp-container">
        <div class="otp-card text-center">
            <h4 class="fw-bold mb-2">Masukkan Kode OTP</h4>
            <p class="text-muted mb-4">Ketik 6 digit kode yang dikirimkan ke email</p>

            <form action="{{url('create_new_account/verifikasi')}}" method="POST">
                @csrf
                <div class="d-flex justify-content-center gap-2 mb-4">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                    @endfor
                </div>
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit" class="btn btn-verifikasi w-100">Verifikasi</button>

                <p class="mt-4 text-muted" id="resend-text">Kirim ulang OTP dalam <span id="timer">30</span> detik</p>
            </form>
        </div>
    </div>

    <script>
        // Fokus otomatis ke input berikutnya
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Countdown timer
        let timer = 30;
        const timerElement = document.getElementById('timer');
        const countdown = setInterval(() => {
            timer--;
            timerElement.textContent = timer;
            if (timer <= 0) {
                clearInterval(countdown);
                document.getElementById('resend-text').innerHTML = `<a href="{{url('create_new_account/kirim-ulang-otp?email='.$email)}}">Kirim ulang OTP</a>`;
            }
        }, 1000);
    </script>

</body>

</html>
