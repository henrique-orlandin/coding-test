<?php
define('DS', DIRECTORY_SEPARATOR);
define('APPPATH', '../application/');
define('APPROOT', '../');
define('BASEPATH', '../');

function show_404(){
    $lang = isset($_SESSION['user_lang']) ? $_SESSION['user_lang'] : 'pt-br';
    include(APPPATH . 'errors/error_404.php');
}

include('image.php');

$params = $_GET;

if(preg_match('/restrito/', $params['src'])) {
    session_start();
    if(!isset($_SESSION['restrict_session'])) {
        header("HTTP/1.1 401 Unauthorized");
        exit;
        die();
    }
}

if(isset($_SERVER['PATH_INFO']))
    $method = trim($_SERVER['PATH_INFO'], '/');
else if(isset($_SERVER['ORIG_PATH_INFO']))
    $method = trim($_SERVER['ORIG_PATH_INFO'], '/');
else {
    $method = trim($_SERVER['QUERY_STRING'], '/');
    parse_str(str_replace($_SERVER['REDIRECT_URL'].'?', '', $_SERVER['REQUEST_URI']), $params);
}

$newParams = array();
$explode = explode('/', $method);
$method = end($explode);
foreach ($params as $key => $each_param){
    if (preg_match('/image\//i', $key))
        $key = substr($key, -1);
    $newParams[$key] = $each_param;
}
$params = $newParams;

$image = new Image();
if (method_exists($image, $method))
{
    $image->{$method}($params);
}else{
    show_404();
}