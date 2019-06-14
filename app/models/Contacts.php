<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;
use Core\H;

class Contacts extends Model {

  protected static $_table = 'contacts';
  protected static $_softDelete = true;

  public $id;
  public $user_id;
  public $fname;
  public $lname;
  public $email;
  public $address;
  public $address2;
  public $city;
  public $postalcode;
  public $home_phone;
  public $cell_phone;
  public $work_phone;

  const blackListedFormKeys = ['id','deleted'];

  public function onConstruct() {
    $item = $this->get_columns();
    // H::dnd($item);
  }

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'fname', 'msg'=>'First Name is required.']));
    $this->runValidation(new MaxValidator($this,['field'=>'fname', 'msg'=>'First Name must be less then 156 characters.', 'rule'=>155]));
    $this->runValidation(new RequiredValidator($this,['field'=>'lname', 'msg'=>'Last Name is required.']));
    $this->runValidation(new MaxValidator($this,['field'=>'lname', 'msg'=>'Last Name must be less then 156 characters.', 'rule'=>155]));
  }

  public static function findAllByUserId($user_id, $params=[]) {
    $conditions = [
      'conditions' => 'user_id = ?',
      'bind' => [(int)$user_id]
    ];
    $conditions = array_merge($conditions, $params);
    return self::find($conditions);
  }

  public function displayName() {
    return $this->fname . ' ' . $this->lname;
  }

  public function displayAddress(){
    $address = '';
    if(!empty($this->address)){
      $address .= $this->address . '<br>';
    }
    if(!empty($this->address2)){
      $address .= $this->address2 . '<br>';
    }
    if(!empty($this->postalcode)){
      $address .= $this->postalcode . ' ';
    }
    if(!empty($this->city)){
      $address .= $this->city . '<br>';
    }
    return $address;
  }

  public function displayAddressLabel(){
    $html = $this->displayName() . '<br>';
    $html .= $this->displayAddress();

    return $html;
  }

  public static function findByIdAndUserId($contact_id, $user_id, $params=[]) {
    $conditions = [
      'conditions' => 'id = ? AND user_id = ?',
      'bind' => [$contact_id, $user_id]
    ];

    $conditions = array_merge($conditions, $params);
    return self::findFirst($conditions);
  }

}


?>