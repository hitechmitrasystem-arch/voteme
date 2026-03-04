<!DOCTYPE html>
<html>
<head>
    <title>Voter Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token Meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(-45deg, #000428, #004e92, #000046, #1a2980);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
            font-family: 'Segoe UI', sans-serif;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            width: 480px;
            padding: 45px;
            border-radius: 20px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.6);
            color: white;
        }

        .title {
            font-size: 26px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            text-shadow: 0 0 15px #4da3ff;
        }

        .form-control {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
        }

        .form-control::placeholder {
            color: #cfd8ff;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.15);
            color: white;
            box-shadow: 0 0 10px #4da3ff;
        }

        .btn-login {
            background: linear-gradient(45deg, #1f3c88, #2e5bff);
            border: none;
            padding: 12px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        .back-link {
            color: #cfd8ff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="glass-card">

    <div class="title">
        Voter Login
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('voter.login.submit') }}">
        @csrf

        <div class="mb-3">
            <input type="text"
                   name="voter_id"
                   class="form-control"
                   placeholder="Enter Voter ID"
                   value="{{ old('voter_id') }}"
                   required>
        </div>

        <div class="mb-4">
            <input type="password"
                   name="passcode"
                   class="form-control"
                   placeholder="Enter Passcode"
                   required>
        </div>

        <button type="submit" class="btn btn-login w-100">
            Secure Login
        </button>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="back-link">← Back to Home</a>
        </div>

    </form>

</div>

</body>
</html>