<?php

function getConnection(): PDO
{
    $con = null;
    $host = "db"; // nombre de contenedor
    $db = "databaseTarea";
    $user = "root";
    $pass = "root";

    if ($con === null) {
        try {
            $con = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }

    return $con;
}



class Usuario
{
    
    public $nombre;
    public $apellido;
    public $oficio; // Asegúrate de definir esta propiedad en la clase

    public function __construct( $nombre, $apellido, $oficio)
    {
        
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->oficio = $oficio;
    }
    
       
        



   

    



    public static function addUser($nombre, $apellido, $oficio){
        try{
            $conn = getConnection();
            $sql = "INSERT INTO usuario (nombre, apellido, oficio) VALUES (:nombre, :apellido, :oficio)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['nombre' => $nombre, 'apellido' => $apellido, 'oficio' => $oficio]);
            header("Content-Type: application/json");
    
            return json_encode(["status" => "Creado"]);



          
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Error en la base de datos');
            echo json_encode(["error" => $e->getMessage()]);
            exit;
        }
    }



    public static function getUsers(){
    
        try{
                $conn = getConnection();
                $sql = "SELECT * FROM usuario"; // Cambiado "animales" a "animal"
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            

                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $usuario = new Usuario(
                      $row->nombre, 
                                           $row->apellido, 
                                           $row->oficio);

                  
                    $usuarioArray[] = $usuario->toJson();
                }
    
    
            
                header("Content-Type: application/json");
                return json_encode($usuarioArray);
            
        } catch (PDOException $e) {
                header('HTTP/1.1 500 Error en la base de datos');
                echo json_encode(["error" => $e->getMessage()]);
                exit;
        }
        }

      public function toJson() {
        return get_object_vars($this); // Convierte todas las propiedades públicas en un array
    }




}














?>