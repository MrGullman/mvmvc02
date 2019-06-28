<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\H;
use \stdClass;
use Core\Router;
use App\Lib\Utilities\ErrorRedirect;
use function App\Lib\Utilities\redirect_404;

class Paginate extends Model {

  protected static $_table = '';

  private $_limit;
  private $_currentPage;
  private $_query;
  private $_total;

  /**
   * Pagination Constructor
   *
   * @param string $table tabel to be used
   * @param integer $limit number of items of page
   */
  public function __construct($table, $limit) {
    self::$_table = $table;
    $this->_limit = $limit;
    $this->_modelName = str_replace(' ', '', ucwords(str_replace('_',' ', static::$_table)));
    $this->get_columns();
  }

  /**
   * Pagination GetData
   *
   * @method getData
   * @param integer $currentPage Current page
   * @return array
   */
  public function getData($currentPage = 1) {
    $db = DB::getInstance();
    $table = self::$_table;
    $total = $this->_getTotal();
    $this->_currentPage = $currentPage;
    if($this->_limit == 'all'){
      $response = $db->find($table);
      // $sql = "SELECT * FROM $table";
    }else{
      $conditions = [
        'limit' => (($currentPage - 1) * $this->_limit) . ", $this->_limit"
      ];
      $response = $db->find($table,$conditions);
    }

    if(empty($response)){
      ErrorRedirect::redirect_404();
    }

    foreach($response as $value){
      $results[] = $value;
    }

    $result = new stdClass();
    $result->page = $currentPage;
    $result->limit = $this->_limit;
    $result->total = $total;
    $result->data = $results;

    return $result;

  }

  /**
   * Create Pagination Links
   *
   * @method createPaginationLinks
   * @param integer $links  number of links
   * @param string $list_class ul class name
   * @return string
   */
  public function createPaginationLinks($links, $list_class) {
    $db = DB::getInstance();
    $table = self::$_table;
    $total = $this->_getTotal();

    if($this->_limit == 'all'){
      return '';
    }

    $last = ceil($total / $this->_limit);

    $start = (($this->_currentPage - $links) > 0) ? $this->_currentPage - $links : 1;
    $end = (($this->_currentPage + $links) < $last) ? $this->_currentPage + $links : $last;
    // H::dnd($end);
    $html = '<ul class="' . $list_class . ' justify-content-center">';

    $class      = ( $this->_currentPage == 1 ) ? "disabled" : "";

    $html       .= '<li class="page-item ' . $class . '"><a href="' . ( $this->_currentPage - 1 ) . '" class="page-link">&laquo;</a></li>';

    if($start > 1 ){
      $html .= '<li><a href="1" class="page-link">1</a></li>';
      $html .= '<li class="disabled"><span></span></li>';
    }

    for($i = $start; $i <= $end; $i++){
      $class = ($this->_currentPage == $i) ? 'active' : '';
      $html .= '<li class="page-item ' . $class . '"><a href="' . $i . '" class="page-link">' . $i . '</a></li>';
    }

    if($end < $last){
      $html .= '<li class="disabled"><span></span></li>';
      $html .= '<li><a href="' . $last . '" class="page-link">' . $last . '</a></li>';
    }

    $class = ($this->_currentPage == $last) ? 'disabled' : '';
    $html .= '<li class="page-item ' . $class . '"><a href="' . ($this->_currentPage + 1) . '" class="page-link">&raquo;</a></li>';

    $html .= '</ul>';

    return $html;
  }


  private function _getTotal(){
    $table = self::$_table;
    $sql = "SELECT * FROM $table";
    $db = DB::getInstance();

    return $db->query($sql)->count();

  }


}



?>