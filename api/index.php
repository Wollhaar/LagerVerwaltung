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
$path = array_filter(explode('/', parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['PATH_INFO'] : '', PHP_URL_PATH)));
if (!isset($path[1])) response::send(array("result" => "Methode fehlt"), 400);

$class = $path[1];
$function = $path[2];
$method = strtolower($_SERVER['REQUEST_METHOD']);

unset($path);
parse_str(file_get_contents('php://input', true), $path);

if (!empty($path['data']))
    $path = array_merge($_GET, $path['data']);
else {
    $path = array($_GET);
}
if (is_file('module/' . $class . '.php')) {
    include 'module/' . $class . '.php';
    if (method_exists($class, $function)) {
        response::send($class::$function(...$path));
    } else {
        response::send(array("result" => "Function existiert nicht"), 400);
    }
} else {
    response::send(array("result" => "Methode existiert nicht"), 400);
}