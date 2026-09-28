<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    /**
     * Autorización real vía ReportPolicy en el controlador
     * (aquí no hay $report cargado, la ruta usa el id crudo).
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
            'status' => 'required|string|in:pendiente,cancelado,completado',
        ];
    }
}