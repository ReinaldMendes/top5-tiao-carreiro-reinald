<?php

namespace App\Services;

use App\Models\Sugestao;
use App\Models\Musica;

class SugestaoService
{
    /**
     * Cria uma sugestão a partir de um YouTube ID ou URL.
     * Para testes, pode-se passar direto o youtube_id.
     */
    public function createSugestao(string $urlOrId): Sugestao
    {
        // Para teste: se for só ID
        $videoId = strlen($urlOrId) === 11 ? $urlOrId : $this->extractVideoId($urlOrId);

        if (!$videoId) {
            throw new \Exception('URL do YouTube inválida.');
        }

        // Para testes não chamar API, usamos dados falsos
        $videoInfo = [
            'titulo' => "Título de teste para $videoId",
            'youtube_id' => $videoId,
            'thumb' => "https://via.placeholder.com/640x480.png/000000?text=$videoId"
        ];

        return Sugestao::create([
            'titulo' => $videoInfo['titulo'],
            'youtube_id' => $videoInfo['youtube_id'],
            'thumb' => $videoInfo['thumb'],
            'status' => 'pendente'
        ]);
    }

    /**
     * Aprova uma sugestão e move para músicas
     */
    public function aprovarSugestao(int $id): Musica
    {
        $sugestao = Sugestao::findOrFail($id);

        if ($sugestao->status !== 'pendente') {
            throw new \Exception('Esta sugestão já foi processada.');
        }

        $musica = Musica::create([
            'titulo' => $sugestao->titulo,
            'visualizacoes' => 0,
            'youtube_id' => $sugestao->youtube_id,
            'thumb' => $sugestao->thumb
        ]);

        $sugestao->status = 'aprovada';
        $sugestao->save();

        return $musica;
    }

    /**
     * Rejeita uma sugestão
     */
    public function rejeitarSugestao(int $id): void
    {
        $sugestao = Sugestao::findOrFail($id);
        $sugestao->status = 'rejeitada';
        $sugestao->save();
    }

    /**
     * Retorna apenas sugestões pendentes
     */
    public function getSugestoes()
    {
        return Sugestao::where('status', 'pendente')->get();
    }

    /**
     * Extrai ID do YouTube
     */
    private function extractVideoId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
