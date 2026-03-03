<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    private function voter()
    {
        return auth('voter')->user();
    }

    /*
    |--------------------------------------------------------------------------
    | Store Vote (Multiple Selection)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'election_id'  => 'required|exists:elections,id',
            'candidates'   => 'required|array|min:1',
            'candidates.*' => 'exists:candidates,id',
        ]);

        $voter = $this->voter();

        $election = Election::where('is_active', true)
            ->where('is_locked', false)
            ->findOrFail($request->election_id);

        // Check if voter already voted in this election
        $alreadyVoted = Vote::where('voter_id', $voter->id)
            ->where('election_id', $election->id)
            ->exists();

        if ($alreadyVoted) {
            return back()->withErrors([
                'error' => 'You have already voted in this election.'
            ]);
        }

        // Check max choices
        if (count($request->candidates) > $election->max_choices) {
            return back()->withErrors([
                'error' => "You can select maximum {$election->max_choices} candidates."
            ]);
        }

        foreach ($request->candidates as $candidateId) {
            Vote::create([
                'company_id'  => $voter->company_id,
                'election_id' => $election->id,
                'candidate_id'=> $candidateId,
                'voter_id'    => $voter->id,
            ]);
        }

        return redirect()
            ->route('voter.results', $election->id)
            ->with('success', 'Vote submitted successfully.');
    }
}