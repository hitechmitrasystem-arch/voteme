<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'candidates' => 'required|array|min:1',
        ]);

        $voter = Auth::guard('voter')->user();

        $election = Election::findOrFail($request->election_id);

        if ($election->is_locked) {
            return back()->with('error', 'Election is locked.');
        }

        // Check if already voted
        $alreadyVoted = Vote::where('voter_id', $voter->id)
            ->where('election_id', $election->id)
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'You already voted.');
        }

        if (count($request->candidates) > $election->max_choices) {
            return back()->with('error', 'Too many selections.');
        }

        foreach ($request->candidates as $candidateId) {

            Vote::create([
                'voter_id' => $voter->id,
                'election_id' => $election->id,
                'candidate_id' => $candidateId,
                'company_id' => $voter->company_id,
            ]);

            Candidate::where('id', $candidateId)
                ->increment('vote_count');
        }

        return redirect()->route('voter.dashboard')
            ->with('success', 'Vote submitted successfully!');
    }
}