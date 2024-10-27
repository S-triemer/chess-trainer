<?php

namespace chessBackend;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ChessController
{
    private const HTTP_OK = 200;
    private const HTTP_CREATED = 201;
    private const HTTP_BAD_REQUEST = 400;
    private const HTTP_UNAUTHORIZED = 401;
    

    public function __construct(
        private RegisterService $registerService,
        private LoginService $loginService,
        private UserService $userService
    ){}

    public function registerUser(Request $request, Response $response):Response
    {
        $rawBody = $request->getBody()->getContents();
        $parsedBody = json_decode($rawBody, true);

        $result = $this->registerService->registerUser($parsedBody);

        if($result['success']){
            $response->getBody()->write(json_encode([
                'status' => 'success',
                'message' => $result['message']
            ]));
            return $response->withStatus(self::HTTP_CREATED)->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'code' => $result['code'],
                'message' => $result['message'],
            ]));
            return $response->withStatus(self::HTTP_BAD_REQUEST)->withHeader('Content-Type', 'application/json');
        }
    }

    public function loginUser(Request $request, Response $response){
        $rawBody = $request->getBody()->getContents();
        $parsedBody = json_decode($rawBody, true);

        $result = $this->loginService->login($parsedBody);

        if($result['success']){
            $response->getBody()->write(json_encode([
                'status' => 'success',
                'message' => $result['message'],
                'token' => $result['token'],
                'username' =>$result['username']
            ]));
            return $response->withStatus(self::HTTP_OK)->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'message' => $result['message']
            ]));
            return $response->withStatus(self::HTTP_UNAUTHORIZED)->withHeader('Content-Type', 'application/json');
        }
    }

    public function getUser(Request $request, Response $response)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        $result = $this->userService->getUserForId($authHeader);
        if($result['success']){
            $response->getBody()->write(json_encode([
                'status' => 'success',
                'user' => $result['user']
            ]));
            return $response->withStatus(self::HTTP_OK)->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'message' => $result['message']
            ]));
            return $response->withStatus(self::HTTP_UNAUTHORIZED)->withHeader('Content-Type', 'application/json');
        }

    }
}