<?php
namespace chessBackend;

use PDO;

class DbWriter{
    public function __construct(private PDO $dbConnection){}
    public function writeUserToDb($id, $username, $password){
        $password = password_hash($password, PASSWORD_DEFAULT);

        $statement = $this->dbConnection->prepare("INSERT INTO users (user_id, username, password) VALUES (:user_id, :username, :password)");

        $statement->bindParam(':user_id', $id);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();
    }
}