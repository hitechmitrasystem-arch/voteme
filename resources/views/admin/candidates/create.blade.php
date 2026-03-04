@extends('admin.layouts.app')

@section('content')

<style>
.page-container {
    padding-top: 70px;
}

.glass-card {
    border-radius: 20px;
    background: #1f2937;
    padding: 40px;
    color: white;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}

.form-control {
    background: #111827;
    border: 1px solid #374151;
    color: #fff;
}

.form-control:focus {
    background: #1f2937;
    border-color: #22c55e;
    box-shadow: none;
    color: #fff;
}

.preview-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    margin-top: 10px;
    border: 3px solid #22c55e;
}
</style>

<div class="container page-container">

    <h2 class="mb-4 text-white">Create Candidate</h2>

    <div class="glass-card">

        <form action="{{ route('admin.candidates.store') }}" 
              method="POST" 
              enctype="multipart/form-data">

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

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="preview" class="preview-img d-none">
            </div>

            <button type="submit" class="btn btn-success">
                Save Candidate
            </button>

            <a href="{{ route('admin.candidates.index') }}" 
               class="btn btn-outline-light ms-2">
                Back
            </a>

        </form>

    </div>

</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.classList.remove('d-none');
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection