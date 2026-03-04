<!DOCTYPE html>
<html lang="en">

<head>

<title>CSV ESCH Member Voting Portal</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
min-height:100vh;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
background:linear-gradient(180deg,#0b1f3a,#1d3e6e);
display:flex;
flex-direction:column;
}

/* Header */

.portal-header{
background:#ffffff;
border-bottom:1px solid #e5e7eb;
padding:18px 40px;
}

.portal-title{
font-weight:600;
font-size:18px;
color:#1e3a8a;
}

.portal-subtitle{
font-size:13px;
color:#6b7280;
}

/* Main */

.portal-container{
flex:1;
display:flex;
align-items:center;
justify-content:center;
padding:40px;
}

/* Login Card */

.login-card{
width:420px;
background:white;
border-radius:12px;
padding:40px;
box-shadow:0 10px 30px rgba(0,0,0,0.15);
animation:fadeUp .6s ease;
}

@keyframes fadeUp{
from{
opacity:0;
transform:translateY(15px);
}
to{
opacity:1;
transform:translateY(0);
}
}

.login-title{
font-size:22px;
font-weight:600;
margin-bottom:6px;
}

.login-subtitle{
font-size:14px;
color:#6b7280;
margin-bottom:28px;
}

.form-control{
height:46px;
border-radius:8px;
}

.form-control:focus{
border-color:#2563eb;
box-shadow:0 0 0 2px rgba(37,99,235,0.2);
}

.btn-login{
height:46px;
border-radius:8px;
font-weight:500;
background:#1d4ed8;
border:none;
color:white;
}

.btn-login:hover{
background:#1e40af;
}

.security-note{
font-size:12px;
color:#6b7280;
margin-top:18px;
}

.portal-footer{
text-align:center;
padding:18px;
font-size:12px;
color:#9ca3af;
}

</style>

</head>

<body>

<header class="portal-header d-flex justify-content-between align-items-center">

<div>
<div class="portal-title">CSV ESCH Voting System</div>
<div class="portal-subtitle">Luxembourg Member Portal</div>
</div>

</header>

<div class="portal-container">

<div class="login-card">

<div class="login-title">
 Voter Login
</div>

<div class="login-subtitle">
Authenticate to access the secure voting platform
</div>

{{-- Success message --}}
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

{{-- Error message --}}
@if($errors->any())
<div class="alert alert-danger">
{{ $errors->first() }}
</div>
@endif

<form method="POST"
action="{{ route('voter.login.submit') }}"
autocomplete="off"
id="loginForm">

@csrf

<div class="mb-3">

<label class="form-label">
Member ID
</label>

<input
type="text"
name="voter_id"
class="form-control"
value="{{ old('voter_id') }}"
placeholder="Enter your member ID"
required
autocomplete="off">

</div>

<div class="mb-3">

<label class="form-label">
Passcode
</label>

<input
type="password"
name="passcode"
class="form-control"
placeholder="Enter secure passcode"
required
autocomplete="new-password">

</div>

<button type="submit"
class="btn btn-login w-100"
id="loginBtn">

Sign In

</button>

</form>

<div class="security-note text-center">

🔒 Secure voting system — all sessions are encrypted.

</div>

</div>

</div>

<footer class="portal-footer">

© {{ date('Y') }} CSV ESCH Luxembourg • Secure Voting Portal

</footer>

<script>

/* Prevent double submit */

document.getElementById("loginForm").addEventListener("submit", function(){

document.getElementById("loginBtn").disabled = true;
document.getElementById("loginBtn").innerText = "Signing In...";

});

/* Ensure CSRF token always exists */

const token = document.querySelector('meta[name="csrf-token"]');

if(token){
window.Laravel = {
csrfToken: token.getAttribute('content')
};
}

</script>

</body>
</html>