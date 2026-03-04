<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\Request;

class AdminElectionController extends Controller
{

    private function admin()
    {
        return auth('admin')->user();
    }

    private function companyId()
    {
        return $this->admin()->company_id ?? 1;
    }

    /*
    |--------------------------------------------------------------------------
    | List Elections
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $elections = Election::where('company_id', $this->companyId())
            ->latest()
            ->paginate(15);

        return view('admin.elections.index', compact('elections'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.elections.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time'  => 'required|date',
            'end_time'    => 'required|date|after:start_time',
            'max_choices' => 'required|integer|min:1',
        ]);

        Election::create([
            'company_id'  => $this->companyId(),
            'title'       => $request->title,
            'description' => $request->description,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'max_choices' => $request->max_choices,
            'is_active'   => false,
            'is_locked'   => false,
        ]);

        return redirect()
            ->route('admin.elections.index')
            ->with('success', 'Election created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($id);

        return view('admin.elections.edit', compact('election'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time'  => 'required|date',
            'end_time'    => 'required|date|after:start_time',
            'max_choices' => 'required|integer|min:1',
        ]);

        $election->update([
            'title'       => $request->title,
            'description' => $request->description,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'max_choices' => $request->max_choices,
        ]);

        return redirect()
            ->route('admin.elections.index')
            ->with('success', 'Election updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($id);

        $election->delete();

        return redirect()
            ->route('admin.elections.index')
            ->with('success', 'Election deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Start / Stop Election
    |--------------------------------------------------------------------------
    */
    public function toggle($id)
    {
        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($id);

        $election->is_active = !$election->is_active;
        $election->save();

        return back()->with('success', 'Election status updated.');
    }

    /*
    |--------------------------------------------------------------------------
    | Lock Election (No More Voting)
    |--------------------------------------------------------------------------
    */
    public function lock($id)
    {
        $election = Election::where('company_id', $this->companyId())
            ->findOrFail($id);

        $election->is_locked = true;
        $election->save();

        return back()->with('success', 'Election locked successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Results Page
    |--------------------------------------------------------------------------
    */
    public function results($id)
    {
        $election = Election::where('company_id', $this->companyId())
            ->with(['candidates.votes'])
            ->findOrFail($id);

        return view('admin.elections.results', compact('election'));
    }
}