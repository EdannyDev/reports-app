<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Ver y editar: el autor del reporte o un admin. Eliminar: solo un admin.
     */
    public function view(User $user, Report $report): Response
    {
        return $this->update($user, $report);
    }

    public function update(User $user, Report $report): Response
    {
        return $user->isAdmin() || $user->id === $report->user_id
            ? Response::allow()
            : Response::deny('No estás autorizado para realizar esta acción.');
    }

    // Solo un admin elimina reportes
    public function delete(User $user, Report $report): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('No estás autorizado para realizar esta acción.');
    }
}