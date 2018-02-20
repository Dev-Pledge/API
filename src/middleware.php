<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

use Slim\Http\Request;
use Slim\Http\Response;
use DevPledge\Application\Security\JWT\JWT;
use DevPledge\Application\Security\JWT\Token;

$container = $app->getContainer();

$jwtMiddleware = function (Request $request, Response $response, callable $next) use ($container) {
    if (! $request->hasHeader('Authorization')) {
        return $response->withJson(['error' => 'Missing Authorization header'], 403);
    }

    $token = null;
    $headers = $request->getHeader('Authorization');
    try {
        $found = false;
        foreach ($headers as $h) {
            if (mb_strpos($h, 'Bearer ') === 0) {
                $accessToken = substr($h, 7);
                if (mb_strlen($accessToken) > 0) {
                    $found = true;
                    /**
                     * @var JWT $jwt
                     */
                    $jwt = $container->get(JWT::class);
                    $token = $jwt->verify($accessToken);
                }
                break;
            }
        }
        if (! $found) {
            throw new \Exception('Missing access token in Authorization header');
        }
    } catch (\Exception $e) {
        return $response->withJson(['error' => $e->getMessage()], 403);
    }

    $request = $request->withAttribute(Token::class, $token);

    $response = $next($request, $response);

    return $response;
};

$jwtRefreshMiddleware = function (Request $request, Response $response, callable $next) use ($container) {
    if (! $request->hasHeader('Authorization')) {
        return $response->withJson(['error' => 'Missing Authorization header'], 403);
    }

    $token = null;
    $headers = $request->getHeader('Authorization');
    try {
        $found = false;
        foreach ($headers as $h) {
            if (mb_strpos($h, 'Bearer ') === 0) {
                $accessToken = substr($h, 7);
                if (mb_strlen($accessToken) > 0) {
                    $found = true;
                    /**
                     * @var JWT $jwt
                     */
                    $jwt = $container->get(JWT::class);
                    $token = $jwt->verify($accessToken, false, true);
                }
                break;
            }
        }
        if (! $found) {
            throw new \Exception('Missing access token in Authorization header');
        }
    } catch (\Exception $e) {
        return $response->withJson(['error' => $e->getMessage()], 403);
    }

    $request = $request->withAttribute(Token::class, $token);

    $response = $next($request, $response);

    return $response;
};