<?php
namespace chessBackend;

class UserService{
    public function __construct(
        private DbReader $dbReader,
        private Authenticator $authenticator,
        private JwtService $jwtService
        ){}

    public function getUserForId($authHeader){
        try{
            if($this->authenticator->userIsAuthenticated($authHeader))
            {
                list($type, $token) = explode(' ', $authHeader);
                $decodedJwt = $this->jwtService->decodeJwt($token);
                $user_id = $decodedJwt->user_id;
                $user = $this->dbReader->getUserForId($user_id);

                return
                [
                    "success" => true,
                    "user" => $user->toArray()
                ];
            }
        }
        catch(\Exception $e){
            return
            [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }
}