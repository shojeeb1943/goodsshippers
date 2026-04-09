<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        if (empty($user->warehouse_suite_id)) {
            $userNumber = $user->id;
            $user->warehouse_suite_id = 'GS-'.str_pad($userNumber, 5, '0', STR_PAD_LEFT);
            $user->saveQuietly();
        }
    }
}
