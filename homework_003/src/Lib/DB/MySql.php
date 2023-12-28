<?php

namespace Lib\DB;

use App\Helpers\Env;

class MySql
{
    private static $mySql;
    private static $isConnect = false;

    private static function connect()
    {
        if (!self::$isConnect || is_null(self::$mySql)) {
            self::$mySql = new \mysqli(
                Env::get('MYSQL_HOST'),
                Env::get('MYSQL_USER'),
                Env::get('MYSQL_PASSWORD'),
                Env::get('MYSQL_DATABASE'),
            );
            self::$isConnect = true;
        }

    }

    public static function query($sqlQuery)
    {
        self::connect();
        return self::$mySql->query($sqlQuery);
    }

}
