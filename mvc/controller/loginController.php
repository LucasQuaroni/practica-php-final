<?php

class LoginController {
    public $view = "login";
    public $page_title = "Inicio de sesión"; 

    public function index() {
        // La acción por defecto muestra el formulario de inicio de sesión.
        return array();
    }

    public function iniciarSesion() {
        // Procesar el inicio de sesión
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $clave = $_POST["clave"];
            
            // Obtener la información del usuario desde la base de datos (ejemplo de función)
            $usuario = obtenerUsuarioPorNombre($nombre);
            
            if ($usuario && password_verify($clave, $usuario["usu_clave"])) {
                // Inicio de sesión exitoso
                // Puedes almacenar información de sesión aquí
                // Redirigir al área personal del usuario (cambia la URL de redirección según tu estructura)
                header("Location: /area-personal.php");
                exit();
            } else {
                return array("error" => "Credenciales incorrectas");
            }
        }
        
        return array();
    }
}

function obtenerUsuarioPorNombre($nombre) {
    $db_host = "localhost";
    $db_nombre = "mvc_example";
    $db_usuario = "root";
    $db_contrasena = "";

    $conexion = new mysqli($db_host, $db_usuario, $db_contrasena, $db_nombre);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuario WHERE usu_nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre);

    if ($stmt->execute()) {
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conexion->close();

        if ($resultado) {
            return $resultado; // Retorna un array con los datos del usuario
        } else {
            return null; // El usuario no se encontró
        }
    } else {
        $stmt->close();
        $conexion->close();
        return null; // Error al buscar al usuario
    }
}
