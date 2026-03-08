<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\CompanyVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function visits(Request $request)
    {
        $company = Auth::user()->companies()->first();
        
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $visits = CompanyVisit::where('company_id', $company->id)
            ->with('applicant')
            ->latest()
            ->get();

        return response()->json($visits);
    }

    public function addVisit(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        $company = Auth::user()->companies()->first();
        
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $applicant = Applicant::where('qr_code', $request->qr_code)->first();

        if (!$applicant) {
            return response()->json(['error' => 'Applicant not found'], 404);
        }

        $visit = CompanyVisit::create([
            'company_id' => $company->id,
            'applicant_id' => $applicant->id,
            'visited_at' => now(),
            'status' => 'viewed'
        ]);

        return response()->json([
            'message' => 'Visit recorded',
            'visit' => $visit
        ]);
    }
}
