<?php
/*
 * Model para gravar tweet no banco de dados
 * */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = [
        'id',
        'json',
        'tweet_text',
        'user_id',
        'user_screen_name',
        'user_avatar_url',
        'user_lang',
        'user_locate',
        'public',
        'approved'
    ];
}
