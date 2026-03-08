<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Company;
use App\Models\Event;
use App\Models\CompanyVisit;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'total_events' => Event::count(),
            'active_events' => Event::where('status', 'active')->count(),
            'total_companies' => Company::count(),
            'total_applicants' => Applicant::count(),
        ];

        $recentApplicants = Applicant::with('event', 'timeSlot')->latest()->take(10)->get();
        $events = Event::with('companies', 'applicants')->latest()->take(5)->get();

        return view('dashboard.admin', compact('stats', 'recentApplicants', 'events'));
    }

    public function company()
    {
        $company = Auth::user()->companies()->first();
        
        if (!$company) {
            return redirect()->route('companies.create');
        }

        $stats = [
            'total_visits' => CompanyVisit::where('company_id', $company->id)->count(),
            'shortlisted' => CompanyVisit::where('company_id', $company->id)->where('status', 'shortlisted')->count(),
            'rejected' => CompanyVisit::where('company_id', $company->id)->where('status', 'rejected')->count(),
        ];

        $visits = CompanyVisit::where('company_id', $company->id)
            ->with('applicant')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.company', compact('company', 'stats', 'visits'));
    }

    public function index()
    {
        $events = Event::where('status', 'active')->with('companies')->get();
        return view('welcome', compact('events'));
    }
}
