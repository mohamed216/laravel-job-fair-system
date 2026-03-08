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
        $qrCode = $request->get('qr_code');
        $applicant = Applicant::where('qr_code', $qrCode)->first();

        if (!$applicant) {
            return back()->with('error', 'Applicant not found with this QR code');
        }

        $company = Auth::user()->companies()->first();
        
        // Record the visit
        CompanyVisit::create([
            'company_id' => $company->id,
            'applicant_id' => $applicant->id,
            'visited_at' => now(),
            'status' => 'viewed'
        ]);

        return view('company.applicant', compact('applicant'));
    }

    public function saveNote(Request $request, Applicant $applicant)
    {
        $request->validate([
            'notes' => 'nullable|string',
            'status' => 'required|in:viewed,shortlisted,rejected'
        ]);

        $company = Auth::user()->companies()->first();
        
        $visit = CompanyVisit::where('company_id', $company->id)
            ->where('applicant_id', $applicant->id)
            ->first();

        if ($visit) {
            $visit->update([
                'notes' => $request->notes,
                'status' => $request->status
            ]);
        }

        return back()->with('success', 'Note saved successfully');
    }

    public function myVisits()
    {
        $company = Auth::user()->companies()->first();
        $visits = CompanyVisit::where('company_id', $company->id)
            ->with('applicant')
            ->latest()
            ->get();

        return view('company.visits', compact('visits'));
    }
}
