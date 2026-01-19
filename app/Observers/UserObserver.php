<?php

namespace App\Observers;

use App\Models\SiteNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserObserver
{
    public function updated(User $user)
    {
        try {
            $actor = Auth::user();
        } catch (\Exception $e) {
            $actor = null;
        }

        $changed = $user->getChanges();
        $interesting = array_intersect(array_keys($changed), ['name', 'profile', 'email']);

        if (!empty($interesting)) {
            $actorName = $actor ? $actor->name : 'System';
            $message = "User \"{$user->name}\" updated ({" . implode(',', $interesting) . ") by {$actorName}";

            SiteNotification::create([
                'type' => 'user_updated',
                'message' => $message,
                'actor_id' => $actor ? $actor->id : null,
            ]);
        }
    }
}
