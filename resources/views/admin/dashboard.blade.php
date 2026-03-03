@extends('admin.layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(-45deg, #000428, #004e92, #000046, #1a2980);
        background-size: 400% 400%;
        animation: gradientMove 12s ease infinite;
        min-height: 100vh;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .dashboard-container {
        padding: 60px 0;
        animation: fadeIn 0.8s ease forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }

    .welcome-title {
        font-size: 30px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .welcome-sub {
        color: #cfd8ff;
        margin-bottom: 40px;
    }

    .glass-card {
        border-radius: 20px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(15px);
        box-shadow: 0 25px 60px rgba(0,0,0,0.5);
        color: white;
        transition: 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 35px 70px rgba(0,0,0,0.6);
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        margin-top: 5px;
    }

    .action-btn {
        border-radius: 50px;
        padding: 12px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 15px rgba(255,255,255,0.4);
    }

</style>

<div class="container dashboard-container">

    <!-- Welcome Section -->
    <div class="welcome-title">
        Welcome, {{ auth()->guard('admin')->user()->name }}
    </div>
    <div class="welcome-sub">
        Here's your election system overview
    </div>

    <!-- Stats Section -->
    <div class="row g-4">

        <div class="col-md-3">
            <div class="glass-card text-center p-4">
                <h6 class="text-light">Total Voters</h6>
                <div class="stat-number text-primary">
                    {{ $totalVoters }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card text-center p-4">
                <h6 class="text-light">Total Elections</h6>
                <div class="stat-number text-success">
                    {{ $totalElections }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card text-center p-4">
                <h6 class="text-light">Total Candidates</h6>
                <div class="stat-number text-warning">
                    {{ $totalCandidates }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card text-center p-4">
                <h6 class="text-light">Total Votes</h6>
                <div class="stat-number text-danger">
                    {{ $totalVotes }}
                </div>
            </div>
        </div>

    </div>

    <!-- Action Buttons -->
    <div class="row mt-5 g-4">

        <div class="col-md-4">
            <a href="{{ route('admin.elections.index') }}"
               class="btn btn-primary w-100 action-btn">
                Manage Elections
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.voters.index') }}"
               class="btn btn-outline-light w-100 action-btn">
                Manage Voters
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.candidates.index') }}"
               class="btn btn-success w-100 action-btn">
                Manage Candidates
            </a>
        </div>

    </div>

</div>

@endsection