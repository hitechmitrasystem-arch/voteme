<!DOCTYPE html>
<html>
<head>
    <title>Edit Voter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(-45deg, #000428, #004e92, #000046, #1a2980);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            width: 500px;
            padding: 40px;
            border-radius: 25px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(15px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            color: white;
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .card-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .card-subtitle {
            font-size: 14px;
            color: #cfd8ff;
            margin-bottom: 25px;
        }

        .form-control {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            transition: 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.25);
            box-shadow: 0 0 12px #2e5bff;
            color: #fff;
        }

        .btn-primary {
            background: #1f3c88;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: #2e5bff;
            box-shadow: 0 0 15px #2e5bff;
            transform: translateY(-2px);
        }

        .btn-cancel {
            border-radius: 50px;
        }

        .alert-danger {
            background: rgba(255,0,0,0.2);
            border: none;
            color: #fff;
        }

    </style>
</head>

<body>

<div class="glass-card">

    <div class="card-title">Edit Voter</div>
    <div class="card-subtitle">Update voter information</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.voters.update', $voter->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text"
                   name="name"
                   value="{{ $voter->name }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   value="{{ $voter->email }}"
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Update Voter
        </button>

        <a href="{{ route('admin.voters.index') }}"
           class="btn btn-outline-light btn-cancel ms-2">
            Cancel
        </a>

    </form>

</div>

</body>
</html>