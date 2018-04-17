<?php

namespace Tests\Domain;


use DevPledge\Domain\Currency;
use DevPledge\Uuid\Uuid;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{

    public function testCanCreateCurrency()
    {
        $id = Uuid::make('comment');
        $now = new \DateTime();
        $c = new Currency(
            $id,
            'Great British Pound',
            'GBP',
            $now,
            $now
        );
        $this->assertInstanceOf(Currency::class, $c);
        $this->assertEquals($id, $c->getId());
        $this->assertEquals('Great British Pound', $c->getName());
        $this->assertEquals('GBP', $c->getAbbreviation());
        $this->assertEquals($now, $c->getCreatedAt());
        $this->assertEquals($now, $c->getUpdatedAt());
    }

}