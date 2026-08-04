<?php
abstract class Db{
    private static $db;
    public static function getConnection(){
        if(self::$db){
            return self::$db;
        } else {
             self::$db = new PDO("mysql:host=ID483654_xdcurrency.db.webhosting.be; dbname=ID483654_xdcurrency", "ID483654_xdcurrency", "XDCurrency1209");
        return self::$db;
        }
       
    }
}