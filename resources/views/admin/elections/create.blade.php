<!DOCTYPE html>
<html>
<head>
    <title>Create Election</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <div class="card bg-secondary text-white shadow p-4">

        <h3 class="mb-4">Create Election</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.elections.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Time</label>
                <input type="datetime-local" name="end_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Maximum Candidates Voter Can Select
                </label>
                <input type="number"
                       name="max_choices"
                       class="form-control"
                       min="1"
                       value="1"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Create Election
            </button>
        </form>

        <a href="{{ route('admin.elections.index') }}"
           class="btn btn-outline-light mt-3">
            ← Back
        </a>

    </div>

</div>

</body>
</html>