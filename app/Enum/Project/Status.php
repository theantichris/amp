<?php

namespace AMP\Enum\Project;

use theantichris\enum\Enum;

class Status extends Enum
{
    const NEW_PROJECT     = 'New';
    const READY_TO_QUOTE  = 'Ready To Quote';
    const QUOTE_GENERATED = 'Quote Generated';
    const QUOTE_SENT      = 'Quote Sent';
    const QUOTE_ACCEPTED  = 'Quote Accepted';
    const QUOTE_REJECTED  = 'Quote Rejected';
    const PRE_PRODUCTION  = 'Pre-Production';
    const PRODUCTION      = 'Production';
    const POST_PRODUCTION = 'Post-Production';
    const QUALITY_CONTROL = 'Quality Control';
    const SHIPPING        = 'Shipping';
    const SHIPPED         = 'Shipped';
    const DELIVERED       = 'Delivered';
    const INVOICED        = 'Invoiced';
    const PAID            = 'Paid';
    const COMPLETE        = 'Complete';
}