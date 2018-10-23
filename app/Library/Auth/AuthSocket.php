<?php
namespace APP\Library\Auth;
/**
 * Created by PhpStorm.
 * User: PuterSham
 * Date: 2015/11/19
 * Time: 15:47
 */

define('SOCKET_HOST', 'auth.mjutech.com');
define('SOCKET_PORT', 1234);
define('PROC_SOCKET_HOST', 2);
define('APP_ID', '12345678');
define('APP_KEY', 'asdfghj');

class AuthSocket
{
    private static $nd;
    private static $socket;
    public static function getInstance(){
        if (!self::$nd) {
            self::$socket = \NetData\SocketService::start([['host' => SOCKET_HOST, 'port' => SOCKET_PORT,]]);
            $nd  = \NetData\Instance::get();
            $nd->setProc(PROC_SOCKET_HOST);
            $nd->writeString(APP_ID);
            $nd->writeString(APP_KEY);
            self::$socket->send($nd);

            self::$nd = $nd;
        }
        return self::$nd;
    }
    public static function call($data){
        self::$socket->call($data);
        return $data;
    }

    public static function send($data){
        self::$socket->send($data);
    }
}

