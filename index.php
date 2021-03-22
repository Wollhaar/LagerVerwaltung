<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");
$paths = array(
    'class',
    'lib',
    'module'
);

set_include_path(implode(PATH_SEPARATOR, $paths));
spl_autoload_extensions(
    '.php'
);
spl_autoload_register();

session::get();
$path = array_filter(explode('/', parse_url(isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '', PHP_URL_PATH)));
if (!isset($path[0])) response::send(array("result" => "Methode fehlt"), 400);
$class = $path[0];
$function = $path[1];
$method = strtolower($_SERVER['REQUEST_METHOD']);
unset($path[0]);
unset($path[1]);
$path[] = file_get_contents('php://input', true);
if (is_file('controller/' . $method . '/' . $class . '.php')) {
    include 'controller/' . $method . '/' . $class . '.php';
    if (method_exists($class, $function)) {
        response::send($class::$function(...$path));
    } else {
        response::send(array("result" => "Function existiert nicht"), 400);
    }
} else {
    response::send(array("result" => "Methode existiert nicht"), 400);
}