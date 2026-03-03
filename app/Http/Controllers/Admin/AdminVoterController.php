<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminVoterController extends Controller
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
        $voters = Voter::where('company_id', $this->companyId())
            ->latest()
            ->paginate(15);

        return view('admin.voters.index', compact('voters'));
    }

    public function create()
    {
        return view('admin.voters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $voterId = strtoupper(Str::random(8));
        $plainPassword = Str::random(8);

        Voter::create([
            'company_id'           => $this->companyId(),
            'voter_id'             => $voterId,
            'name'                 => $request->name,
            'email'                => $request->email,
            'password'             => Hash::make($plainPassword),
            'is_active'            => true,
            'must_change_password' => true,
        ]);

        return redirect()
            ->route('admin.voters.index')
            ->with('success', "Voter created. Password: {$plainPassword}");
    }

    public function edit($id)
    {
        $voter = Voter::where('company_id', $this->companyId())
            ->findOrFail($id);

        return view('admin.voters.edit', compact('voter'));
    }

    public function update(Request $request, $id)
    {
        $voter = Voter::where('company_id', $this->companyId())
            ->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $voter->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.voters.index')
            ->with('success', 'Voter updated successfully.');
    }

    public function destroy($id)
    {
        $voter = Voter::where('company_id', $this->companyId())
            ->findOrFail($id);

        $voter->delete();

        return redirect()
            ->route('admin.voters.index')
            ->with('success', 'Voter deleted successfully.');
    }
}