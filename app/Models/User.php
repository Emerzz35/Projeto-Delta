<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "USUARIO";
    protected $primaryKey = "USUARIO_ID";
    public $timestamps = false;

    protected $fillable = [
        'USUARIO_NOME',
        'USUARIO_EMAIL',
        'USUARIO_SENHA',
        'USUARIO_CPF'
    ];

    protected $hidden = [
        'USUARIO_SENHA',
    ];

    public function Endereco(){
        return $this->hasMany(Endereco::class,'USUARIO_ID', 'USUARIO_ID');
    }
}
