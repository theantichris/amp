<?php

namespace AMP\Http\Controllers\User;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\User\UserServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;

class UserApiController extends BaseApiController
{
    private $userService;

    public function __construct(Auth $auth, UserServiceInterface $userService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getListViewModels($this->getTeam()->getQueueableId());

        return new JsonResponse([
            'users' => $users,
        ]);
    }
}