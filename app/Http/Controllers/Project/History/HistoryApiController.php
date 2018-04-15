<?php

namespace AMP\Http\Controllers\Project\History;

use AMP\Domain\Project\Project;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Project\History\HistoryResource;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HistoryApiController extends BaseApiController
{
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');

        parent::__construct($auth);
    }

    public function index(int $projectId): ResourceCollection
    {
        $history = Project::with('audits.user')->find($projectId)->audits;

        return HistoryResource::collection($history);
    }
}
