<?php

namespace AMP\Http\Controllers\Project\Part\Url;

use AMP\Domain\Project\Part\Part;
use AMP\Http\Controllers\BaseApiController;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UrlApiController extends BaseApiController
{
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');

        parent::__construct($auth);
    }

    public function create(Request $request, int $projectId, int $partId): JsonResponse
    {
        $part = Part::find($partId);
        $part->addUrl($request->getContent());
        $part->save();

        return new JsonResponse([], Response::HTTP_CREATED, [
            'Location' => '/projects/' . $projectId . '/parts/' . $partId . '/' . $part->getId(),
        ]);
    }

    public function delete(int $projectId, int $partId, int $urlIndex): JsonResponse
    {
        $part = Part::find($partId);
        $part->removeUrl($urlIndex);
        $part->save();

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
