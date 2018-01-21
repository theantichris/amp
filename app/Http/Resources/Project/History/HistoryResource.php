<?php

namespace AMP\Http\Resources\Project\History;

use Illuminate\Http\Resources\Json\Resource;

class HistoryResource extends Resource
{
    public function toArray($request)
    {
        $event = '';

        if ($this->event == 'created') {
            $event = 'created the project';
        }

        return [
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'user'       => $this->user,
            'event'      => $event,
        ];
    }
}