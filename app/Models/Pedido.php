<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Pedido extends Model
{
    use HasFactory;
    protected $table="PEDIDO";
    protected $primaryKey="PEDIDO_ID";
    protected $fillable = ['USUARIO_ID','STATUS_ID','PEDIDO_DATA','ENDERECO_ID'];
    public $timestamps = false;
    
    public function Endereco(){
        return $this->belongsTo(Endereco::class,'ENDERECO_ID', 'ENDERECO_ID');
    }
    public function User(){
        return $this->belongsTo(User::class,'USUARIO_ID','USUARIO_ID');
    }
    public function PedidoStatus(){
        return $this->belongsTo(PedidoStatus::class,'STATUS_ID','STATUS_ID');
    }
    public function PedidoItem(){
        return $this->hasMany(PedidoItem::class,'PEDIDO_ID','PEDIDO_ID');
    }
}
