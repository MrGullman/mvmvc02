<?php
namespace App\Controllers;
use Core\Controller;
use Core\H;


class ErrorController extends Controller {

  public $error;

  public function onConstruct(){
    $this->view->setLayout('error');
  }

  public function indexAction($error) {
    $this->error = (int)$error;

    if($this->error == 404){

    }
    // H::dnd($this->error);
    $this->view->errorCode = $this->error;
    $this->view->render('error/index');
  }

  public function show404Action() {
    $this->view->render('error/404');
  }

}

?>