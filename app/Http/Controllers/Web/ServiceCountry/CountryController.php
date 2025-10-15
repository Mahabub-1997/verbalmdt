<?php

namespace App\Http\Controllers\Web\ServiceCountry;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::latest()->paginate(10);
        return view('backend.layouts.ourServices.serviceCountry.list', compact('countries'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.ourServices.serviceCountry.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:countries,name',
        ]);

        Country::create([
            'name' => $request->name,
        ]);

        return redirect()->route('countries.index')
            ->with('success', 'Country created successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('backend.layouts.ourServices.serviceCountry.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:countries,name,' . $country->id,
        ]);

        $country->update([
            'name' => $request->name,
        ]);

        return redirect()->route('countries.index')
            ->with('success', 'Country updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Country deleted successfully!');
    }
}
