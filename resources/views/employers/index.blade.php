<x-layout>
    <div class="space-y-10">

        <section class="text-center pt-4">
            <h1 class="font-bold text-4xl">{{ __('messages.jobs.title') }}</h1>
            
            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Web Developer..." />
            </x-forms.form>
        </section>

        <section class="pt-10">
            <x-section-heading>{{ __('messages.jobs.employers_title') }}</x-section-heading>
    
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach ($employers as $employer)
                    <x-employer-card :$employer />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>