@props(['label', 'name'])

<div>
    @if ($label)
        <x-forms.label :label="$label" :name="$name" />
    @endif

    <div class="mt-1">
        {{ $slot }}

        <x-forms.error :error="$name" />
    </div>
</div>