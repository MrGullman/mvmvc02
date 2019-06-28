<?php
namespace App\Lib\Utilities;
use Core\Model;
use Core\H;
use Core\Validators\RequiredValidator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer extends Model{

  // This values are set in the configuration file
  private $_smtpAddress = SMTP_ADDRESS;
  private $_smtpPort = SMTP_PORT;
  private $_smtpEncryption = SMTP_ENCRYPTION;
  private $_userName = MAIL_USERNAME;
  private $_password = MAIL_PASSWORD;

  private $_errors = [];
  private $_formValues = [];
  private $_addAddressName = '';
  private $_mailContent;

  private $_mail;

  public $email;
  public $subject;
  public $body;

  public function __construct() {
    require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');
    // $this->_formValues = $formValues;
    $this->_mail = new PHPMailer();
  }

  public function runMailValidation($params=[]) {
    $this->_required();
  }

  public function validates() {
    return (empty($this->_errors)) ? true : $this->_errors;
  }

  protected function _required() {
    foreach($this->_formValues as $key => $val){
      if($val == ''){
        $name = $key;
        $msg = "This Field is required.";
        $this->addErrMessage($name, $msg);
      }
    }
  }

  protected function addErrMessage($name, $message){
    if(array_key_exists($name,$this->_errors)){
      $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
    }else{
      $this->_errors[$name] = $message;
    }
  }

  public function getErrMessage(){
    return $this->_errors;
  }

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'email', 'msg'=>'You need to set a contact mail.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'subject', 'msg'=>'You need a subject.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'body', 'msg'=>'You need to tell us what this is about.']));
  }

  private function sendMail($params=[]) {

    try {
      //Server settings
      $this->_mail->SMTPDebug = 0;                         // Set it to 2 to Enable verbose debug output
      $this->_mail->isSMTP();                              // Set mailer to use SMTP
      $this->_mail->Host       = SMTP_ADDRESS;             // Specify main and backup SMTP servers
      $this->_mail->SMTPAuth   = SMTP_AUTH;                // Enable SMTP authentication
      $this->_mail->Username   = MAIL_USERNAME;            // SMTP username
      $this->_mail->Password   = MAIL_PASSWORD;            // SMTP password
      $this->_mail->SMTPSecure = SMTP_ENCRYPTION;          // Enable TLS encryption, `ssl` also accepted
      $this->_mail->Port       = SMTP_PORT;                // TCP port to connect to

      //Recipients
      $this->_mail->setFrom('jesper.gullman@gmail.com', 'Förfrågan');
      $this->_mail->addAddress(MAIL_USERNAME, $this->_addAddressName);     // Add a recipient
      // $this->_mail->addAddress('ellen@example.com');               // Name is optional
      // $this->_mail->addReplyTo('info@example.com', 'Information');
      // $this->_mail->addCC('cc@example.com');
      // $this->_mail->addBCC('bcc@example.com');

      // Attachments
      // $this->_mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $this->_mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      // Content
      $this->_mail->isHTML(true);                                  // Set email format to HTML
      $this->_mail->Subject = $this->subject;
      $this->_mail->Body    = $this->_mailContent;
      // $this->_mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $this->_mail->send();

      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$this->_mail->ErrorInfo}";
      }

  }

  public function mail($params=[]) {
    H::dnd($params);
  }

  public function contactMail(){

    $html = "";

    $html .= "<h3>Förfrågan</h3>";
    $html .= "<hr>";
    $html .= "<b>From: </b>" . $this->email . "<br>";
    $html .= "<b>Subject: </b>" . $this->subject . "<br>";
    $html .= "<hr>";
    $html .= "<b>Body:</b><br>" . $this->body;

    $this->subject = "Förfrågan ".$this->subject."";
    $this->_mailContent = $html;
    if($this->sendMail()){
      return true;
    }else{
      return false;
    }

  }

}




?>