<?php

use App\Models\User;
use Illuminate\Support\Facades\Gate;

Gate::define('settings_view', function (User $user) {
    if($user->hasRole('Super Admin', 'admin') ) return true;
    return $user->hasPermissionTo('settings.view', request()->whereIam());
});
Gate::define('settings_update', function (User $user) {
    if($user->hasRole('Super Admin', 'admin') ) return true;
    return $user->hasPermissionTo('settings.update', request()->whereIam());
});
