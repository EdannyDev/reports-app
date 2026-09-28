<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Cualquier usuario autenticado puede crear un reporte
     * (la ruta ya está protegida por la middleware 'auth').
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'area_id' => 'required|exists:areas,id',
        ];
    }
}