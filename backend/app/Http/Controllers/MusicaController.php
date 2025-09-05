<?php

namespace App\Http\Controllers;

use App\Services\MusicaService;
use Illuminate\Http\Request;

class MusicaController extends Controller
{
    protected $musicaService;

    public function __construct(MusicaService $musicaService)
    {
        $this->musicaService = $musicaService;
    }

    /**
     * Retorna a lista de músicas paginada (a partir da 6ª).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $musicas = $this->musicaService->getAllPaginated();
        return response()->json($musicas);
    }

    /**
     * Retorna as 5 músicas mais tocadas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function top5()
    {
        $musicas = $this->musicaService->getTop5();
        return response()->json($musicas);
    }

    // TODO: Adicionar métodos para CRUD (create, update, delete)
}
