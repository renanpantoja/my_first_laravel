<x-layout>
    <x-page-heading>
        @if (isset($myJobs))
            My Company Jobs
        @elseif (isset($employer))
            Jobs at {{ $employer->name }}
        @elseif (isset($salary))
            Jobs with salary: {{ $salary }}
        @else
            Results
        @endif
    </x-page-heading>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (request('q'))
        <p class="text-center text-gray-600 mb-6">
            You searched for: <span class="font-semibold">"{{ request('q') }}"</span>
        </p>
    @endif

    <div class="space-y-6">
        @forelse ($jobs as $job)
            <x-job-card-wide :$job />
        @empty
            <p class="text-center text-gray-500">No jobs found matching your criteria.</p>
        @endforelse
    </div>
</x-layout>
