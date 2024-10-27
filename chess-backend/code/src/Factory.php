<?php

namespace chessBackend;

use PDO;

class Factory
{
    private DbConnector $dbConnector;
    private PDO $dbConnection;
    public function __construct()
    {
        $this->dbConnector = new DbConnector();
        $this->dbConnection = $this->dbConnector->getConnection();
    }
    public function createApplication(): Application
    {
        return new Application(
            new Router(
                new ChessController(
                    new RegisterService(
                        new DbWriter(
                            $this->dbConnection
                        )
                        ),
                    new LoginService(
                        new DbReader(
                            $this->dbConnection,
                        ),
                        new JwtService()
                    ),
                    new UserService(
                        new DbReader(
                            $this->dbConnection
                        ),
                        new Authenticator(
                            new JwtService()
                        ),
                        new JwtService()
                    )
                )
            )
        );
    }
}