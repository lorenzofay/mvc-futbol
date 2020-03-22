<?php

    class Paginas extends Controller{
        private $articuloModelo;

        public function __construct(){
            $this->articuloModelo = $this->modelo('Articulo');
            
            //echo 'controlador paginas cargado';
        }

        public function index(){            
            $articulos = $this->articuloModelo->obtenerArticulos();

            $datos = [ 'titulo' => 'primer sistema de Lorenzo','articulos' => $articulos ];
            $this->vista ('pages/home', $datos);
        }

        public function articulo($numparametro){
            echo $numparametro;
        }
    
        public function tuvieja(){
            $this->vista ('pages/home', $datos);
        }

    
    
    }