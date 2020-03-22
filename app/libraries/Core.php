<?php
    /*mapear url ingresada en el navegador
    1 controlador - 2 metodo (funcion) 3 parametro
    ejemplo /articulo/actualizar/4
    */

class Core {
    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    //constructor 
    public function __construct(){
        //print_r($this->getUrl());
        $url = $this->getUrl();

        //buscar en controladores si existe el controlador 
        if ($url) {
            if(file_exists('../app/controladores/'.ucwords($url[0]) .'.php')){
                //(si existe se configura como controlador por defecto)
                $this->controladorActual = ucwords($url[0]);
                //unset controlador
                unset($url[0]);
            }
        }
    
            //requerir el nuevo controlador
        require_once '../app/controladores/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;
        

        //ahora analizamos el metodo
        if (isset($url[1])){
            if(method_exists($this->controladorActual, $url[1])){
                //chequeamos el metodo
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }

        //echo $this->metodoActual;
        
        //ahora parametros
        $this->parametros = $url ? array_values($url) : [];

        //llamar callback con parametros array

        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }


    public function getUrl(){
        //echo $_GET['url'];

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
    }
}


