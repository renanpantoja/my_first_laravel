@props(['employer', 'size' => 90])

{{-- <img src="https://picsum.photos/seed/{{ rand(0,1000000) }}/{{ $size }}" alt="" class="rounded-xl"> --}}
@if (substr_count($employer->logo, 'logos/'))
    <img src="{{ asset('storage/' . $employer->logo) }}" alt="" class="rounded-xl" width="{{ $size }}">
@else
    {{-- <img src="{{ $employer->logo }}" alt="" class="rounded-xl" width="{{ $size }}"> --}}
    <img src="https://picsum.photos/seed/{{ rand(0,1000000) }}/{{ $size }}" alt="" class="rounded-xl" width="{{ $size }}">
@endif
