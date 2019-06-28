<?php
namespace App\Lib\Utilities;

class ErrorRedirect {

  public static function redirect_404(){
    header("HTTP/1.0 404 Not Found");
    include ROOT . DS . "error" . DS . "404.php";
    die();
  }

  public static function redirect_500(){

  }

}
