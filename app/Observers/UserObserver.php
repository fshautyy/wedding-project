<?php

namespace App\Observers;

use App\Models\App;
use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('email_verified_at') && $user->email_verified_at !== null) {

            if ($user->role !== 'user') {
                return;
            }

            if ($user->app) {
                return;
            }

            $baseSlug = Str::slug($user->name . '-wedding');

            $slug = $baseSlug;
            $counter = 1;

            while (App::where('app_slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            App::create([
                'user_id'  => $user->id,
                'app_name' => 'Undangan Pernikahan ' . $user->name,
                'app_slug' => $slug,
                'app_type' => 'wedding',
                'settings' => [
                    'theme' => 'default',
                ],
            ]);
        }
    }
}
