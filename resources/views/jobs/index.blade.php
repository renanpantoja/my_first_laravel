<x-layout>
    <div class="space-y-10">

        <section class="text-center pt-4">
            <h1 class="font-bold text-4xl">{{ __('messages.jobs.title') }}</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="{{ __('messages.jobs.search_placeholder') }}" />
            </x-forms.form>
        </section>

        <section class="pt-10">
            <x-section-heading>{{ __('messages.jobs.featured_jobs') }}</x-section-heading>

            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @forelse ($featuredJobs as $job)
                    <x-job-card :$job />
                @empty
                    <p class="col-span-full text-gray-500">{{ __('messages.jobs.no_featured_jobs') }}</p>
                @endforelse
            </div>
        </section>

        <section>
            <x-section-heading>{{ __('messages.jobs.tags') }}</x-section-heading>

            <div class="mt-6 space-x-1">
                @foreach ($tags as $tag)
                    <x-tag :$tag />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>{{ __('messages.jobs.recent_jobs') }}</x-section-heading>

            <div class="mt-6 space-y-6">
                @forelse ($jobs as $job)
                    <x-job-card-wide :$job />
                @empty
                    <p class="text-gray-500">{{ __('messages.jobs.no_recent_jobs') }}</p>
                @endforelse
            </div>

            {{-- Paginação --}}
            <div class="mt-10">
                {{ $jobs->links() }}
            </div>
        </section>
    </div>
</x-layout>
