<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\View\View;

class EmployerController extends Controller
{
    public function index(): View
    {
        $employers = Employer::withCount('jobs')->latest()->get();

        return view('employers.index', [
            'employers' => $employers,
        ]);
    }

    public function jobs(Employer $employer): View
    {
        $jobs = $employer->jobs()->with(['employer', 'tags'])->latest()->get();

        return view('results', [
            'jobs' => $jobs,
            'employer' => $employer,
        ]);
    }
}
