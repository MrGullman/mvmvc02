<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\H;
use Core\Validators\RequiredValidator;

class Sales extends Model {

  protected static $_table = 'sales';
  protected static $_softDelete = true;

  public $id, $created_at, $updated_At, $user_id, $booking_id, $price, $booking_date, $deleted = 0;

  public function beforeSave() {
    $this->timeStamps();
  }

  public static function getDailySales($range='last-28'){
    $today = date("Y-m-d");
    $range = str_replace("last-","",$range);
    $fromDate = date("Y-m-d", strtotime("-".$range." days"));
    $db = DB::getInstance();
    $sql = "SELECT DATE(booking_date) as booking_date, SUM(price) as price
      FROM `sales`
      WHERE deleted = 0 AND booking_date BETWEEN ? AND ?
      GROUP BY DATE(booking_date)";
    return $db->query($sql,[$fromDate,$today])->results();
    // H::dnd($today." 23:59:59");
  }
}

?>