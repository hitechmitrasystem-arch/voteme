<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voting SaaS - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f4f6f9;">

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            Voting SaaS
        </a>

        <div class="d-flex">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid py-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>