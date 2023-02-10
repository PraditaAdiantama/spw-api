<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authencticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Employe extends Authencticatable
{
    use HasFactory, HasApiTokens;

    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'password'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function createToken(){
        $this->api_token = Str::random(60);
        $this->save();

        return  $this->api_token;
    }
    public function deleteToken(){
        $this->api_token = null;
        $this->save();
        return response()->json([
            'message' => "deleted"
        ]);
    }
}
