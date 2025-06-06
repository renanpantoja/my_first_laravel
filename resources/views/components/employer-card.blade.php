@props(['employer'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $employer->user->name }}</div>
    <div class="py-8">
        <h3 class="group-hover:text-blue-600 text-xl font-bold transition-colors duration-300">
            <a href="{{ route('employers.jobs', $employer->slug) }}" >
                {{ $employer->name }}
            </a>
        </h3>
    </div>
</x-panel>