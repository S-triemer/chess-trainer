<?php

namespace chessBackend;

use PhpParser\Node\Expr\Cast\String_;

class User{
    public function __construct(
        private String $username,
        private String $password,
        private String $user_id
    ){}

    public function getUsername():String
    {
        return $this->username;
    }

    public function getPassword():String
    {
        return $this->password;    
    }
    public function getUserId():String
    {
        return $this->user_id;
    }
    public function toArray() {
        return [
            'user_id' => $this->user_id,
            'username' => $this->username
        ];
    }
}