<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\Frontend\Auth\UserRegistered;
use Carbon\Carbon;
use App\Repositories\Frontend\Auth\UserRepository;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register user and create token
     *
     * @param RegisterRequest $request
     *
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email', 'password'));
        event(new UserRegistered($user));

        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            return $this->responseSuccess([
                'message' => config('access.users.requires_approval') ?
                    __('exceptions.frontend.auth.confirmation.created_pending') : __('exceptions.frontend.auth.confirmation.created_confirm')
            ]);
        } else {
            auth()->loginUsingId($user->id);

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            $token->save();

            return $this->responseSuccess([
                'user' => auth()->user(),
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
    }
}
