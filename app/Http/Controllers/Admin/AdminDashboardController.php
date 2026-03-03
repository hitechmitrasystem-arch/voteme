<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Voter;
use App\Models\Vote;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $companyId = $admin->company_id ?? 1;

        $totalVoters = Voter::where('company_id', $companyId)->count();
        $totalElections = Election::where('company_id', $companyId)->count();
        $activeElections = Election::where('company_id', $companyId)
            ->where('is_active', true)
            ->count();
        $totalCandidates = Candidate::where('company_id', $companyId)->count();
        $totalVotes = Vote::where('company_id', $companyId)->count();

        $topCandidates = Candidate::where('company_id', $companyId)
            ->withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVoters',
            'totalElections',
            'activeElections',
            'totalCandidates',
            'totalVotes',
            'topCandidates'
        ));
    }
}