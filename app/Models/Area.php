<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Atributos que son asignables
    protected $fillable = [
        'name',  // Agregar 'name' como el atributo que representa el nombre del área
    ];

    // Relación inversa: un área puede tener muchos reportes
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
