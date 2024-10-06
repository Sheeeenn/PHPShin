<?php

require("Controller/database/table.php");
require_once("Controller/migrations/migrate.php");

/* 
    This file allows you to create and customize your tables. 
    Once you have created a table, ensure that you migrate it in the "Controller > migrations" directory.
*/

function Account () {
    createTable::id(); //This code is required for every table that you'll create.
    createTable::string("name", 255);
    createTable::integer("age", not_null: true, default: 20);
}

?>