<?php

namespace chessBackend;

use Slim\App;

class Application
{
    public function __construct(
        private Router $router
    ){}

    public function startApp(App $app) : void 
    {
        $app->addErrorMiddleware(true, true, true);
        $this->router->setRoutes($app);    
    }
}