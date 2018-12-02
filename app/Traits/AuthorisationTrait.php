<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AuthorisationTrait
{

    public function getCanNotUseModelAttribute()
    {
        return isset($this->isRequireAuthorization)
            && $this->isRequireAuthorization
            && !(Auth::check() && Auth::user()->is_admin);
    }
}