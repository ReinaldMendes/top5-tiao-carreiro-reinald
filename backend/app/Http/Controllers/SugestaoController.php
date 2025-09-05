<?php

namespace App\Http\Controllers;

use App\Services\SugestaoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SugestaoController extends Controller
{
    protected $sugestaoService;

    public function __construct(SugestaoService $sugestaoService)
    {
        $this->sugestaoService = $sugestaoService;
    }

    /**
     * Retorna todas as sugestões pendentes.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $sugestoes = $this->sugestaoService->getSugestoes();
        return response()->json($sugestoes);
    }

    /**
     * Salva uma nova sugestão de música.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate(['url' => 'required|url']);
        try {
            $this->sugestaoService->createSugestao($request->input('url'));
            return response()->json(['message' => 'Sugestão recebida com sucesso!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Aprova uma sugestão.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function aprovar(int $id): JsonResponse
    {
        try {
            $this->sugestaoService->aprovarSugestao($id);
            return response()->json(['message' => 'Sugestão aprovada e adicionada às músicas.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Rejeita uma sugestão.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function rejeitar(int $id): JsonResponse
    {
        try {
            $this->sugestaoService->rejeitarSugestao($id);
            return response()->json(['message' => 'Sugestão rejeitada.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
