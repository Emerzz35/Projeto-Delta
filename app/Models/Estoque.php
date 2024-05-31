<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    protected $table='PRODUTO_ESTOQUE';
    protected $primaryKey="PRODUTO_ID";
    protected $fillable = ['PRODUTO_QTD'];
    public $timestamps = false;
}
