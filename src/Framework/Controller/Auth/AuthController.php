<?php

namespace DevPledge\Framework\Controller\Auth;


use Slim\Http\Request;
use Slim\Http\Response;
use TomWright\JSON\Exception\JSONEncodeException;
use DevPledge\Application\Security\JWT\JWT;
use DevPledge\Application\Security\JWT\Token;

class AuthController
{

    /**
     * @var JWT
     */
    private $jwt;

    /**
     * AuthController constructor.
     * @param JWT $jwt
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if ($username === 'tom' && $password === 'password') {
            try {
                $token = $this->jwt->generate((object)[
                    'username' => $username,
                    'password' => $password,
                ]);

                return $response->withJson(['token' => $token]);
            } catch (JSONEncodeException $e) {
                return $response->withJson(['error' => 'Could not generate token'], 500);
            }
        } else {
            return $response->withJson(['error' => 'Invalid username or password'], 401);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function refresh(Request $request, Response $response)
    {
        /**
         * @var Token $token
         */
        $token = $request->getAttribute(Token::class);

        try {
            $newToken = $this->jwt->generate($token->getData());
        } catch (JSONEncodeException $e) {
            return $response->withJson(['error' => 'Could not generate token'], 500);
        }

        return $response->withJson(['token' => $newToken]);
    }

}