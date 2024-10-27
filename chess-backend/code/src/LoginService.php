<?php
namespace chessBackend;

class LoginService {
    public function __construct(
        private DbReader $dbReader,
        private JwtService $jwtService
    ){}

    public function login($credentials){
        $enteredUsername = $credentials["username"];
        $enteredPassword = $credentials["password"];
        $user = $this->dbReader->getUserForUsername($enteredUsername);
        $userPassword = $user->getPassword();
        $user_id = $user->getUserId();
        $username = $user->getUsername();

        try{
            if(!$this->verifyPassword($enteredPassword, $userPassword)){
                throw new LoginException('Invalid Username or Password');
            }
            $token = $this->jwtService->generateJWT($user_id);
            return [
                "success" => true,
                "message" => "Login successfull",
                "token" => $token,
                "username" => $username
            ];
        } catch (LoginException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    private function verifyPassword($enteredPassword, $userPassword):bool
    {
        return password_verify($enteredPassword, $userPassword);
    }


}