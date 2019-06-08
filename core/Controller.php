<?php
namespace Core;
use Core\Application;

class Controller extends Application {

  protected $_controller;
  protected $_action;
  public $view;
  public $request;

  public function __construct($controller, $action){
    $this->_controller = $controller;
    $this->_action = $action;
    $this->view = new View();
    $this->onConstruct();
    // H::dnd($controller);
  }

  /**
   * Called when a Controller object is constructed
   *
   * @method onConstruct
   */
  public function onConstruct(){}

  /**
   * Used for a JSON response
   *
   * @method jsonResponse
   * @param array
   * @return array assosiative array that gets JSON encoded
   */
  public function jsonResponse($resp){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    http_response_code(200);
    echo json_encode($resp);
    exit;
  }
}




?>