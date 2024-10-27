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

    public function getUserForUsername($username):User
    {
        $statement = $this->dbConnection->prepare("Select user_id, username, password from users where username = :username");
        $statement->bindParam(':username', $username);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new User(
                $row['username'],
                $row['password'],
                $row['user_id']
            );
        }
    }

    public function getUserForId($user_id):User{
        $statement = $this->dbConnection->prepare("Select user_id, username, password from users where user_id = :user_id");
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new User(
                $row['username'],
                $row['password'],
                $row['user_id']
            );
        }
    }
}