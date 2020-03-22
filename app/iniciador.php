<?php
    //cargamos libreries
    require_once 'config/configurar.php';

    /*
    require_once 'libraries/Database.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Core.php';
    */

    //AUTOLOAD

    spl_autoload_register(function($nombreClase){
        require_once 'libraries/' . $nombreClase . '.php';
    });
    
    ?>


