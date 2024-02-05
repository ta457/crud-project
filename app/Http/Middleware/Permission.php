<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class Permission
{
    public function checkGate($permission)
    {
        if (!Gate::allows($permission)) {
            abort(Response::HTTP_FORBIDDEN);
        }
    }
}