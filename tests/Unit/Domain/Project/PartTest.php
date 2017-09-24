<?php

namespace Tests\Unit\Domain\Project;

use AMP\Domain\Project\Part;
use PHPUnit\Framework\TestCase;

class PartTest extends TestCase
{
    /** @var  Part */
    private $uut;

    public function setUp()
    {
        $this->uut = new Part();
    }

    /** @test */
    public function has_name()
    {
        $name = 'Widget';

        $this->uut->setName($name);

        $this->assertEquals($name, $this->uut->getName());
    }

    /** @test */
    public function has_quantity()
    {
        $quantity = 100;

        $this->uut->setQuantity($quantity);

        $this->assertEquals($quantity, $this->uut->getQuantity());
    }

    /** @test */
    public function has_requirements()
    {
        $requirements = 'Needs to do something cool.';

        $this->uut->setRequirements($requirements);

        $this->assertEquals($requirements, $this->uut->getRequirements());
    }
}
