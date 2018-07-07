<?php

namespace Tests\Security\JWT;


use PHPUnit\Framework\TestCase;
use TomWright\JSON\JSON;
use DevPledge\Integrations\Security\JWT\InvalidTokenException;
use DevPledge\Integrations\Security\JWT\JWT;
use DevPledge\Integrations\Security\JWT\Token;

class JWTTest extends TestCase
{

    /**
     * @var JWT
     */
    private $jwt;

    /**
     * @var JSON
     */
    private $json;

    /**
     * @var \stdClass
     */
    private $payload;

    public function setUp()
    {
        parent::setUp();

        $this->json = new JSON();
        $this->jwt = new JWT('asd', 'SHA256', $this->json);
        $this->payload = (object) [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => (object) [
                'e' => 5,
                'f' => 6,
            ],
        ];
    }

    public function testJWTWorksWhenExpected()
    {
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $t = $this->jwt->verify($token);
        $this->assertInstanceOf(Token::class, $t);
        $this->assertEquals($this->payload, $t->getData());
        $this->assertEquals($this->json->encode($this->payload), $this->json->encode($t->getData()));
    }

    public function testJWTThrowsExceptionWithInvalidSecret()
    {
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $this->jwt->setSecret('123');

        $this->expectException(InvalidTokenException::class);
        $this->jwt->verify($token);
    }

    public function testJWTThrowsExceptionWithInvalidToken()
    {
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $token .= 'asd';

        $this->expectException(InvalidTokenException::class);
        $this->jwt->verify($token);
    }

    public function testJWTThrowsExceptionWhenTTLTimedOut()
    {
        $this->jwt->setTimeToLive(-1);
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $this->expectException(InvalidTokenException::class);
        $this->jwt->verify($token);
    }

    public function testJWTThrowsExceptionWhenTTRTimedOut()
    {
        $this->jwt->setTimeToRefresh(-1);
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $this->expectException(InvalidTokenException::class);
        $this->jwt->verify($token, false, true);
    }

    public function testJWTChecksCorrectTimeAccordingToVerifyArgs()
    {
        $this->jwt->setTimeToLive(3600);
        $this->jwt->setTimeToRefresh(-1);
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $this->jwt->verify($token, true, false);

        $this->expectException(InvalidTokenException::class);
        $this->jwt->verify($token, false, true);

        $this->jwt->setTimeToLive(-1);
        $this->jwt->setTimeToRefresh(3600);
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $this->jwt->verify($token, false, true);

        $this->expectException(InvalidTokenException::class);
        $this->jwt->verify($token, true, false);

        $this->jwt->setTimeToLive(-1);
        $this->jwt->setTimeToRefresh(-1);
        $token = $this->jwt->generate($this->payload);
        $this->assertTrue(is_string($token));

        $this->jwt->verify($token, false, false);
    }

}