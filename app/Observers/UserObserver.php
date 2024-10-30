<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        // Acción al crear un usuario
    }

    // Otros métodos de observación (updated, deleted, etc.) según necesites
}
