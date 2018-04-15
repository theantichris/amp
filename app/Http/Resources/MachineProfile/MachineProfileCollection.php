<?php

namespace AMP\Http\Resources\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MachineProfileCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        /** @var MachineProfile $this */

        return [
            'data' => $this->collection->transform(function (MachineProfile $machineProfile) {
                return [
                    'id'        => $machineProfile->id,
                    'type'      => $machineProfile->type,
                    'setup_fee' => $machineProfile->setup_fee,
                    'rate'      => $machineProfile->rate,
                ];
            }),
        ];
    }
}
