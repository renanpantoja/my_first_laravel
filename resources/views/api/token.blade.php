<x-layout>
    <x-page-heading>Minha Conta - Token de API</x-page-heading>

    @if(session('token'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <strong>Token gerado com sucesso!</strong><br>
            <span class="break-words text-sm">{{ session('token') }}</span>
        </div>
    @endif

    <div class="bg-white text-black shadow-md rounded p-6 space-y-4">
        <h2 class="text-lg font-semibold">Informações do Usuário</h2>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <form action="{{ route('api.token.generate') }}" method="POST">
            @csrf
            <x-forms.button type="submit" class="mt-10">Gerar novo Token</x-forms.button>
        </form>
    </div>
</x-layout>
