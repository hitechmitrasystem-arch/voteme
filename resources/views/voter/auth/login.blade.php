<!DOCTYPE html>
<html>
<head>
    <title>Voter Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card {
            width: 420px;
            padding: 40px;
            border-radius: 20px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(15px);
            color: white;
        }
    </style>
</head>

<body>

<div class="card">

    <h4 class="text-center mb-4">Voter Login</h4>

    @if($errors->any())
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

        <button class="btn btn-success w-100">
            Login
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-light">← Back</a>
        </div>

    </form>

</div>

</body>
</html>