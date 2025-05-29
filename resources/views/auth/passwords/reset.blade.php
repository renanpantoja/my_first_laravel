<x-layout>
  <x-page-heading>{{ __('messages.reset_form.title') }}</x-page-heading>

  <x-forms.form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}" />

    <x-forms.input label="{{ __('messages.reset_form.email') }}" name="email" type="email" :value="$email" required autofocus />
    <x-forms.input label="{{ __('messages.reset_form.password') }}" name="password" type="password" required />
    <x-forms.input label="{{ __('messages.reset_form.password_confirmation') }}" name="password_confirmation" type="password" required />
    <x-forms.button>{{ __('messages.reset_form.button') }}</x-forms.button>
  </x-forms.form>
</x-layout>
