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

    .glass-card {
        margin-top: 25px;
        border-radius: 20px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(15px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        padding: 25px;
    }

    .custom-table {
        color: #ffffff;
        font-size: 14px;
        font-weight: 400; /* remove bold */
    }

    .custom-table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        background: rgba(255,255,255,0.15);
    }

    .custom-table td {
        font-weight: 400;
    }

    .badge-active {
        background: #00c851;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 50px;
    }

    .badge-inactive {
        background: #dc3545;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 50px;
    }

    .btn-edit {
        background: #2e5bff;
        color: #fff;
        border: none;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 50px;
    }

    .btn-delete {
        background: transparent;
        color: #ff4d4d;
        border: 1px solid #ff4d4d;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 50px;
    }

    .btn-delete:hover {
        background: #ff4d4d;
        color: white;
    }

</style>

<div class="container page-container">

    <div class="d-flex justify-content-between align-items-center text-white">
        <div>
            <h1 class="fw-bold">Voters</h1>
            <p class="text-light">Manage registered voters and credentials</p>
        </div>

        <a href="{{ route('admin.voters.create') }}" class="btn btn-primary rounded-pill">
            + Add Voter
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-card">

        @if($voters->count() > 0)

        <table class="table custom-table align-middle">
            <thead>
                <tr>
                    <th>Voter ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th width="160">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($voters as $voter)
                <tr>
                    <td>{{ $voter->voter_id }}</td>
                    <td>{{ $voter->name }}</td>
                    <td>{{ $voter->email ?? 'N/A' }}</td>
                    <td>
                        {{ $voter->plain_password ? $voter->plain_password : '-' }}
                    </td>
                    <td>
                        @if($voter->is_active)
                            <span class="badge-active">Active</span>
                        @else
                            <span class="badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.voters.edit', $voter->id) }}"
                           class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.voters.destroy', $voter->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete"
                                    onclick="return confirm('Delete this voter?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else

        <div class="text-center text-white py-5">
            <h5>No Voters Found</h5>
            <p>Create your first voter to start election.</p>
        </div>

        @endif

    </div>

</div>

@endsection