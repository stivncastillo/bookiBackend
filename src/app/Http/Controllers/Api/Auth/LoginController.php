<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// use App\Events\Frontend\Auth\UserLoggedOut;

/**
 * Class LoginController.
 */
class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->responseError('Unauthorized', [], 401);
        }

        if (!$request->user()->isConfirmed()) {
            auth()->logout();
            return $this->responseError(__('exceptions.frontend.auth.confirmation.not_confirmed'), [], 401);
        }

        if (!$request->user()->isActive()) {
            auth()->logout();
            return $this->responseError(__('exceptions.frontend.auth.deactivated'), [], 401);
        }

        $user = $request->user();

        // if ($request->has('fcm_token')) {
        //     $user->fcm_token = $request->get('fcm_token');
        //     $user->save();
        // }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        $user = Auth::user();
        event(new UserLoggedIn($user));

        return $this->responseSuccess([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
