<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['ciudad_id', 'pais_id', 'nombre', 'apellido', 'casado', 'telefono', 'correo'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
}
