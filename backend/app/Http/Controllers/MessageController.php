<?php

namespace App\Http\Controllers;

use App\Events\NewMessageCreated;
use App\Http\Requests\MsgCreateRequest;
use App\Http\Resources\AllMsgsResource;
use App\Http\Resources\getMessageResource;
use App\Repository\MessageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    private $repositoryMessage;

    public function __construct(MessageRepository $MessageRepository)
    {
        $this->repositoryMessage = $MessageRepository;
    }

    public function index($idGuild, $idChannel)
    {
        $msg = $this->repositoryMessage->AllMsg($idGuild, $idChannel);
        if (!$msg) {
            return response()->json(['status' => 'success', 'message' => 'Sem Mensagens']);
        }

        $msg = AllMsgsResource::collection($msg);

        return response()->json(['status' => 'success', 'messages' => $msg]);
    }


    public function store(MsgCreateRequest $request)
    {
        $msg = $this->repositoryMessage->createMSG($request);
        if (!$msg) {
            return response()->json(['status' => 'error', 'message' => 'Error ao enviar mensagem']);
        }
        $msg->NOME = $request->user()->name;
        $msg = new getMessageResource($msg);

        //NewMessageCreated::dispatch($msg);
        //broadcast(new NewMessageCreated($msg))->toOthers();
        Broadcast::on('chatroom')
            ->as('ChatMessage')
            ->with($msg->toArray(null))
            ->send();

        return response()->json(['status' => 'success', 'message' => 'Mensagem enviada com sucesso', 'dados' => $msg]);
    }

    public function getMessage($idMsg)
    {
        $msg = $this->repositoryMessage->getMessage($idMsg);
        return new getMessageResource($msg);
    }
}
