<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('event')->latest()->get();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $events = Event::where('status', 'active')->get();
        return view('companies.create', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'booth_number' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        
        Company::create($validated);
        return redirect()->route('companies.index')->with('success', 'Company added successfully');
    }

    public function show(Company $company)
    {
        $company->load('event', 'visits.applicant');
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        $events = Event::where('status', 'active')->get();
        return view('companies.edit', compact('company', 'events'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'booth_number' => 'nullable|string',
        ]);

        $company->update($validated);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
