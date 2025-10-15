<?php

namespace App\Http\Controllers\API\HostEnrollmentApi;

use App\Http\Controllers\Controller;
use App\Models\HostEnrollment;
use Illuminate\Http\Request;

class HostEnrollmentApiController extends Controller
{
    // GET all enrollments
    public function index()
    {
        $enrollments = HostEnrollment::all();

        return response()->json([
            'status' => true,
            'message' => 'Host Enrollments fetched successfully',
            'data' => $enrollments
        ], 200);
    }

    // POST a new enrollment
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'annual_income_id' => 'nullable|exists:annual_incomes,id',
            'employee_number' => 'nullable|string|max:100',
            'country_id' => 'required|exists:countries,id',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code_id' => 'required|exists:zip_codes,id',
            'parish_id' => 'required|exists:parishes,id',
            'county_id' => 'required|exists:counties,id',
            'licence_number' => 'nullable|string|max:100',
            'licence_agency_url' => 'nullable|url|max:255',
            'message' => 'nullable|string',
            'answers_json' => 'nullable|array',
            'status' => 'nullable|in:Active,Inactive', // Status validation
        ]);

        // Set default status if not provided
        $validated['status'] = $validated['status'] ?? 'Inactive';

        // Create the enrollment
        $enrollment = HostEnrollment::create($validated);

        // Return JSON response
        return response()->json([
            'status' => true,
            'message' => 'Host Enrollment created successfully',
            'data' => $enrollment
        ], 201);
    }
}
