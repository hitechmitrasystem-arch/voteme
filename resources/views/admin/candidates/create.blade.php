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

    .page-container {
        padding-top: 70px;
        animation: fadeIn 0.8s ease forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }

    .title-section h1 {
        font-size: 34px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 5px;
    }

    .title-section p {
        color: #cfd8ff;
        font-size: 14px;
        margin-bottom: 30px;
    }

    .glass-card {
        border-radius: 25px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        padding: 40px;
        color: white;
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

    select.form-control option {
        color: #000;
    }

    .btn-save {
        background: #1f3c88;
        border: none;
        border-radius: 50px;
        padding: 8px 22px;
        transition: 0.3s ease;
    }

    .btn-save:hover {
        background: #2e5bff;
        box-shadow: 0 0 15px #2e5bff;
        transform: translateY(-2px);
    }

    .btn-back {
        border-radius: 50px;
    }

</style>

<div class="container page-container">

    <!-- Title -->
    <div class="title-section">
        <h1>Create Candidate</h1>
        <p>Add a candidate to an election session</p>
    </div>

    <!-- Glass Card -->
    <div class="glass-card">

        <form action="{{ route('admin.candidates.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Election</label>
                <select name="election_id" class="form-control" required>
                    <option value="">Select Election</option>
                    @foreach ($elections as $election)
                        <option value="{{ $election->id }}">
                            {{ $election->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Candidate Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-save">
                Save Candidate
            </button>

            <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-light btn-back ms-2">
                Back
            </a>

        </form>

    </div>

</div>

@endsection