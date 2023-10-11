<?php

class RegistroController {
    public $view = "registro";
    public $page_title = "Nuevo registro"; 


    public function index() {
        // La acción por defecto muestra el formulario de registro.
        return array();
    }

    public function registrar() {
        // Procesar el registro de un nuevo usuario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $clave = $_POST["clave"];
            
            // Validar los campos (por ejemplo, longitud mínima de la clave)
            if (strlen($nombre) < 3 || strlen($clave) < 6) {
                return array("error" => "Campos inválidos");
            }
            
            // Hash de la contraseña (debes mejorar la seguridad con sal y almacenamiento seguro de contraseñas)
            $hashClave = password_hash($clave, PASSWORD_DEFAULT);
            
            // Insertar el nuevo usuario en la base de datos (ejemplo de función)
            $registroExitoso = insertarUsuario($nombre, $hashClave);
            
            if ($registroExitoso) {
                return array("exito" => "Registro exitoso");
            } else {
                return array("error" => "Error en el registro");
            }
        }
        
        return array();
    }
}

function insertarUsuario($nombre, $clave) {
    $db_host = "localhost";
    $db_nombre = "mvc_example";
    $db_usuario = "root";
    $db_contrasena = "";

    $conexion = new mysqli($db_host, $db_usuario, $db_contrasena, $db_nombre);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO usuario (usu_nombre, usu_clave) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombre, $clave);

    if ($stmt->execute()) {
        $stmt->close();
        $conexion->close();
        return true; // Registro exitoso
    } else {
        $stmt->close();
        $conexion->close();
        return false; // Error en el registro
    }
}
