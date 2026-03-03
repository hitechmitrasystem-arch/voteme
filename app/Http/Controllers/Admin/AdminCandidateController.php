<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;

class AdminCandidateController extends Controller
{
    private function admin()
    {
        return auth('admin')->user();
    }

    private function companyId()
    {
        return $this->admin()->company_id ?? 1;
    }

    public function index()
    {
        $candidates = Candidate::where('company_id', $this->companyId())
            ->with('election')
            ->latest()
            ->paginate(15);

        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $elections = Election::where('company_id', $this->companyId())
            ->where('is_active', false)
            ->latest()
            ->get();

        return view('admin.candidates.create', compact('elections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($request->election_id);

        Candidate::create([
            'company_id'  => $this->companyId(),
            'election_id' => $election->id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.candidates.index')
            ->with('success', 'Candidate created successfully.');
    }

    public function edit($id)
    {
        $candidate = Candidate::where('company_id', $this->companyId())
            ->findOrFail($id);

        $elections = Election::where('company_id', $this->companyId())
            ->latest()
            ->get();

        return view('admin.candidates.edit', compact('candidate', 'elections'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::where('company_id', $this->companyId())
            ->findOrFail($id);

        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($request->election_id);

        $candidate->update([
            'election_id' => $election->id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.candidates.index')
            ->with('success', 'Candidate updated successfully.');
    }

    public function destroy($id)
    {
        $candidate = Candidate::where('company_id', $this->companyId())
            ->findOrFail($id);

        $candidate->delete();

        return redirect()
            ->route('admin.candidates.index')
            ->with('success', 'Candidate deleted successfully.');
    }
}