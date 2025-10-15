<?php

namespace App\Http\Controllers\API\GlobalElectricianSponsor;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianSponsor;
use Illuminate\Http\Request;

class GlobalElectricianSponsorApiController extends Controller
{
    /**
     * Store a newly created sponsor.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'company_name'       => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'required|string|max:50',
            'state'              => 'nullable|string|max:100',
            'city'               => 'nullable|string|max:100',
            'country_id'         => 'required|exists:countries,id',
            'county_id'          => 'required|exists:counties,id',
            'parish_id'          => 'required|exists:parishes,id',
            'zip_code_id'        => 'required|exists:zip_codes,id',
            'message'            => 'nullable|string',
            'licence_number'     => 'nullable|string|max:100',
            'licence_agency_url' => 'nullable|url|max:255',
            'status'             => 'nullable|in:Active,Inactive',
        ]);

        // Create the sponsor
        $sponsor = GlobalElectricianSponsor::create($validated);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Sponsor created successfully',
            'data'    => $sponsor
        ], 201);
    }
}
