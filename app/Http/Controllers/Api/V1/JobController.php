<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function index(Request $request): JsonResponse
    {
        $query = Job::with(['employer', 'tags']);
    
        if ($request->has('tags')) {
            $tagNames = explode(',', $request->input('tags'));
            $query->whereHas('tags', function ($q) use ($tagNames) {
                $q->whereIn('name', $tagNames);
            });
        }
    
        if ($request->has('salary_min')) {
            $salaryMin = (int) preg_replace('/[^\d]/', '', $request->input('salary_min'));
            $query->whereRaw("CAST(REPLACE(REPLACE(salary, '$', ''), ',', '') AS UNSIGNED) >= ?", [$salaryMin]);
        }
    
        if ($request->has('salary_max')) {
            $salaryMax = (int) preg_replace('/[^\d]/', '', $request->input('salary_max'));
            $query->whereRaw("CAST(REPLACE(REPLACE(salary, '$', ''), ',', '') AS UNSIGNED) <= ?", [$salaryMax]);
        }
    
        if ($request->has('location')) {
            $query->where('location', $request->input('location'));
        }
    
        if ($request->has('featured')) {
            $query->where('featured', $request->input('featured'));
        }
    
        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }
    
        if ($request->has('employer')) {
            $query->whereHas('employer', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->input('employer') . '%');
            });
        }
    
        $perPage = $request->input('per_page', 15);
        $jobsPaginated = $query->paginate($perPage);
    
        return response()->json([
            'total' => $jobsPaginated->total(),
            'per_page' => $jobsPaginated->perPage(),
            'current_page' => $jobsPaginated->currentPage(),
            'last_page' => $jobsPaginated->lastPage(),
            'data' => $jobsPaginated->items(),
        ]);
    }     
}