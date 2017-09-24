<?php

namespace Tests\Unit\Domain\Project;

use AMP\Domain\Project\Comment;

class CommentTest extends \TestCase
{
    /** @var  Comment */
    private $uut;

    public function setUp()
    {
        $this->uut = new Comment();
    }

    /** @test */
    public function has_comment()
    {
        $comment = 'This is rad!';

        $this->uut->setComment($comment);

        $this->assertEquals($comment, $this->uut->getComment());
    }
}
