<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Election;

class VoterDashboardController extends Controller
{
    public function index()
    {
        $voter = Auth::guard('voter')->user();

        $elections = Election::with('candidates')
            ->where('is_active', true)
            ->where('is_locked', false)
            ->get();

        return view('voter.dashboard', compact('voter', 'elections'));
    }
}