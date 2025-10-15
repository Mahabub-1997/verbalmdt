<?php

namespace App\Http\Controllers\Web\ServiceCounty;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counties = County::with('country')->latest()->paginate(10);
        return view('backend.layouts.ourServices.serviceCounty.list', compact('counties'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        return view('backend.layouts.ourServices.serviceCounty.add', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'country_id' => 'required|exists:countries,id',
        ]);

        County::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('counties.index')->with('success', 'County created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $county = \App\Models\County::findOrFail($id);
        $countries = \App\Models\Country::orderBy('name')->get();

        return view('backend.layouts.ourServices.serviceCounty.edit', compact('county', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $county = \App\Models\County::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'country_id' => 'required|exists:countries,id',
        ]);

        $county->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('counties.index')
            ->with('success', 'County updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $county = County::findOrFail($id);
        $county->delete();

        return redirect()->route('counties.index')
            ->with('success', 'County deleted successfully!');
    }
}
