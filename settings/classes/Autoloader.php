<?php

class Autoloader{

    /**
    * Enregistrement de notre autoloader
    */
    static function register(){
        spl_autoload_register(function($class) {
            require 'settings/classes/' . $class . '.php';
        });
    }

}