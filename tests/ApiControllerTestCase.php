<?php

namespace Tests;

use AMP\Team;
use AMP\User;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;

abstract class ApiControllerTestCase extends \TestCase
{
    use MockeryPHPUnitIntegration;

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