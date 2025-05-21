<x-layout>
    <x-page-heading>New Job</x-page-headding>

    <x-forms.form method="POST" action="/jobs">
        @csrf
        <x-forms.input name="title" label="Job Title" placeholder="CEO" />
        <x-forms.input name="salary" label="Salary" placeholder="$90,000" />
        <x-forms.input name="location" label="Location" placeholder="Porto - Portugal" />

        <x-forms.select name="schedule" label="Job Type">
            <option>Full Time</option>
            <option>Part Time</option>
        </x-forms.select>

        <x-forms.input name="url" label="URL" placeholder="https://acme.com/jobs/ceo-wanted" />
        <x-forms.checkbox name="featured" label="Feature (Cost Extra)" />

        <div class="py-10 text-white/30">
            <hr />
          </div>

        <x-forms.input name="tags" label="Tags (Comma separated)" placeholder="Backend, Frontend, PHP" />
        
        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>