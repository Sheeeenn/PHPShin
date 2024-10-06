<?php

class createTable {

    public static function id(){
        $TName = self::getName();
        $db = new Database();
        $db->start();
        $db->createTable($TName);
        $db->stop();
    }

    public static function string($Cname, $Lnumber = 255, $not_null = false, $unique = false){

        $TName = self::getName();
        $Ttype = "v";
        $db = new Database();

        //Extras start with variable length.
        $ext = "($Lnumber)";

        //If Not Null is specified.
        if($not_null) {
            $ext .= " NOT NULL"; //Add Not Null into SQL
        }

        //If Unique is specified.
        if($unique) {
            $ext .= " UNIQUE"; //Add Unique into SQL
        }

        $db->start();
        $db->createCol($Ttype, $TName, $Cname, $ext);
        $db->stop();
        
    }

    public static function integer($Cname, $primary = false, $not_null = false, $unique = false, $auto_increment = false, $unsigned = false, $default = ""){

        $TName = self::getName();
        $Ttype = "i";
        $db = new Database();

         //Create EXT SQLextras / contraints / attributes;
         $ext = "";

        //If Primary is specified.
        if($primary) {
            $ext .= " PRIMARY KEY"; //Add Primary into SQL
        }

        //If Not Null is specified.
        if($not_null) {
            $ext .= " NOT NULL"; //Add Not Null into SQL
        }

        //If Unique is specified.
        if($unique) {
            $ext .= " UNIQUE"; //Add Unique into SQL
        }

        //If Auto Increment is specified.
        if($auto_increment) {
            $ext .= " AUTO_INCREMENT"; //Add Auto Increment into SQL
        }

        //If Auto Increment is specified.
        if($unsigned) {
            $ext .= " UNSIGNED"; //Add Auto Increment into SQL
        }

        //If Default is specified.
        if(is_numeric($default) && $default !== "") {
            $ext .= " DEFAULT $default"; //Add Default Value into SQL
        }

        $db->start();
        $db->createCol($Ttype, $TName, $Cname, $ext);
        $db->stop();
        
    }

    /*public static function default($def){
        
    }*/

    public static function getName(){

        $prev = debug_backtrace(); // Go to previous path
        $Fname = $prev[2]['function']; // Get the function name
        return $Fname;
    }
}

?>