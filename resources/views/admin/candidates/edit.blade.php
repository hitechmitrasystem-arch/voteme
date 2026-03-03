@extends('admin.layouts.app')

@section('content')

<div class="container py-4">
    <h2 class="mb-4">Edit Candidate</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Election</label>
                    <select name="election_id" class="form-control" required>
                        <option value="">Select Election</option>
                        @foreach ($elections as $election)
                            <option value="{{ $election->id }}"
                                {{ $candidate->election_id == $election->id ? 'selected' : '' }}>
                                {{ $election->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Candidate Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control"
                        value="{{ old('name', $candidate->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea 
                        name="description" 
                        class="form-control"
                        rows="3"
                    >{{ old('description', $candidate->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Candidate
                </button>

                <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
</div>

@endsection