<?php

namespace AMP\Http\Controllers\Project\Part\History;

use AMP\Domain\Project\Part\Part;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Project\Part\History\HistoryResource;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HistoryApiController extends BaseApiController
{
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');

        parent::__construct($auth);
    }

    public function index(int $partId): ResourceCollection
    {
        $history = Part::with('audits.user')->find($partId)->audits;

        return HistoryResource::collection($history);
    }
}
