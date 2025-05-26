<x-layout>
  <x-page-heading>Log In</x-page-heading>

  <x-forms.form method="POST" action="/login">
    <x-forms.input label="Email" name="email" type="email" />
    <x-forms.input label="Password" name="password" type="password" />
    
    <x-forms.button>Log In</x-forms.button>
    <x-forms.link href="{{ route('password.request') }}">Forgot Password?</x-forms.link>
  </x-forms.form>
</x-layout>
