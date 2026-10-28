@extends('layouts.app')

@section('title', 'Moderações do Evento')

@section('content')
<div class="card shadow-sm p-3">
    <h4 class="fw-bold mb-3">🛡️ Fila de Moderação</h4>

    @forelse($moderacoes as $moderacao)
        <div class="border rounded p-3 mb-3">
            <p class="mb-1"><strong>Pergunta:</strong> {{ $moderacao->pergunta->texto }}</p>
            <p class="mb-2"><strong>Motivo:</strong> {{ $moderacao->motivo }}</p>
            <p class="mb-2"><strong>Status:</strong> {{ $moderacao->status }}</p>

            <form action="{{ route('moderacoes.status.update', $moderacao) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="d-flex gap-2">
                    <button type="submit" name="status" value="aprovada" class="btn btn-success btn-sm">Aprovar</button>
                    <button type="submit" name="status" value="rejeitada" class="btn btn-danger btn-sm">Rejeitar</button>
                </div>
            </form>
        </div>
    @empty
        <div class="alert alert-dark">Nenhuma moderação pendente.</div>
    @endforelse

    @if(method_exists($moderacoes, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $moderacoes->links() }}
        </div>
    @endif
</div>
@endsection
