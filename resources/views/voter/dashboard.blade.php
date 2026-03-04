<!DOCTYPE html>
<html>
<head>
    <title>Voter Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(-45deg, #000428, #004e92, #000046, #1a2980);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .dashboard-wrapper {
            max-width: 1100px;
            margin: auto;
            padding: 60px 20px;
        }

        .glass-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            margin-bottom: 30px;
        }

        .glow-title {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            text-shadow: 0 0 10px #4da3ff,
                         0 0 20px #4da3ff,
                         0 0 40px #4da3ff;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { text-shadow: 0 0 10px #4da3ff; }
            to { text-shadow: 0 0 25px #6bb8ff; }
        }

        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            border: none;
            border-radius: 50px;
            padding: 8px 18px;
            color: white;
            transition: 0.3s ease;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .election-card {
            background: rgba(255,255,255,0.05);
            border-radius: 18px;
            padding: 25px;
            transition: 0.3s ease;
        }

        .election-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        }

        .candidate-card {
            background: rgba(255,255,255,0.06);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            transition: 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .candidate-card:hover {
            border: 2px solid #4da3ff;
            background: rgba(255,255,255,0.1);
        }

        .candidate-img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #4da3ff;
        }

        .submit-btn {
            background: linear-gradient(45deg, #1f3c88, #2e5bff);
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .typing::after {
            content: '|';
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>

<body>

<div class="dashboard-wrapper">

    <div class="glow-title typing" id="typingTitle">
        Voter Dashboard
    </div>

    <div class="glass-card header-box">
        <div>
            <h5 class="mb-1">Welcome, {{ $voter->name }}</h5>
            <small>Voter ID: {{ $voter->voter_id }}</small>
        </div>

        <form method="POST" action="{{ route('voter.logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success glass-card">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger glass-card">
            {{ session('error') }}
        </div>
    @endif

    @forelse($elections as $election)

        @php
            $alreadyVoted = \App\Models\Vote::where('voter_id', $voter->id)
                ->where('election_id', $election->id)
                ->exists();
        @endphp

        <div class="glass-card election-card">

            <h5 class="fw-bold mb-2">{{ $election->title }}</h5>
            <small>Select up to {{ $election->max_choices }} candidate(s)</small>

            <hr class="border-light">

            @if($alreadyVoted)

                <div class="alert alert-success">
                    ✅ You have already voted.
                </div>

            @else

                <form method="POST" action="{{ route('voter.vote') }}">
                    @csrf
                    <input type="hidden" name="election_id" value="{{ $election->id }}">

                    @foreach($election->candidates as $candidate)
                        <label class="candidate-card w-100">

                            <div class="d-flex align-items-center">

                                <input type="checkbox"
                                       name="candidates[]"
                                       value="{{ $candidate->id }}"
                                       class="form-check-input me-3">

                                <img src="{{ asset('storage/'.$candidate->photo) }}"
                                     class="candidate-img me-3">

                                <div>
                                    <h6 class="mb-1">{{ $candidate->name }}</h6>
                                    <small>{{ $candidate->description }}</small>
                                </div>

                            </div>

                        </label>
                    @endforeach

                    <button class="submit-btn mt-3">
                        Submit Vote
                    </button>

                </form>

            @endif

        </div>

    @empty
        <div class="alert alert-warning glass-card">
            No active elections available.
        </div>
    @endforelse

</div>

<script>
    const text = "Voting Dashboard";
    let i = 0;
    const speed = 60;
    const el = document.getElementById("typingTitle");
    el.innerHTML = "";

    function typeWriter() {
        if (i < text.length) {
            el.innerHTML += text.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
        }
    }

    typeWriter();
</script>

</body>
</html>