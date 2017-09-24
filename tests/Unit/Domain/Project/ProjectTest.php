<?php

namespace Tests\Unit\Domain\Project;

use AMP\Domain\Project\Project;
use AMP\Enum\Project\Status;
use AMP\Enum\Project\Type;
use Carbon\Carbon;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /** @var  Project */
    private $uut;

    public function setUp()
    {
        $this->uut = new Project();
    }

    /** @test */
    public function has_name()
    {
        $name = 'Gadget';

        $this->uut->setName($name);

        $this->assertEquals($name, $this->uut->getName());
    }

    /** @test */
    public function has_status()
    {
        $status = Status::NEW_PROJECT;

        $this->uut->setStatus($status);

        $this->assertEquals($status, $this->uut->getStatus());
    }

    /** @test */
    public function rejects_invalid_status()
    {
        $status = 'Butts';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setStatus($status);
    }

    /** @test */
    public function has_type()
    {
        $type = Type::CUSTOMER;

        $this->uut->setType($type);

        $this->assertEquals($type, $this->uut->getType());
    }

    /** @test */
    public function rejects_invalid_type()
    {
        $type = 'Butts';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setType($type);
    }

    /** @test */
    public function has_due_date()
    {
        $dueDate = new Carbon();

        $this->uut->setDueDate($dueDate);

        $this->assertEquals($dueDate, $this->uut->getDueDate());
    }
}
