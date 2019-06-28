<?php
namespace App\Models;
use Core\{Model,DB,H};
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;
use Models\Category;

class Posts extends Model {

  protected static $_table = 'posts';
  protected static $_softDelete = true;

  public $id;
  public $created_at;
  public $updated_at;
  public $user_id;
  public $category_id;
  public $title;
  public $post;
  public $tags;
  public $deleted = 0;

  const blackList = ['id','user_id', 'deleted']; // cant update this fields



  public function onConstruct() {
    $item = $this->get_columns();
    // H::dnd($item);
  }

  public function beforeSave() {
    $this->timeStamps();
  }

  public function validator() {
    $requiredFields = ['title'=>'Title', 'post'=>'Post', 'category_id'=>'Category'];
    foreach($requiredFields as $field => $display){
      $this->runValidation(new RequiredValidator($this,['field'=>$field, 'msg'=>$display . ' is required.']));
    }
    // $this->runValidation(new RequiredValidator($this,['field'=>'title', 'msg'=>'Title is required.']));
    $this->runValidation(new MaxValidator($this,['field'=>'title', 'msg'=>'Must be less then 156 characters', 'rule'=>155]));

  }

  public static function findAllByUserId($user_id, $params=[]) {
    $conditions = [
      'conditions' => 'user_id = ?',
      'bind' => [(int)$user_id],
      'order' => 'created_at DESC'
    ];

    $conditions = array_merge($conditions, $params);
    return self::find($conditions);
  }

  public static function findByIdAndUserId($post_id, $user_id, $params=[]) {

    $conditions = [
      'conditions' => 'id = ? AND user_id = ?',
      'bind' => [(int)$post_id, (int)$user_id]
    ];

    $conditions = array_merge($conditions, $params);
    return self::findFirst($conditions);
  }

  public function showDate() {
    $date = date_create($this->created_at);
    return date_format($date, 'Y-m-d');
  }
}


?>