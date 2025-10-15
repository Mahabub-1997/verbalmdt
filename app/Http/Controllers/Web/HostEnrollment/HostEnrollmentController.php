<?php

namespace App\Http\Controllers\Web\HostEnrollment;

use App\Http\Controllers\Controller;
use App\Models\HostEnrollment;
use App\Models\Question;
use Illuminate\Http\Request;

class HostEnrollmentController extends Controller
{

    public function index(Request $request)
    {
        $query = HostEnrollment::query();
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('licence_number', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 5);
        $enrollments = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        return view('backend.layouts.hostEnrollments.list', compact('enrollments'));
    }
    public function create()
    {
        $questions = \App\Models\Question::all();
        return view('backend.layouts.hostEnrollments.add', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'answers_json' => 'nullable|array',
        ]);

        HostEnrollment::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'annual_income' => $request->annual_income,
            'employee_number' => $request->employee_number,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip_number' => $request->zip_number,
            'parish' => $request->parish,
            'county' => $request->county,
            'message' => $request->message,
            'licence_number' => $request->licence_number,
            'licence_agency_url' => $request->licence_agency_url,
            'answers_json' => $request->answers_json,
        ]);

        return redirect()->route('hostEnrollments.index')->with('success', 'Host Enrollment created successfully!');
    }
    public function toggleStatus($id)
    {
        $enroll = HostEnrollment::findOrFail($id);
        $enroll->status = $enroll->status === 'Active' ? 'Inactive' : 'Active';
        $enroll->save();

        return redirect()->back()->with('success', 'Enrollment status updated successfully!');
    }
}
