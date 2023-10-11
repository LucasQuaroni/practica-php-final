<?php

require_once 'config/config.php';
require_once 'model/db.php';

if (!isset($_GET["controller"])) {
    include 'view/inicio.php'; // Muestra la página de inicio por defecto
} else {
    $controllerName = ucfirst($_GET["controller"]) . 'Controller'; // Convertir la primera letra a mayúscula

    $controller_path = 'controller/' . $controllerName . '.php';

    /* Check if controller exists */
    if (!file_exists($controller_path))
        $controller_path = 'controller/' . constant("DEFAULT_CONTROLLER") . '.php';

    /* Load controller */
    require_once $controller_path;
    $controller = new $controllerName();

    /* Check if method is defined */
    $dataToView["data"] = array();
    if (method_exists($controller, $_GET["action"]))
        $dataToView["data"] = $controller->{$_GET["action"]}();

    /* Load views */
    require_once 'view/template/header.php';
    require_once 'view/' . $controller->view . '.php';
    require_once 'view/template/footer.php';
}
?>