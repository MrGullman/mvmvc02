<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\H;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;
use Core\Validators\EmailValidator;


class Bookings extends Model {

  protected static $_table = 'bookings';
  protected static $_softDelete = true;

  public $id;
  public $created_at;
  public $updated_at;
  public $user_id;
  public $booking_nr; // length 20
  public $purpose; // length 150
  public $name; // length 100
  public $phone1; // length 50
  public $phone2; // length 50
  public $email; // length 150
  public $city; // length 150
  public $address; // length 255
  public $time;
  public $date;
  public $travle_supplement; // length 255
  public $outher;
  public $deleted = 0;

  const blacList = ['id', 'user_id', 'booking_nr', 'deleted']; // Cant update this fields

  public function onConstruct() {
    $this->get_columns();
  }

  public function beforeSave() {
    $this->timeStamps();
  }

  public function validator() {
    $requiredFields = ['purpose'=>'Purpose', 'name'=>'Name', 'phone1'=>'Primary Phone', 'email'=>'Email',
                      'city'=>'City', 'time'=>'Time', 'date'=>'Date'];
    foreach($requiredFields as $field => $msg){
      $this->runValidation(new RequiredValidator($this,['field'=>$field, 'msg'=>$msg . ' is required.']));
    }
    $this->runValidation(new MaxValidator($this,['field'=>'purpose', 'msg'=>'Must be less then 151 characters.', 'rule'=>150]));
    $this->runValidation(new MaxValidator($this,['field'=>'name', 'msg'=>'Must be less then 101 characters.', 'rule'=>100]));
    $this->runValidation(new MaxValidator($this,['field'=>'phone1', 'msg'=>'Must be less then 51 characters.', 'rule'=>50]));
    $this->runValidation(new MaxValidator($this,['field'=>'phone2', 'msg'=>'Must be less then 51 characters.', 'rule'=>50]));
    $this->runValidation(new EmailValidator($this,['field'=>'email', 'msg'=>'Must be a valid email.']));
    $this->runValidation(new MaxValidator($this,['field'=>'email', 'msg'=>'Must be less then 151 characters.', 'rule'=>150]));
    $this->runValidation(new MaxValidator($this,['field'=>'city', 'msg'=>'Must be less then 151 characters.', 'rule'=>150]));
    $this->runValidation(new MaxValidator($this,['field'=>'address', 'msg'=>'Must be less then 256 characters.', 'rule'=>255]));
    $this->runValidation(new MaxValidator($this,['field'=>'travle_supplement', 'msg'=>'Must be less then 256 characters.', 'rule'=>255]));
  }

  public static function findAllByUserId($user_id, $params=[]){
    $conditions = [
      'conditions' => 'user_id = ?',
      'bind' => [(int)$user_id]
    ];

    $conditions = array_merge($conditions, $params);
    return self::find($conditions);
  }

  public static function findByIdAndUserId($booking_id, $user_id, $params=[]){
    $conditions = [
      'conditions' => 'id = ? AND user_id = ?',
      'bind' => [(int)$booking_id, (int)$user_id]
    ];

    $conditions = array_merge($conditions, $params);
    return self::findFirst($conditions);
  }

  public static function findBookingByIdAndUserId($booking_id, $user_id, $params=[]){

    //Booking pdf file location

    $conditions = [
      'conditions' => 'id = ? AND user_id = ?',
      'bind' => [(int)$booking_id, (int)$user_id]
    ];

    $conditions = array_merge($conditions, $params);


    $result = self::findFirst($conditions);

    $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $user_id . DS;
    // H::dnd($location . $result->booking_nr);
    if(file_exists($location . $result->booking_nr . '.pdf')){
      // $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $user_id . DS . $result->booking_nr . '.pdf';
      $result->pdf = true;

      return $result;
    }

    return $result;


  }

  public function pdfExists($booking_nr, $user_id){

    $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $user_id . DS . $booking_nr . '.pdf';

    if(file_exists($location)){

      return true;
    }

    return false;

    // $conditions = [
    //   'conditions' => 'booking_nr = ? AND user_id = ?',
    //   'bind' => [$booking_nr, (int)$user_id]
    // ];

  }

  public function createBookingNr($user_id){
    $year = date('Y', time());
    $month = date('m',time());
    $nr = $this->getLastBookingNr($user_id)->booking_nr;
    $number = $this->setBookingNrLastDigit($nr);

    $newBookingNr = BOOKINGNR_START . $year . '-EV' . $month . "-" . $number;

    if($this->checkIfBookingNrExists($newBookingNr, $user_id)){
      return false;
    }
      return $newBookingNr;

  }

  public function checkIfBookingNrExists($booking_nr, $user_id){
    $conditions = [
      'conditions' => 'booking_nr = ? AND user_id = ?',
      'bind' => [$booking_nr, $user_id]
    ];

    return self::find($conditions);
  }

  public function getLastBookingNr($user_id){
    $conditions = [
      'conditions' => 'user_id = ?',
      'bind' => [(int)$user_id],
      'columns' => 'booking_nr',
      'order' => 'booking_nr DESC'
    ];

    return self::findFirst($conditions);
  }

  public function setBookingNrLastDigit($nr){
    $nr = explode('-', $nr);
    $lastDigit =  $nr[2]+1;
    array_pop($nr);

    if($lastDigit < 10){
      $lastDigit = "00" . $lastDigit;
    }elseif($lastDigit > 9 && $lastDigit < 100){
      $lastDigit = "0" . $lastDigit;
    }else{
      return (string)$lastDigit ;
    }

    return $lastDigit;
  }

  public function getBookingPdf($user_id){
    $conditions = [
      'conditions' => 'user_id = ?',
      'bind' => [$user_id]
    ];

    $results = self::find($conditions);
    H::dnd($results);
    $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $params->user_id . DS;
  }


}



?>