<?php

require("Controller/database/table.php");
require("Controller/migrations/migrate.php");

/* 
    This file allows you to create and customize your tables. 
    Once you have created a table, ensure that you migrate it in the "Controller > migrations" directory.
*/

function json () {
    $test = ["Sheen" => 2, "Sheen2" => 22, "Sheen3" => 222];
    return json_encode($test);
}

function Account () {

    createTable::id(); //This code is required for every table that you'll create.
    createTable::string("name", 255);
    createTable::string("name8", 119, unique: true);
    //createTable::int("age");
}

?>