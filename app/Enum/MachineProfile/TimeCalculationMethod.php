<?php

namespace AMP\Enum\MachineProfile;

use theantichris\enum\Enum;

class TimeCalculationMethod extends Enum
{
    const VOLUMETRIC = 'Volumetric (cc/hr)';
    const Z_HEIGHT   = 'Z-Height (cm/hr)';
}