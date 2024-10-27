<?php

namespace chessBackend;

use Exception;

class Authenticator{
    public function __construct(private JwtService $jwtService){}

    public function userIsAuthenticated($authHeader):bool
    {
        if (!$authHeader) {
           throw new Exception("Unauthorized: No Authorization header provided");
        }
        list($type, $token) = explode(' ', $authHeader);
        if (strtolower($type) !== 'bearer') {
            throw new Exception("Unauthorized: Invalid token type");
        }
        if (!$this->jwtService->jwtIsValid($token)) {
            var_dump($token);
           throw new Exception("Unauthorized: Invalid token");
        }
        return true;
    }
}