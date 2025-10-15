<?php

namespace App\Http\Controllers\Web\ServiceParish;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Parish;
use Illuminate\Http\Request;

class ParishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parishes = Parish::with('county')->latest()->paginate(10);
        return view('backend.layouts.ourServices.serviceParish.list', compact('parishes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::orderBy('name')->get();
        return view('backend.layouts.ourServices.serviceParish.add', compact('counties'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'county_id' => 'required|exists:counties,id',
        ]);

        Parish::create($request->all());

        return redirect()->route('parishes.index')->with('success', 'Parish created successfully.');
    }
    /**
     * Show the form for editing the specified parish.
     */
    public function edit($id)
    {
        $parish = \App\Models\Parish::findOrFail($id);
        $counties = \App\Models\County::orderBy('name')->get();

        return view('backend.layouts.ourServices.serviceParish.edit', compact('parish', 'counties'));
    }

    /**
     * Update the specified parish in storage.
     */
    public function update(Request $request, $id)
    {
        $parish = \App\Models\Parish::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'county_id' => 'required|exists:counties,id',
        ]);

        $parish->update($request->only('name', 'county_id'));

        return redirect()->route('parishes.index')
            ->with('success', 'Parish updated successfully!');
    }
    /**
     * Remove the specified parish from storage.
     */
    public function destroy($id)
    {
        $parish = Parish::findOrFail($id);
        $parish->delete();

        return redirect()->route('parishes.index')
            ->with('success', 'Parish deleted successfully!');
    }
}
