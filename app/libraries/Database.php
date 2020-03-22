<?php
    //clase para conectarse a la database y ejecutar consultas pdo

    class Database{
        private $host = DB_HOST;
        private $usuario = DB_USUARIO;
        private $password = DB_PASSWORD;
        private $database = DB_NOMBRE;
    
        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            //configurar conecxion
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
            $opciones = array(
                PDO::ATTR_PERSISTENT =>TRUE,
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION);
            
            //CREAR UNA INSTANCIA DE PDO
        
            try {
                $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);

               // $this->dbh->exec('set names utf-8');
            }
            
            catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }
//VINCULAMOS LA CONSULTA CON BIND
        public function bind($parametro, $valor, $tipo = null){
            if (is_null($tipo)){
                switch (true){
                    case is_int($valor):
                        $tipo = PDO::PARAM_INT;
                    break;
                    case is_bool($valor):
                        $tipo = PDO::PARAM_BOOL;
                    break;
                    case is_null($valor):
                        $tipo = PDO::PARAM_NULL;
                    break;
                    default:
                    $tipo = PDO::PARAM_STR;
                    break;
                }
            }
            $this->stmt->bindValue($parametro, $valor, $tipo);
        }
//EJECUTA LA CONSULTA
        public function execute(){
            return $this->stmt->execute();
        }
//OBTENER LOS REGISTROS
        public function registros(){
            $this->execute();
            return $this->stmt->fetchALL(PDO::FETCH_OBJ);
        }
//OBTENER REGISTRO
        public function registro(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

//OBTENER CANTIDAD DE PARAMETROS CON ROWCOUNT
        public function rowCount(){
            return $this->stmt->rowCount();
}

    }
