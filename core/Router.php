<?php
namespace Core;

class Router {

  public static function route($url){

    // Controller
    $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) . 'Controller' : DEFAULT_CONTROLLER . 'Controller';
    $controller_Name = $controller;
    array_shift($url);

    // Action
    $action = (isset($url[0]) && $url[0] != '') ? strtolower($url[0]) . 'Action' : 'indexAction';
    $action_Name = (isset($url[0]) && $url[0] != '') ? strtolower($url[0]) : 'index';
    array_shift($url);

    // Params
    $queryParams = $url;
    $controller = 'App\Controllers\\' . $controller;
    $dispatch = new $controller($controller_Name, $action);

    if(method_exists($controller, $action)){
      call_user_func_array([$dispatch, $action], $queryParams);
      // H::dnd($dispatch);
    }else{
      die('That method does not exist in the controller \"' . $controller_Name . '\"');
    }

  }

  public static function redirect($location){
    if(!headers_sent()){
      header('Location: ' . PROOT . $location);
      exit();
    }else{
      // echo '<script type="text/javascript">';
      // echo 'window.location.href="'.PROOT.$location.'";';
      // echo '</script>';
      // echo '<noscript>';
      // echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
      // echo '</noscript>';exit;
      echo "Header sent from " . $location;
      exit();
    }
  }



}





?>