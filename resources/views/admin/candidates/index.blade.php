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
        padding-top: 60px;
        animation: fadeIn 0.8s ease forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }

    .title-section h1 {
        font-size: 34px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 5px;
    }

    .title-section p {
        color: #cfd8ff;
        font-size: 14px;
    }

    .btn-create {
        background: #1f3c88;
        border: none;
        padding: 10px 24px;
        border-radius: 50px;
        color: white;
        transition: 0.3s ease;
    }

    .btn-create:hover {
        background: #2e5bff;
        box-shadow: 0 0 15px #2e5bff;
        transform: translateY(-3px);
    }

    .glass-card {
        margin-top: 30px;
        border-radius: 25px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        padding: 35px;
        color: white;
    }

    .custom-table {
        color: white;
    }

    .custom-table thead {
        background: rgba(255,255,255,0.15);
    }

    .custom-table th,
    .custom-table td {
        padding: 18px;
        border: none;
    }

    .custom-table tbody tr {
        border-top: 1px solid rgba(255,255,255,0.1);
        transition: 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background: rgba(255,255,255,0.08);
    }

    .empty-state {
        text-align: center;
        padding: 60px 0;
        color: #cfd8ff;
    }

    .empty-state h4 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .btn-danger {
        border-radius: 50px;
        padding: 5px 15px;
    }

    .pagination {
        justify-content: center;
    }

    .btn-back {
        border-radius: 50px;
        padding: 8px 20px;
        transition: 0.3s ease;
    }

    .btn-back:hover {
        background: #2e5bff;
        border-color: #2e5bff;
    }

</style>

<div class="container page-container">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="title-section">
            <h1>Candidates</h1>
            <p>Manage candidates participating in elections</p>
        </div>

        <a href="{{ route('admin.candidates.create') }}" class="btn btn-create">
            + Add Candidate
        </a>
    </div>

    <!-- Glass Card -->
    <div class="glass-card">

        @if($candidates->count() > 0)

            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Election</th>
                        <th>Votes</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $candidate->name }}</td>
                            <td>{{ $candidate->election->title ?? 'N/A' }}</td>
                            <td>{{ $candidate->vote_count }}</td>
                            <td>
                                <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $candidates->links() }}
            </div>

        @else

            <!-- Empty State -->
            <div class="empty-state">
                <h4>No Candidates Available</h4>
                <p>Add candidates to begin the election process.</p>
                <a href="{{ route('admin.candidates.create') }}" class="btn btn-create mt-3">
                    Add First Candidate
                </a>
            </div>

        @endif

    </div>

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-light btn-back">
            ← Back to Dashboard
        </a>
    </div>

</div>

@endsection