<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class IntegrationTest extends \TestCase
{
    use DatabaseTransactions;
}