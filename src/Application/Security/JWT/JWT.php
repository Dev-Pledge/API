<?php

namespace DevPledge\Application\Security\JWT;


use TomWright\JSON\Exception\JSONDecodeException;
use TomWright\JSON\Exception\JSONEncodeException;
use TomWright\JSON\JSON;

class JWT
{

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $algorithm;

    /**
     * @var JSON
     */
    private $json;

    /**
     * @var int
     */
    private $timeToLive;

    /**
     * @var int
     */
    private $timeToRefresh;

    /**
     * JWT constructor.
     * @param string $secret
     * @param string $algorithm
     * @param JSON $json
     * @param int $timeToLive
     * @param int $timeToRefresh
     */
    public function __construct(string $secret, string $algorithm, JSON $json, $timeToLive = 3600, $timeToRefresh = 7200)
    {
        $this
            ->setSecret($secret)
            ->setAlgorithm($algorithm)
            ->setTimeToLive($timeToLive)
            ->setTimeToRefresh($timeToRefresh);
        $this->json = $json;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return JWT
     */
    public function setSecret(string $secret): JWT
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param string $algorithm
     * @return JWT
     */
    public function setAlgorithm(string $algorithm): JWT
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeToLive(): int
    {
        return $this->timeToLive;
    }

    /**
     * @param int $ttl
     * @return JWT
     */
    public function setTimeToLive(int $ttl): JWT
    {
        $this->timeToLive = $ttl;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeToRefresh(): int
    {
        return $this->timeToRefresh;
    }

    /**
     * @param int $ttr
     * @return JWT
     */
    public function setTimeToRefresh(int $ttr): JWT
    {
        $this->timeToRefresh = $ttr;
        return $this;
    }

    /**
     * @param \stdClass $data
     * @return string
     * @throws JSONEncodeException
     */
    public function generate(\stdClass $data): string
    {
        $header = (object) [
            'alg' => $this->getAlgorithm(),
            'typ' => 'JWT',
        ];

        $now = time();

        $payload = (object) [
            'ttl' => $now + $this->timeToLive,
            'ttr' => $now + $this->timeToRefresh,
            'data' => $data,
        ];

        $encodedHeader = $this->encodeTokenPart($header);
        $encodedPayload = $this->encodeTokenPart($payload);

        $signature = $this->generateSignature($encodedHeader, $encodedPayload);

        $token = "{$encodedHeader}.{$encodedPayload}.{$signature}";

        return $token;
    }

    /**
     * @param string $accessToken
     * @param bool $checkTtl
     * @param bool $checkTtr
     * @return Token
     * @throws InvalidTokenException
     */
    public function verify(string $accessToken, $checkTtl = true, $checkTtr = false): Token
    {
        $parts = $this->getPartsFromToken($accessToken);
        if ($parts->header === null || $parts->payload === null || $parts->signature === null) {
            // Invalid token format
            throw new InvalidTokenException('Invalid token format');
        }

        $signature = $this->generateSignature($parts->header, $parts->payload);
        if ($signature !== $parts->signature) {
            // Invalid token signature
            throw new InvalidTokenException('Invalid token signature');
        }

        $header = $this->decodeTokenPart($parts->header);
        if (($header->alg ?? null) !== $this->getAlgorithm()) {
            // Invalid token signature
            throw new InvalidTokenException('Invalid token algorithm');
        }
        if (($header->typ ?? null) !== 'JWT') {
            // Invalid token signature
            throw new InvalidTokenException('Invalid token type');
        }

        $payload = $this->decodeTokenPart($parts->payload);

        if ($checkTtl) {
            $this->checkTimeToLive($payload);
        }

        if ($checkTtr) {
            $this->checkTimeToRefresh($payload);
        }

        $data = $payload->data ?? new \stdClass();

        $token = new Token($data);

        return $token;
    }

    /**
     * @param \stdClass $payload
     * @throws InvalidTokenException
     */
    private function checkTimeToLive(\stdClass $payload)
    {
        if (!is_numeric($payload->ttl ?? null)) {
            // Invalid token signature
            throw new InvalidTokenException('Missing or invalid TTL');
        }

        $now = time();

        if ($payload->ttl < $now) {
            throw new InvalidTokenException('TTL has expired');
        }
    }

    /**
     * @param \stdClass $payload
     * @throws InvalidTokenException
     */
    private function checkTimeToRefresh(\stdClass $payload)
    {
        if (! is_numeric($payload->ttr ?? null)) {
            // Invalid token signature
            throw new InvalidTokenException('Missing or invalid TTR');
        }

        $now = time();

        if ($payload->ttr < $now) {
            throw new InvalidTokenException('TTR has expired');
        }
    }

    /**
     * @param string $base64Part
     * @return object
     * @throws InvalidTokenException
     */
    private function decodeTokenPart(string $base64Part): object
    {
        $jsonPart = base64_decode($base64Part);
        try {
            $part = $this->json->decode($jsonPart);
        } catch (JSONDecodeException $e) {
            throw new InvalidTokenException('Token part contains invalid JSON');
        }
        return $part;
    }

    /**
     * @param object $part
     * @return object
     * @throws \TomWright\JSON\Exception\JSONEncodeException
     */
    private function encodeTokenPart(object $part): string
    {
        $jsonPart = $this->json->encode($part);
        $base64Part = base64_encode($jsonPart);
        return $base64Part;
    }

    /**
     * @param string $accessToken
     * @return \stdClass
     */
    private function getPartsFromToken(string $accessToken): object
    {
        $splitToken = explode('.', $accessToken);
        $res = new \stdClass();
        $res->header = $splitToken[0] ?? null;
        $res->payload = $splitToken[1] ?? null;
        $res->signature = $splitToken[2] ?? null;

        return $res;
    }

    private function generateSignature($header, $payload): string
    {
        return hash_hmac($this->getAlgorithm(), $header . '.' . $payload, $this->getSecret());
    }

}