<?php

namespace App\Policies;

use App\Models\Pergunta;
use App\Models\User;

class PerguntaPolicy
{
    public function delete(User $user, Pergunta $pergunta): bool
    {
        $organizadorId = $pergunta->evento?->user_id;

        return (int) $user->getKey() === (int) $pergunta->user_id
            || ($organizadorId !== null && (int) $user->getKey() === (int) $organizadorId);
    }
}