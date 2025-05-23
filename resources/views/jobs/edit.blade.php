<x-layout>
    <x-page-heading>Edit Job</x-page-heading>

    <x-forms.form method="POST" action="{{ route('jobs.update', $job) }}">
        @csrf
        @method('PUT')

        <x-forms.input name="title" label="Job Title" placeholder="CEO" :value="old('title', $job->title)" />
        <x-forms.input name="salary" label="Salary" placeholder="$90,000" :value="old('salary', $job->salary)" />
        <x-forms.input name="location" label="Location" placeholder="Porto - Portugal" :value="old('location', $job->location)" />

        <x-forms.select name="schedule" label="Job Type">
            <option value="Full Time" {{ old('schedule', $job->schedule) === 'Full Time' ? 'selected' : '' }}>Full Time</option>
            <option value="Part Time" {{ old('schedule', $job->schedule) === 'Part Time' ? 'selected' : '' }}>Part Time</option>
        </x-forms.select>

        <x-forms.input name="url" label="URL" placeholder="https://acme.com/jobs/ceo-wanted" :value="old('url', $job->url)" />
        <x-forms.checkbox name="featured" label="Feature (Cost Extra)" :checked="old('featured', $job->featured)" />

        <div class="py-10 text-white/30">
            <hr />
        </div>

        <x-forms.input
            name="tags"
            label="Tags (Comma separated)"
            placeholder="Backend, Frontend, PHP"
            :value="old('tags', $job->tags->pluck('name')->implode(','))"
        />

        <x-forms.button>Update</x-forms.button>
    </x-forms.form>
</x-layout>
