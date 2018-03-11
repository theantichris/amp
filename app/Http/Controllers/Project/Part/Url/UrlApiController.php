<?php

namespace AMP\Http\Controllers\Project\Part\Url;

use AMP\Domain\Project\Part\Part;
use AMP\Http\Controllers\BaseApiController;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrlApiController extends BaseApiController
{
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');

        parent::__construct($auth);
    }

    public function create(Request $request, int $projectId, int $partId): JsonResponse
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $part = Part::find($partId);

        $part->addUrl($request->getContent());

        $part->save();

        return new JsonResponse([], 201, [
            'Location' => '/projects/' . $projectId . '/parts/' . $partId . '/' . $part->getId(),
        ]);
    }
}
