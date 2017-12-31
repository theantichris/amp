<?php

namespace AMP\Http\Controllers\User;

use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\UserResource;
use AMP\Team;
use AMP\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserApiController extends BaseApiController
{
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');

        parent::__construct($auth);
    }

    public function index(): ResourceCollection
    {
        $team  = Team::find($this->getTeam()->getQueueableId());
        $users = $team->users;

        return UserResource::collection($users);
    }

    public function show(int $id): UserResource
    {
        return new UserResource(User::find($id));
    }
}