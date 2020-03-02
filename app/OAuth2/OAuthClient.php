<?php

namespace CodeDelivery\Oauth2;

use Illuminate\Database\Eloquent\Model;

class OAuthClient extends Model
{
    protected $table = "oauth_clients";
    protected $fillable = ['id', 'secret', 'name'];
}
