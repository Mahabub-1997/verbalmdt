<?php

namespace App\Http\Controllers\API\GlobalElectricianRegistrations;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianRegistration;
use App\Models\GlobalElectricianSponsor;
use Illuminate\Http\Request;

class GlobalElectricianRegistrationApiController extends Controller
{
    /**
     * Store a newly created registration.
     */
    public function store(Request $request)
    {
        //  Validate the incoming request
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'required|string|max:50',
            'state'              => 'nullable|string|max:100',
            'city'               => 'nullable|string|max:255',
            'country_id'         => 'required|exists:countries,id',
            'county_id'          => 'required|exists:counties,id',
            'parish_id'          => 'required|exists:parishes,id',
            'zip_code_id'        => 'required|exists:zip_codes,id',
            'message'            => 'nullable|string',
            'licence_number'     => 'nullable|string|max:100',
            'licence_agency_url' => 'nullable|url|max:255',
            // Add status validation
            'status'             => 'nullable|in:Active,Inactive',
        ]);

        // Default to 'Active' if not provided
        $validated['status'] = $validated['status'] ?? 'Active';

        // Create the record
        $registration = GlobalElectricianRegistration::create($validated);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Registration created successfully',
            'data'    => $registration,
        ], 201);
    }
}
