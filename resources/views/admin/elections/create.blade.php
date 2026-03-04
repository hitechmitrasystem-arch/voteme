<!DOCTYPE html>
<html>
<head>
    <title>Create Election</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    min-height:100vh;
    font-family:'Segoe UI', sans-serif;

    background: linear-gradient(-45deg,#000428,#004e92,#000046,#1a2980);
    background-size:400% 400%;
    animation:gradientMove 12s ease infinite;

    color:white;
}

@keyframes gradientMove{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

/* Center container */

.container{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* Glass Card */

.glass-card{
    width:520px;

    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);

    border-radius:18px;
    padding:40px;

    box-shadow:0 25px 60px rgba(0,0,0,0.6);

    animation:cardEntry 0.8s ease;
}

@keyframes cardEntry{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* Title */

h3{
    font-weight:700;
    text-align:center;
    margin-bottom:30px;
}

/* Inputs */

.form-control{
    background:rgba(255,255,255,0.12);
    border:none;
    color:white;
    border-radius:10px;
}

.form-control:focus{
    background:rgba(255,255,255,0.18);
    color:white;

    box-shadow:0 0 10px #2e5bff;
}

/* Labels */

.form-label{
    font-weight:500;
}

/* Buttons */

.btn{
    border-radius:30px;
    transition:0.25s ease;
}

/* Primary Button */

.btn-primary{
    background:#1f3c88;
    border:none;
}

.btn-primary:hover{
    background:#2e5bff;
    box-shadow:0 0 15px #2e5bff;
    transform:translateY(-2px);
}

/* Back Button */

.btn-outline-light:hover{
    background:#2e5bff;
    border-color:#2e5bff;
}

/* Alert */

.alert{
    border-radius:10px;
}

</style>

</head>


<body>

<div class="container">

    <div class="glass-card">

        <h3>Create Election</h3>

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
                <input type="text"
                       name="title"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="datetime-local"
                       name="start_time"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Time</label>
                <input type="datetime-local"
                       name="end_time"
                       class="form-control"
                       required>
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
           class="btn btn-outline-light w-100 mt-3">
            ← Back
        </a>

    </div>

</div>

</body>
</html>