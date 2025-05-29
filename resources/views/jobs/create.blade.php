<x-layout>
    <x-page-heading>{{ __('messages.job.new') }}</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        @csrf
        <x-forms.input name="title" label="{{ __('messages.job.title') }}" placeholder="CEO" />
        <x-forms.input name="salary" label="{{ __('messages.job.salary') }}" placeholder="$90,000" />
        <x-forms.input name="location" label="{{ __('messages.job.location') }}" placeholder="Porto - Portugal" />

        <x-forms.select name="schedule" label="{{ __('messages.job.type') }}">
            <option>{{ __('messages.job.type.full') }}</option>
            <option>{{ __('messages.job.type.part') }}</option>
        </x-forms.select>

        <x-forms.input name="url" label="{{ __('messages.job.url') }}" placeholder="https://acme.com/jobs/ceo-wanted" />
        <x-forms.checkbox name="featured" label="{{ __('messages.job.featured') }}" />

        <div class="py-10 text-white/30">
            <hr />
        </div>

        <x-forms.input name="tags" label="{{ __('messages.job.tags') }}" placeholder="Backend, Frontend, PHP" />
        
        <x-forms.button>{{ __('messages.job.button.create') }}</x-forms.button>
    </x-forms.form>
</x-layout>
