<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | TachSavvy Library</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            background: white;
            padding: 40px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #31947f;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-box button:hover {
            background-color: #18524d;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        /* NOTIFIKASI */
        .notif-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .notif-error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .notif-error ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Register</h2>

    <!-- NOTIFIKASI BERHASIL -->
    @if (session('success'))
        <div class="notif-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- NOTIFIKASI GAGAL / VALIDASI -->
    @if ($errors->any())
        <div class="notif-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Daftar</button>
    </form>

    <div class="login-link">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

</body>
</html>