<?php

namespace App\Repository;

use App\Models\Channel;
use App\Models\Guild;
use Illuminate\Support\Collection;

class ChannelRepository
{

  public function getGuildChannel($idGuild): Collection|bool
  {
    $channels = Channel::where('ID_GUILD', $idGuild)->get();
    return $channels->isNotEmpty() ? $channels : false;
  }

  public function createChannel($param): int|bool
  {
    $param->NOME = mb_strtoupper($param->NOME, 'UTF-8');
    $channel = Channel::create([
      'NOME_CHANNEL' => $param->NOME,
      'ID_GUILD' => $param->ID_GUILD,
    ]);
    return $channel ? $channel->ID_CHANNEL : false;
  }


  public function showChannel($id): Object|bool
  {
    $channel = Channel::where('ID_CHANNEL', $id)->first();
    return isset($channel) ? $channel : false;
  }
}
