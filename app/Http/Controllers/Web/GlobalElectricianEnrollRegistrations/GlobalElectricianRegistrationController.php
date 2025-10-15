<?php

namespace App\Http\Controllers\Web\GlobalElectricianEnrollRegistrations;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianRegistration;
use Illuminate\Http\Request;

class GlobalElectricianRegistrationController extends Controller
{
    /**
     * Display a listing of the Global Electrician Registrations.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 2);

        $query = GlobalElectricianRegistration::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('licence_number', 'like', "%{$search}%")
                    ->orWhere('licence_agency_url', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate($perPage)->withQueryString();

        return view('backend.layouts.GlobalElectricianEnrollRegistrations.list', compact('registrations', 'search'));
    }



    // RegistrationController.php
    public function toggleStatus(GlobalElectricianRegistration $registration)
    {
        $registration->status = $registration->status === 'Active' ? 'Inactive' : 'Active';
        $registration->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
