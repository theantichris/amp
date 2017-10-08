<?php

use Illuminate\Contracts\Console\Kernel;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $baseUrl = 'http://amp.additerra.app';

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}