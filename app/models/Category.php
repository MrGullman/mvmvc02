<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\H;


class Category extends Model {

  protected static $_table = 'category';
  protected static $_softDelete = true;

  public $id;
  public $created_at;
  public $updated_at;
  public $name;
  public $deleted = 0;

  public function onConstruct() {
    $item = $this->get_columns();
    // H::dnd($item);
  }

  public function beforeSave() {
    $this->timeStamps();
  }

  public function validator() {

  }

  public static function getOptionsForForm(){


    $params = [
      'columns' => 'id, name',
      'order' => 'name'
    ];

    // $conditions = array_merge($conditions, $params);

    $options = self::find($params);

    // H::dnd($options);
    $optionsAry = [''=>'-Select Category-'];
    // $optionsAry = [];

    foreach($options as $option){
      $optionsAry[$option->id] = $option->name;
    }
    // H::dnd($optionsAry);
    return $optionsAry;
  }

}



?>