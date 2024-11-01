<?php
namespace chessBackend;

use Ramsey\Uuid\Uuid;

class RegisterService{
    public function __construct(private DbWriter $dbWriter){}
    public function registerUser($parsedBody){
        try{
            //check on empty instead of isset?
            if (!isset($parsedBody['username']) || !isset($parsedBody['password'])) {
                throw new InvalidJsonKeysException("Missing required JSON keys: 'username' and/or 'password'.");
            }
            $username = $parsedBody["username"];
            $password = $parsedBody["password"];
            $id = Uuid::uuid4()->toString();

            $this->dbWriter->writeUserToDb($id, $username, $password);

            return [
                'success' => true,
                'message' => 'User registered successfully',
            ];
    
        } catch (InvalidJsonKeysException $e) {
            return [
                'success' =>false,
                'code' =>'INVALID_JSON_KEYS',
                'message' => $e->getMessage(),
            ];
        } catch (\Exception $e){
            return [
                'success' => false,
                'code' => 'REGISTRATION_FAILED',
                'message' => 'An error occurred while registering the user: ' . $e->getMessage(),
            ];
        }
    }
}