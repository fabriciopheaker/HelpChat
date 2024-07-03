<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $fillable = ['NOME_GUILD'];
    protected $primaryKey = 'ID_GUILD';
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
