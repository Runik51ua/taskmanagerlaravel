<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Brackets\AdminAuth\Traits\RedirectsUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RedirectsUsers;

    public function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }
}
