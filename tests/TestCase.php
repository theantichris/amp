<?php

use AMP\Team;
use AMP\User;
use Illuminate\Contracts\Console\Kernel;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use MockeryPHPUnitIntegration;

    protected $baseUrl = 'http://amp.additerra.app';

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function getTeam(MockInterface $mockAuth): MockInterface
    {
        $mockUser = \Mockery::mock(User::class);
        $mockAuth->shouldReceive('user')
                 ->once()
                 ->andReturn($mockUser);

        $mockTeam = \Mockery::mock(Team::class);
        $mockUser->shouldReceive('currentTeam')
                 ->once()
                 ->andReturn($mockTeam);

        return $mockTeam;
    }
}
