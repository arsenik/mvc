<?php 

require_once '../config/config.php';

function __autoload($class)
{
    require_once(realpath(dirname(__FILE__)).'/../lib/'.$class.'.php');    
}


$request = new myRequest();
$module = $request->getGetParameter('module', 'home');    
$action = $request->getGetParameter('action', 'index');

if(!file_exists(MY_ROOT_DIR.'modules/'.$module.'/controller.php'))
{
  die('this module does not exist');
}

require MY_ROOT_DIR.'modules/'.$module.'/controller.php';
$class = $module.'Controller';
$controller = new $class;     

if(!method_exists($controller, $action)) {
  die('this action does not exist');
}

$controller->$action();