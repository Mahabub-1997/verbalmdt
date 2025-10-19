<?php

namespace App\Http\Controllers\Web\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\County;
use App\Models\Parish;
use App\Models\PricingType;
//use App\Models\ProviderService;
use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use App\Models\ServiceSubcategory;
use App\Models\User;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the service providers.
     */
    public function index()
    {
        $providers = ServiceProvider::with(['user','category','subcategory','pricingType'])->paginate(10);
        return view('backend.layouts.serviceProvider.list', compact('providers'));
    }

    /**
     * Show the form for creating a new service provider.
     */

    public function create()
    {
        $users = User::all();
        $categories = ServiceCategory::all();
        $subcategories = ServiceSubcategory::all();
        $pricingTypes = PricingType::all();
        $countries = Country::all();
        $counties = County::all();
        $parishes = Parish::all();
        $zipCodes = ZipCode::all();

        return view('backend.layouts.serviceProvider.add', compact(
            'users', 'categories', 'subcategories', 'pricingTypes',
            'countries', 'counties', 'parishes', 'zipCodes'
        ));
    }

    /**
     * Store a newly created service provider in storage.
     */
    public function store(Request $request)
    {
        // Validate main provider and multiple services
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:service_categories,id',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'upload_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'amount' => 'nullable|numeric',

            // Multiple services validation
            'subcategories' => 'required|array|min:1',
            'subcategories.*' => 'required|exists:service_subcategories,id',
        ]);

        // Prepare ServiceProvider data
        $providerData = $request->only([
            'user_id', 'category_id', 'company_name', 'phone', 'email', 'description',
            'registration_number', 'year_of_establishment', 'total_employees',
            'country_id', 'county_id', 'parish_id', 'zip_code_id', 'state', 'city', 'address',
            'experience_years', 'licence_number', 'licence_agency_url', 'pricing_type_id','amount'
        ]);

        // Handle file uploads
        if ($request->hasFile('cover_photo')) {
            $providerData['cover_photo'] = $request->file('cover_photo')->store('providers', 'public');
        }
        if ($request->hasFile('logo')) {
            $providerData['logo'] = $request->file('logo')->store('providers', 'public');
        }
        if ($request->hasFile('upload_document')) {
            $providerData['upload_document'] = $request->file('upload_document')->store('providers', 'public');
        }

        // Save subcategories as JSON
        $providerData['subcategory_ids'] = $request->subcategories;

        // Create ServiceProvider
        $provider = ServiceProvider::create($providerData);

//

        return redirect()->route('service-providers.index')
            ->with('success', 'Service Provider created successfully.');
    }
    /**
     * Show the form for editing the specified service provider.
     */
    public function edit($id)
    {
        $provider = \App\Models\ServiceProvider::findOrFail($id);

        // Fetch all related data for dropdowns
        $users = \App\Models\User::all();
        $categories = \App\Models\ServiceCategory::all();
        $subcategories = \App\Models\ServiceSubcategory::all();
        $countries = \App\Models\Country::all();
        $counties = \App\Models\County::all();
        $parishes = \App\Models\Parish::all();
        $zipCodes = \App\Models\ZipCode::all();
        $pricingTypes = \App\Models\PricingType::all();

        // Pass data to the edit view
        return view('backend.layouts.serviceProvider.edit', compact(
            'provider',
            'users',
            'categories',
            'subcategories',
            'countries',
            'counties',
            'parishes',
            'zipCodes',
            'pricingTypes'
        ));
    }

    /**
     * Update the specified service provider in storage.
     */
    public function update(Request $request, $id)
    {
        $provider = \App\Models\ServiceProvider::findOrFail($id);

        // Validate request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:service_categories,id',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'upload_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'amount' => 'nullable|numeric',
            'subcategories' => 'required|array|min:1',
            'subcategories.*' => 'required|exists:service_subcategories,id',
        ]);

        // Prepare data
        $providerData = $request->only([
            'user_id', 'category_id', 'company_name', 'phone', 'email', 'description',
            'registration_number', 'year_of_establishment', 'total_employees',
            'country_id', 'county_id', 'parish_id', 'zip_code_id', 'state', 'city', 'address',
            'experience_years', 'licence_number', 'licence_agency_url', 'pricing_type_id', 'amount'
        ]);

        // Handle file uploads
        if ($request->hasFile('cover_photo')) {
            if ($provider->cover_photo) {
                \Storage::disk('public')->delete($provider->cover_photo);
            }
            $providerData['cover_photo'] = $request->file('cover_photo')->store('providers', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($provider->logo) {
                \Storage::disk('public')->delete($provider->logo);
            }
            $providerData['logo'] = $request->file('logo')->store('providers', 'public');
        }

        if ($request->hasFile('upload_document')) {
            if ($provider->upload_document) {
                \Storage::disk('public')->delete($provider->upload_document);
            }
            $providerData['upload_document'] = $request->file('upload_document')->store('providers', 'public');
        }

        // Save subcategories as JSON
        $providerData['subcategory_ids'] = $request->subcategories;

        // Update provider
        $provider->update($providerData);

        return redirect()->route('service-providers.index')
            ->with('success', 'Service Provider updated successfully.');
    }

    /**
     * Remove the specified service provider from storage.
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        $serviceProvider->services()->delete(); // delete related services first
        $serviceProvider->delete();

        return redirect()->route('service-providers.index')->with('success', 'Service Provider deleted successfully.');
    }
}
