<!DOCTYPE html>
<html lang="en">
<head>

<title>CSV ESCH Voting Portal</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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

/* Center area */

.portal-container{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px;
}

/* Layout grid */

.login-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
    width:820px;
}

/* Login cards */

.login-card{
    background:white;
    border-radius:12px;
    padding:40px;
    box-shadow:0 10px 30px rgba(0,0,0,0.15);
    text-align:center;
}

.card-title{
    font-size:20px;
    font-weight:600;
    margin-bottom:10px;
}

.card-desc{
    font-size:14px;
    color:#6b7280;
    margin-bottom:30px;
}

/* Icons */

.login-icon{
    font-size:42px;
    margin-bottom:15px;
}

/* Buttons */

.btn-login{
    height:46px;
    border-radius:8px;
    font-weight:500;
}

/* Voter button */

.btn-voter{
    background:#1d4ed8;
    border:none;
}

.btn-voter:hover{
    background:#1e40af;
}

/* Admin button */

.btn-admin{
    background:#374151;
    border:none;
}

.btn-admin:hover{
    background:#111827;
}

/* Footer */

.portal-footer{
    text-align:center;
    padding:18px;
    font-size:12px;
    color:#cbd5e1;
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

<div class="login-grid">

<!-- VOTER LOGIN -->

<div class="login-card">

<div class="login-icon text-primary">
<i class="bi bi-person-check"></i>
</div>

<div class="card-title">
Login as a Voter
</div>

<div class="card-desc">
Access the secure member voting portal
</div>

<a href="{{ route('voter.login') }}" class="btn btn-login btn-voter text-white w-100">
Login as Member
</a>

</div>


<!-- ADMIN LOGIN -->

<div class="login-card">

<div class="login-icon text-secondary">
<i class="bi bi-building"></i>
</div>

<div class="card-title">
Administration
</div>

<div class="card-desc">
Manage elections and voting administration
</div>

<a href="{{ route('admin.login') }}" class="btn btn-login btn-admin text-white w-100">
Admin Login
</a>

</div>

</div>

</div>


<footer class="portal-footer">

© {{ date('Y') }} CSV ESCH Luxembourg • Secure Voting Portal

</footer>

</body>
</html>