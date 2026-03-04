<!DOCTYPE html>
<html>
<head>
    <title>Manage Elections</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    min-height:100vh;
    font-family:'Segoe UI', sans-serif;

    background: linear-gradient(-45deg,#000428,#004e92,#000046,#1a2980);
    background-size:400% 400%;
    animation:gradientMove 12s ease infinite;

    color:white;
}

/* Moving Krishna Gradient */

@keyframes gradientMove{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

/* Page animation */

.container{
    animation:fadeSlide 0.8s ease;
}

@keyframes fadeSlide{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* Title */

h2{
    font-weight:700;
    letter-spacing:1px;
}

/* Table Styling */

.table{
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(10px);
}

.table thead{
    background:rgba(255,255,255,0.12);
}

.table tbody tr{
    transition:0.3s ease;
}

.table tbody tr:hover{
    background:rgba(255,255,255,0.1);
    transform:scale(1.01);
}

/* Buttons */

.btn{
    border-radius:30px;
    transition:0.25s ease;
}

/* Primary */

.btn-primary{
    background:#1f3c88;
    border:none;
}

.btn-primary:hover{
    background:#2e5bff;
    box-shadow:0 0 15px #2e5bff;
    transform:translateY(-2px);
}

/* Warning */

.btn-warning:hover{
    transform:translateY(-2px);
    box-shadow:0 0 12px #ffc107;
}

/* Success */

.btn-success:hover{
    transform:translateY(-2px);
    box-shadow:0 0 12px #28a745;
}

/* Danger */

.btn-danger:hover{
    transform:translateY(-2px);
    box-shadow:0 0 12px #dc3545;
}

/* Dark */

.btn-dark:hover{
    transform:translateY(-2px);
    box-shadow:0 0 12px #111;
}

/* Outline */

.btn-outline-light:hover{
    background:#2e5bff;
    border-color:#2e5bff;
}

/* Alerts */

.alert{
    border-radius:12px;
}

/* Badge Glow */

.badge{
    font-size:12px;
    letter-spacing:0.5px;
}

/* Responsive spacing */

.table td, .table th{
    vertical-align:middle;
}

</style>
</head>


<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Elections</h2>

        <a href="{{ route('admin.elections.create') }}" class="btn btn-primary">
            + Create Election
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($elections->count())

        <div class="table-responsive">

            <table class="table table-dark table-bordered align-middle">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Max Choices</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Lock</th>
                        <th width="260">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($elections as $election)

                    <tr>

                        <td>{{ $election->title }}</td>
                        <td>{{ $election->max_choices }}</td>
                        <td>{{ $election->start_time }}</td>
                        <td>{{ $election->end_time }}</td>

                        <td>
                            @if($election->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td>
                            @if($election->is_locked)
                                <span class="badge bg-danger">Locked</span>
                            @else
                                <span class="badge bg-info">Open</span>
                            @endif
                        </td>

                        <td class="d-flex gap-2 flex-wrap">

                            <!-- Toggle -->
                            <form method="POST" action="{{ route('admin.elections.toggle', $election->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-warning">
                                    Toggle
                                </button>
                            </form>

                            <!-- Lock -->
                            <form method="POST" action="{{ route('admin.elections.lock', $election->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-dark">
                                    Lock
                                </button>
                            </form>

                            <!-- Results -->
                            <a href="{{ route('admin.elections.results', $election->id) }}"
                               class="btn btn-sm btn-success">
                                Results
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                  action="{{ route('admin.elections.destroy', $election->id) }}"
                                  onsubmit="return confirm('Delete this election?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="alert alert-warning">
            No elections found.
        </div>

    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light mt-3">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>