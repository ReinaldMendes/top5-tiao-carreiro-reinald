<?php

namespace App\Services;

use App\Models\Sugestao;
use Illuminate\Support\Facades\Http;
use App\Models\Musica;

class SugestaoService
{
    private const YOUTUBE_API_KEY = 'SUA_CHAVE_DE_API_DO_YOUTUBE';

    /**
     * Valida uma URL do YouTube e salva uma sugestão.
     *
     * @param string $url
     * @return Sugestao
     * @throws \Exception
     */
    public function createSugestao(string $url): Sugestao
    {
        $videoId = $this->extractVideoId($url);
        if (!$videoId) {
            throw new \Exception('URL do YouTube inválida.');
        }

        $videoInfo = $this->getVideoInfo($videoId);

        return Sugestao::create([
            'titulo' => $videoInfo['titulo'],
            'youtube_id' => $videoInfo['youtube_id'],
            'thumb' => $videoInfo['thumb'],
            'status' => 'pendente'
        ]);
    }

    /**
     * Aprova uma sugestão e a move para a tabela de músicas.
     *
     * @param int $id
     * @return Musica
     * @throws \Exception
     */
    public function aprovarSugestao(int $id): Musica
    {
        $sugestao = Sugestao::findOrFail($id);

        if ($sugestao->status !== 'pendente') {
            throw new \Exception('Esta sugestão já foi processada.');
        }

        // Cria a música a partir da sugestão
        $musica = Musica::create([
            'titulo' => $sugestao->titulo,
            'visualizacoes' => 0, // A API do YouTube não retorna visualizações facilmente, então definimos como 0
            'youtube_id' => $sugestao->youtube_id,
            'thumb' => $sugestao->thumb
        ]);

        $sugestao->status = 'aprovada';
        $sugestao->save();

        return $musica;
    }

    /**
     * Rejeita uma sugestão.
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function rejeitarSugestao(int $id): void
    {
        $sugestao = Sugestao::findOrFail($id);
        $sugestao->status = 'rejeitada';
        $sugestao->save();
    }

    /**
     * Retorna todas as sugestões.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSugestoes()
    {
        return Sugestao::all();
    }

    /**
     * Extrai o ID do vídeo de uma URL do YouTube.
     *
     * @param string $url
     * @return string|null
     */
    private function extractVideoId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Busca informações do vídeo na API do YouTube.
     *
     * @param string $videoId
     * @return array
     * @throws \Exception
     */
    private function getVideoInfo(string $videoId): array
    {
        $response = Http::get("https://www.googleapis.com/youtube/v3/videos", [
            'key' => self::YOUTUBE_API_KEY,
            'id' => $videoId,
            'part' => 'snippet'
        ]);

        $data = $response->json();

        if ($response->failed() || empty($data['items'])) {
            throw new \Exception('Não foi possível obter informações do vídeo na API do YouTube.');
        }

        $snippet = $data['items'][0]['snippet'];

        return [
            'titulo' => $snippet['title'],
            'youtube_id' => $videoId,
            'thumb' => $snippet['thumbnails']['high']['url']
        ];
    }
}
