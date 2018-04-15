<?php

namespace AMP\Http\Resources\Project\Part\History;

use Illuminate\Http\Resources\Json\Resource;

class HistoryResource extends Resource
{
    public function toArray($request)
    {
        $event = '';

        switch ($this->event) {
            case 'created':
                $event = 'created the part';
                break;
            case 'updated':
                $event = $this->processUpdatedFields();
                break;
        }

        return [
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'user'       => $this->user,
            'event'      => $event,
        ];
    }

    private function processUpdatedFields(): string
    {
        $events = [];
        foreach ($this->new_values as $property => $value) {
            switch ($property) {
                case 'name':
                    $events[] = 'updated Name to ' . $value;
                    break;
                case 'quantity':
                    $events[] = 'updated Quantity to ' . $value;
                    break;
                case 'requirements':
                    $events[] = 'updated Requirements to ' . $value;
                    break;
                case 'description':
                    $events[] = 'updated Description to ' . $value;
                    break;
            }
        }

        return implode(', ', $events);
    }
}