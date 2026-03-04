<!DOCTYPE html>
<html lang="en">
<head>

<title>CSV ESCH Voting Portal</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
min-height:100vh;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
background:#f5f7fb;
}

/* Header */

.portal-header{
background:white;
border-bottom:1px solid #e5e7eb;
padding:18px 40px;
}

.portal-title{
font-size:18px;
font-weight:600;
color:#1e3a8a;
}

.portal-subtitle{
font-size:13px;
color:#6b7280;
}

/* Container */

.dashboard-container{
max-width:1100px;
margin:auto;
padding:40px 20px;
}

/* User card */

.user-card{
background:white;
border-radius:10px;
padding:22px;
box-shadow:0 6px 20px rgba(0,0,0,0.08);
margin-bottom:25px;
}

.logout-btn{
background:#ef4444;
border:none;
}

.logout-btn:hover{
background:#dc2626;
}

/* Election cards */

.election-card{
background:white;
border-radius:10px;
padding:25px;
box-shadow:0 6px 20px rgba(0,0,0,0.08);
margin-bottom:25px;
}

.election-title{
font-size:18px;
font-weight:600;
}

/* Candidate rows */

.candidate-row{
border:1px solid #e5e7eb;
border-radius:8px;
padding:12px;
margin-bottom:12px;
transition:.2s;
}

.candidate-row:hover{
background:#f3f4f6;
}

.candidate-img{
width:55px;
height:55px;
border-radius:50%;
object-fit:cover;
}

/* Vote button */

.vote-btn{
background:#1d4ed8;
border:none;
}

.vote-btn:hover{
background:#1e40af;
}

/* Alerts */

.alert{
border-radius:8px;
}

</style>

</head>

<body>

<header class="portal-header d-flex justify-content-between align-items-center">

<div>
<div class="portal-title">CSV ESCH Voting System</div>
<div class="portal-subtitle">Luxembourg Member Portal</div>
</div>

<form method="POST" action="{{ route('voter.logout') }}">
@csrf
<button class="btn btn-sm logout-btn text-white">
Logout
</button>
</form>

</header>

<div class="dashboard-container">

<div class="user-card d-flex justify-content-between align-items-center">

<div>
<strong>{{ $voter->name }}</strong><br>
<small class="text-muted">Member ID: {{ $voter->voter_id }}</small>
</div>

</div>


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif


@forelse($elections as $election)

@php
$alreadyVoted = \App\Models\Vote::where('voter_id',$voter->id)
->where('election_id',$election->id)
->exists();
@endphp

<div class="election-card">

<div class="election-title mb-2">
{{ $election->title }}
</div>

<div class="text-muted mb-3">
Select up to {{ $election->max_choices }} candidate(s)
</div>

@if($alreadyVoted)

<div class="alert alert-success">
You have already voted in this election.
</div>

@else

<form method="POST" action="{{ route('voter.vote') }}" class="vote-form">
@csrf

<input type="hidden" name="election_id" value="{{ $election->id }}">

@foreach($election->candidates as $candidate)

<label class="candidate-row w-100">

<div class="d-flex align-items-center">

<input
type="checkbox"
name="candidates[]"
value="{{ $candidate->id }}"
class="form-check-input me-3">

<img
src="{{ asset('storage/'.$candidate->photo) }}"
class="candidate-img me-3">

<div>

<strong>{{ $candidate->name }}</strong><br>

<small class="text-muted">
{{ $candidate->description }}
</small>

</div>

</div>

</label>

@endforeach

<button type="button" class="btn vote-btn text-white mt-3 openConfirm">
Submit Vote
</button>

</form>

@endif

</div>

@empty

<div class="alert alert-warning">
No active elections available.
</div>

@endforelse

</div>


<!-- CONFIRM VOTE MODAL -->

<div class="modal fade" id="confirmVoteModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Confirm Your Vote</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Are you sure you want to submit your vote?  
<strong>This action cannot be changed later.</strong>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
Cancel
</button>

<button type="button" class="btn btn-primary" id="confirmSubmit">
Yes, Submit Vote
</button>
</div>

</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

let selectedForm = null;

document.querySelectorAll(".openConfirm").forEach(btn=>{
btn.addEventListener("click",function(){

selectedForm = this.closest("form");

let modal = new bootstrap.Modal(document.getElementById("confirmVoteModal"));
modal.show();

});
});

document.getElementById("confirmSubmit").addEventListener("click",function(){

if(selectedForm){
selectedForm.submit();
}

});

</script>

</body>
</html>