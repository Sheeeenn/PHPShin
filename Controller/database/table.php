<?php

class createTable {

    public static function id(){
        $TName = self::getName();
        $db = new Database();
        $db->start();
        $db->createTable($TName);
        $db->stop();
    }

    public static function getName(){

        $prev = debug_backtrace(); // Go to previous path
        $Fname = $prev[2]['function']; // Get the function name
        return $Fname;
    }
}

?>