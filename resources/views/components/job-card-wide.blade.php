@props(['job'])

<x-panel class="flex gap-x-6 items-start">
    <div>
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="{{ route('employers.jobs', $job->employer) }}" class="self-start text-sm text-gray-400">
            {{ $job->employer->name }}
        </a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-600 transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto">
            {{ $job->salary }}
        </p>
    </div>

    <div class="flex flex-col items-end gap-2">
        @foreach ($job->tags as $tag)
            <x-tag :$tag />
        @endforeach

        @if(auth()->check() && optional($job->employer)->user_id === auth()->id())
            <div class="flex items-center gap-2 mt-2 ml-4">
                <a href="{{ route('jobs.edit', $job) }}" 
                class="p-2 rounded hover:bg-gray-200 transition" title="Editar">
                    <!-- Ícone lápis só -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 hover:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M16 7l-8 8v3h3l8-8-3-3z" />
                    </svg>
                </a>

                <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="p-2 rounded hover:bg-gray-200 transition" title="Deletar">
                        <!-- Ícone lixeira só -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 hover:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7L5 7M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12M10 11v6M14 11v6M9 7V4h6v3" />
                        </svg>
                    </button>
                </form>
            </div>
        @endif

    </div>
</x-panel>
