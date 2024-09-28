<?php 

class path {

    public static $uri;

    public static function request ($paths) {

        $uri = parse_url($_SERVER['REQUEST_URI'])["path"];

        foreach ($paths as $path) {

           if ($uri == $path['path']) {
                require 'View/' . $path['name'] . '.php';
                return;
            }   

        }

        require 'View/error.php';

    }
}

?>