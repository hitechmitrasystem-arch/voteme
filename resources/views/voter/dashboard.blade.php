<!DOCTYPE html>
<html>
<head>
    <title>Voter Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Welcome, {{ $voter->name }}</h3>
            <small class="text-light">Voter ID: {{ $voter->voter_id }}</small>
        </div>

        <form method="POST" action="{{ route('voter.logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h4 class="mb-3">Active Elections</h4>

    @forelse($elections as $election)

        @php
            $alreadyVoted = \App\Models\Vote::where('voter_id', $voter->id)
                ->where('election_id', $election->id)
                ->exists();
        @endphp

        <div class="card bg-secondary text-white mb-4 shadow">
            <div class="card-body">
                <h5>{{ $election->title }}</h5>
                <p>Select up to {{ $election->max_choices }} candidates</p>

                @if($alreadyVoted)

                    <div class="alert alert-success">
                        ✅ You have already voted in this election.
                    </div>

                @else

                    <form method="POST" action="{{ route('voter.vote') }}">
                        @csrf
                        <input type="hidden" name="election_id" value="{{ $election->id }}">

                        @foreach($election->candidates as $candidate)
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="candidates[]"
                                       value="{{ $candidate->id }}">
                                <label class="form-check-label">
                                    {{ $candidate->name }}
                                </label>
                            </div>
                        @endforeach

                        <button class="btn btn-success mt-3">
                            Submit Vote
                        </button>
                    </form>

                @endif

            </div>
        </div>

    @empty
        <div class="alert alert-warning">
            No active elections available.
        </div>
    @endforelse

</div>

</body>
</html>