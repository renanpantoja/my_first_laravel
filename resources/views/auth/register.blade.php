<x-layout>
  <x-page-heading>{{ __('messages.register.title') }}</x-page-heading>

  <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
    <x-forms.input label="{{ __('messages.register.name') }}" name="name" />
    <x-forms.input label="{{ __('messages.register.email') }}" name="email" type="email" />
    <x-forms.input label="{{ __('messages.register.password') }}" name="password" type="password" />
    <x-forms.input label="{{ __('messages.register.password_confirmation') }}" name="password_confirmation" type="password" />

    <div class="py-10 text-white/30">
      <hr />
    </div>

    <x-forms.input label="{{ __('messages.register.employer_name') }}" name="employer" />
    <x-forms.input label="{{ __('messages.register.employer_logo') }}" name="logo" type="file" />
    
    <x-forms.button>{{ __('messages.register.button') }}</x-forms.button>
  </x-forms.form>
</x-layout>
