<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'candidates'  => 'required|array|min:1'
        ]);

        $voter = Auth::guard('voter')->user();

        if (!$voter) {
            return redirect()->route('voter.login')
                ->with('error', 'Please login first.');
        }

        $election = Election::where('id', $request->election_id)
            ->where('company_id', $voter->company_id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Check if election locked
        |--------------------------------------------------------------------------
        */

        if ($election->is_locked) {
            return back()->with('error', 'This election is locked.');
        }

        /*
        |--------------------------------------------------------------------------
        | Check already voted
        |--------------------------------------------------------------------------
        */

        $alreadyVoted = Vote::where('voter_id', $voter->id)
            ->where('election_id', $election->id)
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'You have already voted in this election.');
        }

        /*
        |--------------------------------------------------------------------------
        | Max candidate selection check
        |--------------------------------------------------------------------------
        */

        if (count($request->candidates) > $election->max_choices) {
            return back()->with('error', 'Too many selections.');
        }

        /*
        |--------------------------------------------------------------------------
        | Store Votes (transaction safe)
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            foreach ($request->candidates as $candidateId) {

                $candidate = Candidate::where('id', $candidateId)
                    ->where('election_id', $election->id)
                    ->first();

                if (!$candidate) {
                    continue;
                }

                Vote::create([
                    'voter_id'     => $voter->id,
                    'election_id'  => $election->id,
                    'candidate_id' => $candidate->id,
                    'company_id'   => $voter->company_id
                ]);

                /*
                |--------------------------------------------------------------------------
                | Increment vote count
                |--------------------------------------------------------------------------
                */

                $candidate->increment('vote_count');
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Vote submission failed. Please try again.');
        }

        return redirect()
            ->route('voter.dashboard')
            ->with('success', 'Vote submitted successfully!');
    }
}