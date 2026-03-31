<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TachSavvy Library</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: white;
            padding: 40px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .login-box h2 { text-align: center; margin-bottom: 10px; }
        .login-box p { text-align: center; color: #555; margin-bottom: 20px; }
        .login-box label { display: block; margin-bottom: 5px; font-weight: bold; }
        .login-box input { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .login-box button { width: 100%; padding: 10px; background-color: #31947f; border: none; color: white; font-size: 16px; border-radius: 5px; cursor: pointer; }
        .login-box button:hover { background-color: #18524d; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <p>TachSavvy Library</p>

    @if (session('success'))
        <div style="background:#d1fae5;color:#065f46;padding:10px;margin-bottom:15px;border-radius:5px;text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background:#fee2e2;color:#991b1b;padding:10px;margin-bottom:15px;border-radius:5px;text-align:center;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:10px;margin-bottom:15px;border-radius:5px;">
            <ul style="margin:0;padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
