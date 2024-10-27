<?php
namespace chessBackend;

use PDO;

class DbReader{
    public function __construct(private PDO $dbConnection){}
    public function getPasswordForUsername($username){
        $statement = $this->dbConnection->prepare("Select password from users where username = :username");
        $statement->bindParam(':username', $username);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['password'] : null;
    }
}