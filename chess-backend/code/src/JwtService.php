<?php
namespace chessBackend;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class JwtService {
    private $secretKey;
    public function __construct(){
        $this->secretKey = Configuration::getSecretKey();
    }

    public function generateJWT($userId) {
        $secretKey = $this->secretKey;
        $issuedAt = time();
        $expirationTime = $issuedAt + 18000; // 5 hours
        $payload = [
            'user_id' => $userId,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];
    
        return JWT::encode($payload, $secretKey, 'HS256');
    }

    public function jwtIsValid(String $jwt):bool 
    {
        try {
            JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
            return true;
        } catch (ExpiredException $e) {
            var_dump('JWT expired: ' . $e->getMessage());
            return false;
        } catch (SignatureInvalidException $e) {
            var_dump('JWT signature invalid: ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            var_dump('JWT is invalid: ' . $e->getMessage());
            return false;
        }
    }

    public function decodeJwt($token){
        return JWT::decode($token, new Key(Configuration::getSecretKey(), 'HS256'));
    }
}