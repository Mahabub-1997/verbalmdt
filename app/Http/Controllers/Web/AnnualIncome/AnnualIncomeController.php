<?php

namespace App\Http\Controllers\Web\AnnualIncome;

use App\Http\Controllers\Controller;
use App\Models\AnnualIncome;
use Illuminate\Http\Request;

class AnnualIncomeController extends Controller
{
    public function index()
    {
        $incomes = AnnualIncome::latest()->paginate(10);
        return view('backend.layouts.ourServices.annualIncome.list', compact('incomes'));
    }

    public function create()
    {
        return view('backend.layouts.ourServices.annualIncome.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'annual_income' => 'required|string|max:100',
        ]);

        AnnualIncome::create($request->only('annual_income'));

        return redirect()->route('annual-incomes.index')->with('success', 'Annual Income added successfully!');
    }
    public function edit(AnnualIncome $annualIncome)
    {
        // Return the edit view with the selected record
        return view('backend.layouts.ourServices.annualIncome.edit', compact('annualIncome'));
    }

    public function update(Request $request, AnnualIncome $annualIncome)
    {
        // Validate input
        $request->validate([
            'annual_income' => 'required|string|max:100',
        ]);

        // Update record
        $annualIncome->update([
            'annual_income' => $request->annual_income,
        ]);

        // Redirect with success message
        return redirect()->route('annual-incomes.index')->with('success', 'Annual Income updated successfully!');
    }
    public function destroy(AnnualIncome $annualIncome)
    {
        try {
            $annualIncome->delete();

            return redirect()
                ->route('annual-incomes.index')
                ->with('success', 'Annual Income deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('annual-incomes.index')
                ->with('error', 'Something went wrong while deleting the record.');
        }
    }
}
