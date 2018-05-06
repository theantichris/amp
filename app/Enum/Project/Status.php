<?php

namespace AMP\Enum\Project;

use theantichris\enum\Enum;

class Status extends Enum
{
    public const NEW_PROJECT     = 'New';
    public const READY_TO_QUOTE  = 'Ready To Quote';
    public const QUOTE_GENERATED = 'Quote Generated';
    public const QUOTE_SENT      = 'Quote Sent';
    public const QUOTE_ACCEPTED  = 'Quote Accepted';
    public const QUOTE_REJECTED  = 'Quote Rejected';
    public const PRE_PRODUCTION  = 'Pre-Production';
    public const PRODUCTION      = 'Production';
    public const POST_PRODUCTION = 'Post-Production';
    public const QUALITY_CONTROL = 'Quality Control';
    public const SHIPPING        = 'Shipping';
    public const SHIPPED         = 'Shipped';
    public const DELIVERED       = 'Delivered';
    public const INVOICED        = 'Invoiced';
    public const PAID            = 'Paid';
    public const COMPLETE        = 'Complete';
}