<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
