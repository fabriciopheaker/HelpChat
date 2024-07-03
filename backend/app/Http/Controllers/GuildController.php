<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuildCreateRequest;
use App\Repository\GuildRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuildController extends Controller
{

    private $repositoryGuild;

    public function __construct(GuildRepository $guildsRepository)
    {
        $this->repositoryGuild = $guildsRepository;
    }

    public function index(): JsonResponse
    {
        $dados = $this->repositoryGuild->allGuilds();
        if (!$dados) {
            return response()->json(['status' => 'success', 'message' => 'Sem Servidores Cadastrados']);
        }
        return response()->json(['status' => 'success', 'guilds' => $dados]);
    }

    public function store(GuildCreateRequest $request): JsonResponse
    {
        $servidor = $this->repositoryGuild->createGuild($request);
        if (!$servidor) {
            return response()->json(['status' => 'error', 'message' => 'Error ao Cadastrar Servidor']);
        }
        return response()->json(['status' => 'success', 'message' => 'Servidor Cadastrado com Sucesso', 'ID_GUILD' => $servidor]);
    }

    public function destroy($id): JsonResponse
    {
        $servidor = $this->repositoryGuild->deleteGuild($id);
        if (!$servidor) {
            return response()->json(['status' => 'success', 'message' => 'Error ao Deletar Servidor']);
        }
        return response()->json(['status' => 'success', 'message' => 'Servidor Deletado com Sucesso']);
    }


    public function show($id): JsonResponse
    {
        $servidor = $this->repositoryGuild->showGuild($id);
        if (!$servidor) {
            return response()->json(['status' => 'error', 'message' => 'Error Ao Encontrar Servidor']);
        }
        return response()->json(['status' => 'success', 'guilds' => $servidor]);
    }
}
