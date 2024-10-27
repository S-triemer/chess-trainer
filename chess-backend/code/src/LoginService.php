<?php
namespace chessBackend;

class LoginService {
    public function __construct(private DbReader $dbReader){}

    public function login($credentials){
        $enteredUsername = $credentials["username"];
        $enteredPassword = $credentials["password"];
        $userPassword = $this->dbReader->getPasswordForUsername($enteredUsername);

        try{
            if(!$this->verifyPassword($enteredPassword, $userPassword)){
                throw new LoginException('Invalid Username or Password');
            }
            return [
                "success" => true,
                "message" => "Login successfull"
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