<?php

namespace Tests\Domain;


use DevPledge\Domain\Comment;
use DevPledge\Uuid\Uuid;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{

    public function testCanCreateComment()
    {
        $id = Uuid::make('comment');
        $userId = Uuid::make('user');
        $problemId = Uuid::make('problem');
        $parentId = Uuid::make('comment');
        $now = new \DateTime();
        $c = new Comment(
            $id,
            $userId,
            'problem',
            $problemId,
            'This is a fantastic comment',
            $parentId,
            $now,
            $now
        );
        $this->assertInstanceOf(Comment::class, $c);
        $this->assertEquals($id, $c->getId());
        $this->assertEquals($userId, $c->getUserId());
        $this->assertEquals('problem', $c->getType());
        $this->assertEquals($problemId, $c->getOnId());
        $this->assertEquals('This is a fantastic comment', $c->getComment());
        $this->assertEquals($parentId, $c->getParentId());
        $this->assertEquals($now, $c->getCreatedAt());
        $this->assertEquals($now, $c->getUpdatedAt());
    }

}