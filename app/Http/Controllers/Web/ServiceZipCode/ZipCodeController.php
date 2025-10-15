<?php

namespace App\Http\Controllers\Web\ServiceZipCode;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Parish;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zipCodes = ZipCode::with('parish.county')->latest()->paginate(10);
        return view('backend.layouts.ourServices.serviceZipCode.list', compact('zipCodes'));
    }
    /**
     * Show the form for creating a new zip code.
     */
    public function create()
    {
        $parishes = Parish::orderBy('name')->get();
        return view('backend.layouts.ourServices.serviceZipCode.add', compact('parishes'));
    }

    /**
     * Store a newly created zip code.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:20',
            'parish_id' => 'required|exists:parishes,id',
        ]);

        ZipCode::create($request->only('code', 'parish_id'));

        return redirect()->route('zip_codes.index')
            ->with('success', 'Zip Code created successfully!');
    }
    /**
     * Show the form for editing the specified zip code.
     */
    public function edit($id)
    {
        $zipCode = ZipCode::findOrFail($id);
        $parishes = Parish::orderBy('name')->get();

        return view('backend.layouts.ourServices.serviceZipCode.edit', compact('zipCode', 'parishes'));
    }

    /**
     * Update the specified zip code in storage.
     */
    public function update(Request $request, $id)
    {
        $zipCode = ZipCode::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:20',
            'parish_id' => 'required|exists:parishes,id',
        ]);

        $zipCode->update($request->only('code', 'parish_id'));

        return redirect()->route('zip_codes.index')
            ->with('success', 'Zip Code updated successfully!');
    }
    /**
     * Remove the specified zip code from storage.
     */
    public function destroy($id)
    {
        $zipCode = ZipCode::findOrFail($id);
        $zipCode->delete();

        return redirect()->route('admin.zip_codes.index')
            ->with('success', 'Zip Code deleted successfully!');
    }


}
