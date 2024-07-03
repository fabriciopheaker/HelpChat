<?php

namespace App\Repository;

use App\Models\Guild;
use Illuminate\Support\Collection;

class GuildRepository
{

  public function allGuilds(): Collection|bool
  {
    $servidores = Guild::all();
    return isset($servidores) ? $servidores : false;
  }

  public function createGuild($param): int|bool
  {
    $param->NOME = mb_strtoupper($param->NOME, 'UTF-8');
    $guild = Guild::create([
      'NOME_GUILD' => $param->NOME,
    ]);
    return $guild ? $guild->ID_GUILD : false;
  }

  public function deleteGuild($id): bool
  {
    $guild = Guild::find($id);
    if ($guild) {
      $guild->delete();
      return true;
    }
    return false;
  }

  public function showGuild($id): Object|bool
  {
    $guild = Guild::where('ID_GUILD', $id)->first();
    return isset($guild) ? $guild : false;
  }
}
