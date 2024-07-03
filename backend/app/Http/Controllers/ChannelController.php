<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChannelRequest;
use App\Repository\ChannelRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{

    private $repositoryChannel;

    public function __construct(ChannelRepository $Channelrepository)
    {
        $this->repositoryChannel = $Channelrepository;
    }

    public function index($idGuild): JsonResponse
    {
        $channel = $this->repositoryChannel->getGuildChannel($idGuild);
        if (!$channel) {
            return response()->json(['status' => 'success', 'message' => 'Sem Canais Cadastrados']);
        }
        return response()->json(['status' => 'success', 'channels' => $channel]);
    }

    public function store(CreateChannelRequest $request): JsonResponse
    {
        $channel = $this->repositoryChannel->createChannel($request);
        if (!$channel) {
            return response()->json(['status' => 'error', 'message' => 'Error ao Cadastrar Channel']);
        }
        return response()->json(['status' => 'success', 'message' => 'Canal Cadastrado com Sucesso', 'ID_CHANNEL' => $channel]);
    }

    public function show($idGuild, $idChannel): JsonResponse
    {
        Log::info($idChannel);
        $servidor = $this->repositoryChannel->showChannel($idChannel);
        if (!$servidor) {
            return response()->json(['status' => 'error', 'message' => 'Error Ao Encontrar Channel']);
        }
        return response()->json(['status' => 'success', 'channel' => $servidor]);
    }
}
