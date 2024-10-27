<?php

namespace chessBackend;

use Slim\App;

class Router
{
    public function __construct(private ChessController $chessController){}

    public function setRoutes(App $app): void
    {
        $app->post('/api/users/register', [$this->chessController, 'registerUser']);
        $app->post('/api/users/login', [$this->chessController, 'loginUser']);
        $app->get('/api/user', [$this->chessController, 'getUser']);
    }
}