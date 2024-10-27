<?php
namespace chessBackend;

use PDO;
use PDOException;

class DbConnector
{
    private ?PDO $pdo=null;
    public function getConnection(){
            $host = Configuration::getDbHost();
            $port = Configuration::getDbPort();
            $dbname = Configuration::getDbName();
            $username = Configuration::getDbUser();
            $password = Configuration::getDbPassword();
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

            try{
                $this->pdo = new PDO($dsn, $username, $password);
                return $this->pdo;
            } catch (PDOException $e) {
                return "Connection failed . $e";
            }
    }
}