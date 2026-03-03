<!DOCTYPE html>
<html>
<head>
    <title>Manage Elections</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

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

                        <td class="d-flex gap-2">

                            <!-- Toggle Active -->
                            <form method="POST" action="{{ route('admin.elections.toggle', $election->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-warning">
                                    Toggle
                                </button>
                            </form>

                            <!-- Lock Election -->
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