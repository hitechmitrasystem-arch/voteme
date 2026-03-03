<!DOCTYPE html>
<html lang="en">
<head>
    <title>Company Admin Login</title>
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

        /* Bigger Card */
        .login-card {
            width: 480px;
            padding: 60px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            box-shadow: 0 30px 70px rgba(0,0,0,0.6);
            color: #fff;
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

        /* Animated Title */
        .animated-title {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 1px;
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid #fff;
            width: 0;
            animation: typing 3s steps(30, end) forwards,
                       blink 0.8s infinite;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink {
            50% { border-color: transparent }
        }

        .form-control {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            transition: 0.3s ease;
            height: 45px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.25);
            box-shadow: 0 0 12px #2e5bff;
            color: #fff;
        }

        .input-group-text {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
        }

        .btn-login {
            background: #1f3c88;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            color: #fff;
            padding: 12px;
            transition: 0.4s ease;
        }

        .btn-login:hover {
            background: #2e5bff;
            box-shadow: 0 0 20px #2e5bff;
            transform: translateY(-4px);
        }

        .forgot-link {
            color: #cfd8ff;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-link:hover {
            color: #ffffff;
        }

    </style>
</head>

<body>

<div class="login-card text-center">

    <div class="animated-title mb-4">
        Company Admin Login
    </div>

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
        </div>

        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
        </div>

        <div class="text-end mb-4">
            <a href="#" class="forgot-link">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-login w-100">
            Login
        </button>
    </form>

</div>

</body>
</html>