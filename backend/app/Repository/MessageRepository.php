<?php

namespace App\Repository;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MessageRepository
{

  public function AllMsg($idGuild, $idChannel): Collection|bool
  {
    $msgs = Message::leftJoin('users', 'users.id', '=', 'messages.ID_USER')
      ->select('messages.*', 'users.name as NOME')
      ->where([
        ['ID_GUILD', $idGuild],
        ['ID_CHANNEL', $idChannel]
      ])->get();
    return $msgs->isNotEmpty() ? $msgs : false;
  }

  public function createMSG($param)
  {
    $chat = Message::create([
      'MSG' => $param->MSG,
      'ID_GUILD' => $param->ID_GUILD,
      'ID_CHANNEL' => $param->ID_CHANNEL,
      'ID_USER' => $param->user()->id
    ]);

    return $chat ? $chat : false;
  }

  public function getMessage($id): ?Message
  {
    $msg = Message::leftJoin('users', 'users.id', '=', 'messages.ID_USER')
      ->select('messages.*', 'users.name as NOME')
      ->where('ID_MSG', $id)
      ->first();

    return $msg;
  }
}
