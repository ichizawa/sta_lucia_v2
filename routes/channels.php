<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\bill\Billing;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
