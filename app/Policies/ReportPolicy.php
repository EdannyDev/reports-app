<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Solo el autor del reporte o un admin pueden editarlo o eliminarlo.
     */
    public function update(User $user, Report $report): Response
    {
        return $user->isAdmin() || $user->id === $report->user_id
            ? Response::allow()
            : Response::deny('No estás autorizado para realizar esta acción.');
    }

    public function delete(User $user, Report $report): Response
    {
        return $this->update($user, $report);
    }
}