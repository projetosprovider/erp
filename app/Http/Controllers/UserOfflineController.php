<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserOffline;
use App\User;

class UserOfflineController extends Controller
{
    public function __invoke(User $user)
    {
        $user->status = 'offline';
        $user->save();

        broadcast(new UserOffline($user));
    }
}
