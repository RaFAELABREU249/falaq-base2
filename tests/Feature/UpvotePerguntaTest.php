<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\Pergunta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpvotePerguntaTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_toggle_vote_on_question(): void
    {
        $user = User::factory()->create();
        $evento = Evento::create([
            'titulo' => 'Laravel em Ação',
            'descricao' => 'Evento de Laravel',
            'data_evento' => now(),
            'user_id' => $user->id,
        ]);
        $pergunta = Pergunta::create([
            'evento_id' => $evento->id,
            'user_id' => $user->id,
            'texto' => 'Como funciona o relacionamento N:M?',
            'status' => 'pendente',
            'is_public' => true,
        ]);

        $this->actingAs($user)
            ->post(route('perguntas.votar', $pergunta))
            ->assertRedirect();

        $this->assertDatabaseHas('pergunta_user', [
            'pergunta_id' => $pergunta->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->post(route('perguntas.votar', $pergunta))
            ->assertRedirect();

        $this->assertDatabaseMissing('pergunta_user', [
            'pergunta_id' => $pergunta->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_event_questions_are_ordered_by_votes_count_desc(): void
    {
        $user = User::factory()->create();
        $evento = Evento::create([
            'titulo' => 'Ranking',
            'descricao' => 'Evento de ranking',
            'data_evento' => now(),
            'user_id' => $user->id,
        ]);

        $perguntaComMaisVotos = Pergunta::create([
            'evento_id' => $evento->id,
            'user_id' => $user->id,
            'texto' => 'Pergunta mais votada',
            'status' => 'pendente',
            'is_public' => true,
        ]);
        $perguntaComMenosVotos = Pergunta::create([
            'evento_id' => $evento->id,
            'user_id' => $user->id,
            'texto' => 'Pergunta menos votada',
            'status' => 'pendente',
            'is_public' => true,
        ]);

        $voterA = User::factory()->create();
        $voterB = User::factory()->create();
        $voterC = User::factory()->create();

        $perguntaComMaisVotos->votos()->attach([$voterA->id, $voterB->id, $voterC->id]);
        $perguntaComMenosVotos->votos()->attach([$voterA->id]);

        $response = $this->get(route('eventos.show', $evento->id));

        $response->assertOk();
        $response->assertSeeTextInOrder([
            'Pergunta mais votada',
            'Pergunta menos votada',
        ]);
        $this->assertGreaterThan(
            $perguntaComMenosVotos->votos()->count(),
            $perguntaComMaisVotos->votos()->count()
        );
    }
}
