<x-layout>
  <x-page-heading>{{ __('messages.login.title') }}</x-page-heading>

  <x-forms.form method="POST" action="/login">
    <x-forms.input label="{{ __('messages.login.email') }}" name="email" type="email" />
    <x-forms.input label="{{ __('messages.login.password') }}" name="password" type="password" />
    
    <x-forms.button>{{ __('messages.login.button') }}</x-forms.button>
    <x-forms.link href="{{ route('password.request') }}">{{ __('messages.login.forgot') }}</x-forms.link>
  </x-forms.form>
</x-layout>
