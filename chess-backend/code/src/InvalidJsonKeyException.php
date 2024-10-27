<?php
namespace chessBackend;

use Exception;

class InvalidJsonKeysException extends Exception {
    public function __construct($message = "Invalid JSON keys provided", $code = 400) {
        parent::__construct($message, $code);
    }
}