<?php

namespace App\Models;

use App\Events\NewMessageCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['MSG', 'ID_CHANNEL', 'ID_GUILD', 'ID_USER'];




    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function Guild()
    {
        return $this->hasOne(Guild::class);
    }


    /*   protected static function boot()
    {
        parent::boot();

        static::created(function ($chatMessage) {
            if ($chatMessage->exists) {
                broadcast(new NewMessageCreated($chatMessage))->toOthers();
            }
        });
    } */
}
