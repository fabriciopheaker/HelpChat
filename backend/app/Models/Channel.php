<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['NOME_CHANNEL', 'ID_GUILD'];
    protected $primaryKey = 'ID_CHANNEL';
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function guild()
    {
        return $this->hasOne(Guild::class);
    }
}
