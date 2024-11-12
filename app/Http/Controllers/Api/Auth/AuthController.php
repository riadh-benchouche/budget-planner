<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\Status;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use App\Http\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    /**
     * @var UserRepository
     */
    private UserRepository $authRepository;

    public function __construct(UserRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @throws Exception
     */

    public function login(LoginRequest $request): JsonResponse|array
    {
        $user = User::whereUserStatus(Status::ENABLED)->where('email', $request->email)->first();

        // Check credentials
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse(
                __("The provided credentials are incorrect."),
                401
            );
        }

        return [
            "data" => new UserResource($user),
            "token" => $this->authRepository->createToken($user)
        ];
    }

    /**
     * @param RegisterRequest $request
     * @return array|JsonResponse
     * @throws Exception
     */

    public function register(RegisterRequest $request): JsonResponse|array
    {
        $user = $this->authRepository->createAccount($request->all());

        return [
            "data" => new UserResource($user),
            "token" => $this->authRepository->createToken($user),
        ];
    }

    public function logout(Request $request)
    {
        $this->authRepository->revokeTokenById($request->user(), $request->user()->currentAccessToken()->id);
        return $this->showMessage(__('logout success'));
    }
}
