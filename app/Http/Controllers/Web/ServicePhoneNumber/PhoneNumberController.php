<?php

namespace App\Http\Controllers\Web\ServicePhoneNumber;

use App\Http\Controllers\Controller;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    public function index()
    {
        $phoneNumbers = PhoneNumber::latest()->paginate(10);
        return view('backend.layouts.ourServices.ServicePhoneNumber.list', compact('phoneNumbers'));
    }

    public function create()
    {
        return view('backend.layouts.ourServices.ServicePhoneNumber.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:100',
        ]);

        PhoneNumber::create($request->all());

        return redirect()->route('phone-numbers.index')
            ->with('success', 'Phone number added successfully.');
    }
    public function edit(PhoneNumber $phoneNumber)
    {
        return view('backend.layouts.ourServices.ServicePhoneNumber.edit', compact('phoneNumber'));
    }

    public function update(Request $request, PhoneNumber $phoneNumber)
    {
        $request->validate([
            'phone_number' => 'required|string|max:100',
        ]);

        $phoneNumber->update([
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('phone-numbers.index')
            ->with('success', 'Phone number updated successfully.');
    }
    public function destroy(PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();

        return redirect()->route('phone-numbers.index')
            ->with('success', 'Phone number deleted successfully.');
    }
}
