<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Atributos que son asignables
    protected $fillable = [
        'title',
        'description',
        'email',
        'phone',
        'status', 
        'area_id',
        'user_id',
    ];

    // Relación con el usuario (un reporte pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el área (un reporte pertenece a un área)
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');  // Relación con Area
    }
}
