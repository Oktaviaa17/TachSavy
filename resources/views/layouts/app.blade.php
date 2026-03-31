<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>TachSavvy Library</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 230px;
            background-color: #2bc0ac;
            color: white;
            padding: 25px 20px;
            box-sizing: border-box;
        }

        .sidebar h3 {
            margin-top: 0;
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            background-color: rgba(255,255,255,0.15);
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 12px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: rgba(0,0,0,0.2);
        }

        .logout-btn {
            margin-top: 30px;
            width: 100%;
            background-color: #e53935;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #c62828;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="wrapper">
    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- KONTEN --}}
    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
