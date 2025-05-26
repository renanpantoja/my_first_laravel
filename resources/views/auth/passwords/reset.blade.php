<x-layout>
    <x-page-heading>Reset Password</x-page-heading>
  
    <x-forms.form method="POST" action="{{ route('password.update') }}">
      @csrf
  
      <input type="hidden" name="token" value="{{ $token }}" />
  
      <x-forms.input label="Email" name="email" type="email" :value="$email" required autofocus />
  
      <x-forms.input label="Password" name="password" type="password" required />
  
      <x-forms.input label="Confirm Password" name="password_confirmation" type="password" required />
  
      <x-forms.button>Reset Password</x-forms.button>
    </x-forms.form>
  </x-layout>
  