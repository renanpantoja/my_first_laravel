<x-layout>
    <x-page-heading>Reset Password</x-page-heading>
  
    @if (session('status'))
      <div class="text-green-600">{{ session('status') }}</div>
    @endif
  
    <x-forms.form method="POST" action="{{ route('password.email') }}">
      @csrf
  
      <x-forms.input label="Email" name="email" type="email" :value="old('email')" required autofocus />
      
      <x-forms.button>Send Password Reset Link</x-forms.button>
    </x-forms.form>
  </x-layout>
  