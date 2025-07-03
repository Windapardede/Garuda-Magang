<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .footer {
            background-color: #f1f1f1;
            color: #333;
            padding: 10px;
            font-size: 14px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    .container {
        max-width: 800px;
        margin: -25px auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        line-height: 1.6;
    }
    .container p {
        margin: 10px 0;
    }
    .container .highlight {
        color: #d9534f;
        font-weight: bold;
    }
    .bank-details {
        background: #f9f9f9;
        border-left: 4px solid #5bc0de;
        padding: 15px;
        border-radius: 5px;
        margin-bottom:16px;
    }
    .infotinjau {
        background: #f9f9f9;
        border-left: 4px solid #4caf50;
        padding: 15px;
        border-radius: 5px;
    }
    .infotolak {
        background: #f9f9f9;
        border-left: 4px solid #ff5722;
        padding: 15px;
        border-radius: 5px;
    }
    .btn-confirm {
        display: inline-block;
        margin-top: 20px;
        background-color: #5cb85c;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
    }
    .btn-confirm:hover {
        background-color: #4cae4c;
    }
    .footer-note {
        font-style: italic;
        color: #777;
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <div class="header">
        Smart Internship
    </div>
    <div class="content">
    <div class="container">
        <h2>Anda baru saja melakukan registrasi</h2>
        <p><span >Berikut kode OTP anda:</span></p>
        <div class="bank-details">
            {{$otp}}
        </div>
        <p class="footer-note">*Pastikan akun anda aman dari peretasan.</p>
    </div>
    </div>
    <div class="footer" >
        <div>{{ $date }} </div>
        <div>{{ $time }}</div>
    </div>
</body>
</html>
