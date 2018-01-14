<?php

namespace AMP\Http\Resources\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use Illuminate\Http\Resources\Json\Resource;

class MachineProfileResource extends Resource
{
    public function toArray($request)
    {
        /** @var MachineProfile $this */

        return [
            'id'                      => $this->id,
            'type'                    => $this->type,
            'setup_fee'               => $this->setup_fee,
            'rate'                    => $this->rate,
            'time_calculation_method' => $this->time_calculation_method,
            'build_rate'              => $this->build_rate,
        ];
    }
}