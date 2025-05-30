<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">{{ __('messages.jobs.salaries_title') }}</h1>

        @if($salaries->isEmpty())
            <p class="text-gray-600">{{ __('messages.jobs.salaries_no_salaries') }}</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($salaries as $salary)
                    <a href="{{ route('jobs.bySalary', ['salary' => $salary]) }}" class="block bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                        <p class="text-xl font-semibold text-gray-800">
                            {{ $salary }}
                        </p>
                        <p class="text-gray-500 mt-2">{{ __('messages.jobs.salaries_vacancies_list') }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
