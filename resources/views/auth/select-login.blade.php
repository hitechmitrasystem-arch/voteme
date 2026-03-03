<!DOCTYPE html>
<html lang="en">
<head>
    <title>Election System Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(-45deg, #000428, #004e92, #000046, #1a2980);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            width: 520px;
            padding: 60px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            box-shadow: 0 30px 70px rgba(0,0,0,0.6);
            color: #fff;
            text-align: center;
            animation: slideFade 1s ease forwards;
            transform: translateY(40px);
            opacity: 0;
        }

        @keyframes slideFade {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animated-title {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 40px;
        }

        .login-btn {
            border-radius: 50px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            transition: 0.4s ease;
        }

        .btn-admin {
            background: #1f3c88;
            border: none;
            color: #fff;
        }

        .btn-admin:hover {
            background: #2e5bff;
            box-shadow: 0 0 20px #2e5bff;
            transform: translateY(-4px);
        }

        .btn-voter {
            background: #198754;
            border: none;
            color: #fff;
        }

        .btn-voter:hover {
            background: #20c997;
            box-shadow: 0 0 20px #20c997;
            transform: translateY(-4px);
        }

        .subtitle {
            font-size: 14px;
            color: #cfd8ff;
            margin-bottom: 30px;
        }

    </style>
</head>

<body>

<div class="login-card">

    <div class="animated-title">
        Welcome to Election System
    </div>

    <div class="subtitle">
        Please choose how you want to login
    </div>

    <a href="{{ route('admin.login') }}" class="btn login-btn btn-admin w-100 mb-4">
        <i class="bi bi-building"></i> Login as Company Admin
    </a>

    <a href="{{ route('voter.login') }}" class="btn login-btn btn-voter w-100">
        <i class="bi bi-person-check"></i> Login as Voter
    </a>

</div>

</body>
</html>