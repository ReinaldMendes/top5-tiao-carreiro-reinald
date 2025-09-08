<?php

namespace Tests\Feature;

use App\Models\Musica;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MusicaApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_musicas()
    {
        Musica::factory()->count(10)->create();

        $response = $this->getJson('/api/musicas');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data', // ou como seu service retorna
            ]);
    }

    /** @test */
    public function it_returns_top5_musicas()
    {
        Musica::factory()->count(10)->create();

        $response = $this->getJson('/api/musicas/top5');

        $response->assertStatus(200)
            ->assertJsonCount(5); // top5
    }
}
