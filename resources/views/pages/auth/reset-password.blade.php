
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 2rem; }
        .container { max-width: 400px; margin: auto; background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; margin-bottom: 1.5rem; }
        label { display: block; margin-top: 1rem; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 0.5rem; margin-top: 0.5rem; border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            margin-top: 1.5rem;
            width: 100%; padding: 0.7rem;
            background: red; color: white;
            border: none; border-radius: 5px; cursor: pointer;
        }
        .error { color: red; font-size: 0.9rem; margin-top: 0.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->email }}">

            <label for="password">Password Baru</label>
            <input id="password" type="password" name="password" required autofocus>

            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <button type="submit" class="btn btn-danger btn-lg py-2 rounded-pill custom-btn-kirim">Reset Password</button>
        </form>
    </div>
</body>
</html>
