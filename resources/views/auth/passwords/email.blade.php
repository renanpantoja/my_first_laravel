<x-layout>
  <x-page-heading>{{ __('messages.reset_request.title') }}</x-page-heading>

  @if (session('status'))
    <div class="text-green-600">{{ session('status') }}</div>
  @endif

  <x-forms.form method="POST" action="{{ route('password.email') }}">
    @csrf
    <x-forms.input label="{{ __('messages.login.email') }}" name="email" type="email" :value="old('email')" required autofocus />
    <x-forms.button>{{ __('messages.reset_request.button') }}</x-forms.button>
  </x-forms.form>
</x-layout>
