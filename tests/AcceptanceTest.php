<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class AcceptanceTest extends \TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
}