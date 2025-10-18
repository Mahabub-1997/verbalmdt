<?php

namespace App\Http\Controllers\API\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    // POST /api/service-providers
//    public function store(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
//            'category_id' => 'required|exists:service_categories,id',
//            'subcategory_id' => 'required|exists:service_subcategories,id',
//            'pricing_type_id' => 'required|exists:pricing_types,id',
//            'company_name' => 'required|string|max:255',
//            'phone' => 'required|string|max:20',
//            'email' => 'nullable|email|max:100',
//            'country_id' => 'required|exists:countries,id',
//            'county_id' => 'required|exists:counties,id',
//            'parish_id' => 'required|exists:parishes,id',
//            'zip_code_id' => 'required|exists:zip_codes,id',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => 'error',
//                'errors' => $validator->errors()
//            ], 422);
//        }
//
//        $provider = ServiceProvider::create($request->all());
//
//        return response()->json([
//            'status' => 'success',
//            'data' => $provider
//        ], 201);
//    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:service_categories,id',
            'subcategory_id' => 'required|exists:service_subcategories,id',
            'pricing_type_id' => 'required|exists:pricing_types,id',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'country_id' => 'required|exists:countries,id',
            'county_id' => 'required|exists:counties,id',
            'parish_id' => 'required|exists:parishes,id',
            'zip_code_id' => 'required|exists:zip_codes,id',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'upload_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        // File uploads
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('service_providers/cover_photos', 'public');
        }

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('service_providers/logos', 'public');
        }

        if ($request->hasFile('upload_document')) {
            $data['upload_document'] = $request->file('upload_document')->store('service_providers/documents', 'public');
        }

        $provider = ServiceProvider::create($data);

        // Add URL to files
        $provider->cover_photo = $provider->cover_photo ? asset('storage/' . $provider->cover_photo) : null;
        $provider->logo = $provider->logo ? asset('storage/' . $provider->logo) : null;
        $provider->upload_document = $provider->upload_document ? asset('storage/' . $provider->upload_document) : null;

        return response()->json([
            'status' => 'success',
            'data' => $provider
        ], 201);
    }
}
