<x-layout>
    <x-page-heading>{{ __('messages.job.edit') }}</x-page-heading>

    <x-forms.form method="POST" action="{{ route('jobs.update', $job) }}">
        @csrf
        @method('PUT')

        <x-forms.input name="title" label="{{ __('messages.job.title') }}" placeholder="CEO" :value="old('title', $job->title)" />
        <x-forms.input name="salary" label="{{ __('messages.job.salary') }}" placeholder="$90,000" :value="old('salary', $job->salary)" />
        <x-forms.input name="location" label="{{ __('messages.job.location') }}" placeholder="Porto - Portugal" :value="old('location', $job->location)" />

        <x-forms.select name="schedule" label="{{ __('messages.job.type') }}">
            <option value="Full Time" {{ old('schedule', $job->schedule) === 'Full Time' ? 'selected' : '' }}>{{ __('messages.job.type.full') }}</option>
            <option value="Part Time" {{ old('schedule', $job->schedule) === 'Part Time' ? 'selected' : '' }}>{{ __('messages.job.type.part') }}</option>
        </x-forms.select>

        <x-forms.input name="url" label="{{ __('messages.job.url') }}" placeholder="https://acme.com/jobs/ceo-wanted" :value="old('url', $job->url)" />
        <x-forms.checkbox name="featured" label="{{ __('messages.job.featured') }}" :checked="old('featured', $job->featured)" />

        <div class="py-10 text-white/30">
            <hr />
        </div>

        <x-forms.input
            name="tags"
            label="{{ __('messages.job.tags') }}"
            placeholder="Backend, Frontend, PHP"
            :value="old('tags', $job->tags->pluck('name')->implode(','))"
        />

        <x-forms.button>{{ __('messages.job.button.update') }}</x-forms.button>
    </x-forms.form>
</x-layout>
