<?php

namespace App\Services;

use App\Models\Musica;

class MusicaService
{
    /**
     * Retorna as 5 músicas mais tocadas.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTop5()
    {
        return Musica::orderByDesc('visualizacoes')->take(5)->get();
    }

    /**
     * Retorna a lista completa de músicas com paginação.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage = 15)
    {
        return Musica::orderByDesc('visualizacoes')->paginate($perPage);
    }
}
