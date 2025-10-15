<?php

namespace App\Http\Controllers\Web\GlobalElectricianSponsorWeb;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianSponsor;
use Illuminate\Http\Request;

class GlobalElectricianSponsorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 3);

        $query = GlobalElectricianSponsor::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('licence_number', 'like', "%{$search}%")   // new
                    ->orWhere('licence_agency_url', 'like', "%{$search}%"); // new
            });
        }

        $sponsors = $query->latest()->paginate($perPage)->withQueryString();

        return view('backend.layouts.GlobalElectricianSponsor.list', compact('sponsors'));
    }
    // SponsorController.php
    public function toggleStatus(GlobalElectricianSponsor $sponsor)
    {
        $sponsor->status = $sponsor->status === 'Active' ? 'Inactive' : 'Active';
        $sponsor->save();

        return redirect()->back()->with('success', 'Sponsor status updated successfully!');
    }
}
