<?php
namespace Core;

/**
 * Parent class for app Model
 */
class Model {

  protected $_modelName;
  protected $_validates = true;
  protected $_validationErrors = [];
  protected $_db;
  protected $_table;
  protected $_softDelete = true;
  public $id;

  public function __construct(){
    $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', static::$_table)));
    $this->onConstruct();
  }


  /**
   * Runs when the object is constructed
   * @method onConstruct
   */
  public function onConstruct(){}

}



?>