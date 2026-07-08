<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Company;
use App\Models\CompanyVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyVisitController extends Controller
{
    public function scan()
    {
        return view('company.scan');
    }

    public function lookup(Request $request)
    {
        $validated = $request->validate([
            'qr_code' => 'required|string',
        ]);

        $company = Auth::user()->companies()->first();

        if (!$company) {
            return back()->with('error', 'No company is linked to your account.');
        }

        $applicant = Applicant::where('qr_code', $validated['qr_code'])->first();

        if (!$applicant) {
            return back()->with('error', 'Applicant not found with this QR code');
        }

        // Record the visit only once per company/applicant pair.
        CompanyVisit::updateOrCreate(
            [
                'company_id' => $company->id,
                'applicant_id' => $applicant->id,
            ],
            [
                'visited_at' => now(),
            ]
        );

        return view('company.applicant', compact('applicant'));
    }

    public function saveNote(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string',
            'status' => 'required|in:viewed,shortlisted,rejected',
        ]);

        $company = Auth::user()->companies()->first();

        if (!$company) {
            return back()->with('error', 'No company is linked to your account.');
        }

        $visit = CompanyVisit::where('company_id', $company->id)
            ->where('applicant_id', $applicant->id)
            ->first();

        if (!$visit) {
            return back()->with('error', 'No visit record found for this applicant. Please scan their QR code first.');
        }

        $visit->update([
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Note saved successfully');
    }

    public function myVisits()
    {
        $company = Auth::user()->companies()->first();

        if (!$company) {
            return back()->with('error', 'No company is linked to your account.');
        }

        $visits = CompanyVisit::where('company_id', $company->id)
            ->with('applicant')
            ->latest()
            ->get();

        return view('company.visits', compact('visits'));
    }
}
