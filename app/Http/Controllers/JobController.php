<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobDeleteRequest;
use App\Http\Requests\JobUpdateRequest;
use Illuminate\Http\RedirectResponse;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'featuredJobs' => $jobs[1],
            'jobs' => $jobs[0],
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['featured'] = $request->has('featured');
    
        $job = Auth::user()
            ->employer
            ->jobs()
            ->create(Arr::except($attributes, 'tags'));
    
        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag(trim($tag));
            }
        }
    
        return redirect('/');
    }

    public function salaries()
    {
        // Pega os salários únicos das vagas, ordenados (exemplo: crescente)
        $salaries = Job::select('salary')
            ->distinct()
            ->orderBy('salary')
            ->pluck('salary');

        return view('jobs.salaries', [
            'salaries' => $salaries
        ]);
    }

    public function jobsBySalary($salary)
    {
        $jobs = Job::where('salary', $salary)
                    ->with(['employer', 'tags'])
                    ->latest()
                    ->get();
    
        return view('results', [
            'jobs' => $jobs,
            'salary' => $salary,
        ]);
    }

    public function myJobs()
    {
        $employer = auth()->user()->employer;

        if (!$employer) {
            abort(403, 'Você não está associado a uma empresa.');
        }

        $jobs = $employer->jobs()->with(['employer', 'tags'])->get();

        return view('results', [
            'jobs' => $jobs,
            'employer' => $employer,
            'myJobs' => true, // sinaliza no blade que é do usuário logado
        ]);
    }

    public function destroy(JobDeleteRequest $request, Job $job)
    {
        $job->delete();

        return redirect()->route('my-jobs')->with('success', 'Job deleted successfully.');
    }

    public function edit(Job $job)
    {
        if ($job->employer->user_id !== auth()->id()) {
            abort(403);
        }

        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(JobUpdateRequest $request, Job $job)
    {
        $attributes = $request->validated();
        $attributes['featured'] = $request->has('featured');
    
        // Remove 'tags' do array antes de atualizar o job
        $attributes = Arr::except($attributes, ['tags']);
    
        $job->update($attributes);
    
        if ($request->filled('tags')) {
            $job->tags()->detach();
    
            foreach (explode(',', $request->input('tags')) as $tag) {
                $job->tag(trim($tag));
            }
        }
    
        return redirect()->route('my-jobs')->with('success', 'Job updated successfully.');
    }
}
