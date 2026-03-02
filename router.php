<?php

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = require("routes.php");

foreach ($routes as $controller) {
    require_once "controllers/" . explode("@", $controller)[0] . ".php";
}

if (array_key_exists($uri, $routes)) {
    [$controller, $method] = explode('@', $routes[$uri]);
    $instance = new $controller();

    // determine parameters to pass to controller method
    $params = [];
    // if an id is provided via GET or POST, forward it as first argument
    if (isset($_GET['id'])) {
        $params[] = $_GET['id'];
    } elseif (isset($_POST['id'])) {
        $params[] = $_POST['id'];
    }

    // call controller method with any gathered parameters
    $instance->$method(...$params);
} else {
    http_response_code(404);
    echo "Lapa nav atrasta!";
    exit();
}