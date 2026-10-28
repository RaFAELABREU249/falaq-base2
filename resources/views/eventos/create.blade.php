@extends('layouts.app')

@section('title', 'Criar Evento — FalaQ')

@section('content')
<section class="mx-auto max-w-2xl rounded-lg border border-gray-700 bg-gray-900 p-6 shadow-md sm:p-8">
    <h1 class="mb-2 text-2xl font-bold text-white">Criar evento</h1>
    <p class="mb-6 text-sm text-gray-400">Preencha os dados do evento.</p>

    <form action="{{ route('eventos.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="titulo" class="mb-2 block text-sm font-medium text-gray-200">Título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                value="{{ old('titulo') }}"
                required
                aria-invalid="@error('titulo') true @else false @enderror"
                class="block w-full rounded-md border bg-gray-800 px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('titulo') border-red-500 @else border-gray-600 @enderror"
                placeholder="Ex.: Encontro da comunidade">
            @error('titulo')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descricao" class="mb-2 block text-sm font-medium text-gray-200">Descrição</label>
            <textarea
                name="descricao"
                id="descricao"
                rows="5"
                aria-invalid="@error('descricao') true @else false @enderror"
                class="block w-full rounded-md border bg-gray-800 px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('descricao') border-red-500 @else border-gray-600 @enderror"
                placeholder="Conte um pouco sobre o evento">{{ old('descricao') }}</textarea>
            @error('descricao')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="data_evento" class="mb-2 block text-sm font-medium text-gray-200">Data do evento</label>
            <input
                type="date"
                name="data_evento"
                id="data_evento"
                value="{{ old('data_evento') }}"
                aria-invalid="@error('data_evento') true @else false @enderror"
                class="block w-full rounded-md border bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('data_evento') border-red-500 @else border-gray-600 @enderror">
            @error('data_evento')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 font-semibold text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-gray-900">
            Criar evento
        </button>
    </form>
</section>
@endsection