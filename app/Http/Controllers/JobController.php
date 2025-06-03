<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobDeleteRequest;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JobController extends Controller
{
    public function index(): View
    {
        $featuredJobs = Job::where('featured', true)
            ->latest()
            ->with(['employer', 'tags'])
            ->get();

        $jobs = Job::where('featured', false)
            ->latest()
            ->with(['employer', 'tags'])
            ->paginate(5);

        return view('jobs.index', [
            'featuredJobs' => $featuredJobs,
            'jobs' => $jobs,
            'tags' => Tag::all(),
        ]);
    }

    public function create(): View
    {
        return view('jobs.create');
    }

    public function store(JobStoreRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()
            ->employer
            ->jobs()
            ->create(Arr::except($attributes, 'tags'));

        if (!empty($attributes['tags'])) {
            $tags = explode(',', $attributes['tags']);
            foreach ($tags as $tagName) {
                $tagName = trim($tagName);
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                /** @var \App\Models\Job $job */
                $job->tags()->attach($tag->id);
            }
        }

        return redirect('/');
    }

    public function salaries(): View
    {
        $salaries = Job::select('salary')
            ->distinct()
            ->orderBy('salary')
            ->pluck('salary');

        return view('jobs.salaries', [
            'salaries' => $salaries,
        ]);
    }

    public function jobsBySalary(int|string $salary): View
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

    public function myJobs(): View
    {
        /** @var \App\Models\Employer|null $employer */
        $employer = optional(auth()->user())->employer;
    
        if ($employer === null) {
            abort(403, 'Você não está associado a uma empresa.');
        }
    
        $jobs = $employer->jobs()->with(['employer', 'tags'])->get();
    
        return view('results', [
            'jobs' => $jobs,
            'employer' => $employer,
            'myJobs' => true,
        ]);
    }    

    public function destroy(JobDeleteRequest $request, Job $job): RedirectResponse
    {
        $job->delete();

        return redirect()->route('my-jobs')->with('success', 'Job deleted successfully.');
    }

    public function edit(Job $job): View
    {
        /** @var \App\Models\Employer|null $employer */
        $employer = $job->employer;

        if (! $employer || $employer->user_id !== auth()->id()) {
            abort(403);
        }

        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(JobUpdateRequest $request, Job $job): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['featured'] = $request->has('featured');

        $attributes = Arr::except($attributes, ['tags']);

        $job->update($attributes);

        if ($request->filled('tags')) {
            $job->tags()->detach();

            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tagName) {
                $tagName = trim($tagName);
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $job->tags()->attach($tag->id);
            }
        }

        return redirect()->route('my-jobs')->with('success', 'Job updated successfully.');
    }
}
