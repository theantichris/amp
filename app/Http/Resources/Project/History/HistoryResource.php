<?php

namespace AMP\Http\Resources\Project\History;

use AMP\Domain\Customer\Customer;
use AMP\User;
use Illuminate\Http\Resources\Json\Resource;

class HistoryResource extends Resource
{
    public function toArray($request)
    {
        $event = '';

        switch ($this->event) {
            case 'created':
                $event = 'created the project';
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
        setlocale(LC_MONETARY, 'en_US.UTF-8');

        $events = [];
        foreach ($this->new_values as $property => $value) {
            switch ($property) {
                case 'name':
                    $events[] = 'updated Name to ' . $value;
                    break;
                case 'production_cost':
                    $events[] = 'updated Production Cost to ' . money_format('%.2n', $value);
                    break;
                case 'sales_price':
                    $events[] = 'updated Sales Price to ' . money_format('%.2n', $value);
                    break;
                case 'customer_id':
                    if ($value) {
                        $events[] = 'updated Customer to ' . Customer::find($value)->company_name;
                    } else {
                        $events[] = 'updated Customer to Internal';
                    }
                    break;
                case 'manager_id':
                    $events[] = 'updated Manager to ' . User::find($value)->name;
                    break;
            }
        }

        return implode(', ', $events);
    }
}