<?php

    $db = new Database();
    $db->start();
    $db->createDatabase();
    $db->stop();
    
?>