<?php

namespace Tests\Feature;

use App\Models\Sugestao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SugestaoApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar um usuário para autenticação
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_returns_all_pending_sugestoes()
    {
        // Criar sugestões pendentes
        Sugestao::factory()->count(3)->create(['status' => 'pendente']);
        Sugestao::factory()->count(2)->create(['status' => 'aprovada']);

        $response = $this->actingAs($this->user)
            ->getJson('/api/sugestoes');

        $response->assertStatus(200)
            ->assertJsonCount(3); // Apenas as pendentes
    }

    /** @test */
    public function it_can_store_a_new_sugestao()
    {
        $payload = [
            'url' => 'https://www.youtube.com/watch?v=abcdef12345'
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/sugestoes', $payload);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Sugestão recebida com sucesso!']);

        $this->assertDatabaseHas('sugestoes', [
            'youtube_id' => 'abcdef12345'
        ]);
    }

    /** @test */
    public function it_can_approve_a_sugestao()
    {
        $sugestao = Sugestao::factory()->create(['status' => 'pendente']);

        $response = $this->actingAs($this->user)
            ->putJson("/api/sugestoes/{$sugestao->id}/aprovar");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Sugestão aprovada e adicionada às músicas.']);

        $this->assertDatabaseHas('sugestoes', [
            'id' => $sugestao->id,
            'status' => 'aprovada'
        ]);
    }

    /** @test */
    public function it_can_rejeitar_a_sugestao()
    {
        $sugestao = Sugestao::factory()->create(['status' => 'pendente']);

        $response = $this->actingAs($this->user)
            ->putJson("/api/sugestoes/{$sugestao->id}/rejeitar");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Sugestão rejeitada.']);

        $this->assertDatabaseHas('sugestoes', [
            'id' => $sugestao->id,
            'status' => 'rejeitada'
        ]);
    }
}
