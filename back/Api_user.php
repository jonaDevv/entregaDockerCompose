<?php

// Añadir encabezados CORS para permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *"); // Permitir cualquier origen
header("Access-Control-Allow-Methods: GET, POST"); // Permitir métodos GET y POST
header("Access-Control-Allow-Headers: Content-Type"); // Permitir cabeceras como Content-Type

require_once "Usuario.php";


// Configurar encabezados
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
             // Recuperar datos (por ejemplo, obtener todos los usuarios)
             $users = usuario::getUsers();
             echo json_encode(["success" => true, "user" => $users]);
             break;

        case 'POST':
                // Leer el cuerpo de la solicitud
                $data = json_decode(file_get_contents('php://input'));
            
                // Validar datos
                if (!isset($data->nombre, $data->apellido, $data->oficio)) {
                    http_response_code(400);
                    echo json_encode(["error" => "Faltan datos obligatorios"]);
                    exit;
                }
            
                // Validaciones adicionales
                if (empty($data->nombre) || empty($data->apellido) || empty($data->oficio)) {
                    http_response_code(400);
                    echo json_encode(["error" => "Los campos no pueden estar vacíos"]);
                    exit;
                }
            
                // Crear un nuevo usuario
                $newUser = Usuario::addUser($data->nombre, $data->apellido, $data->oficio);
            
                if ($newUser) {
                    echo json_encode(["message" => "Usuario creado", "user" => $newUser]);
                } else {
                    http_response_code(500);
                    echo json_encode(["error" => "No se pudo crear el usuario"]);
                }
                break;
            
    }
} catch (Exception $e) {
    // Manejo de errores
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
