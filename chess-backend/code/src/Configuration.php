<?php

namespace chessBackend;

class Configuration
{
    private static $config = null;
   
    private static function init():void
    {
        if (self::$config === null) {
            self::$config = parse_ini_file('../config/config.ini', true);
        }
    }

    public static function getDbHost():string
    {
        self::init();
        return self::$config['database']['db_host'];
    }
    public static function getDbUser():string 
    {
        self::init();
        return self::$config['database']['db_user'];
    }
    public static function getDbPassword():string 
    {
        self::init();
        return self::$config['database']['db_password'];
    }
    public static function getDbName():string 
    {
        self::init();
        return self::$config['database']['db_name'];
    }
    public static function getDbPort():string 
    {
        self::init();
        return self::$config['database']['db_port'];
    }
}