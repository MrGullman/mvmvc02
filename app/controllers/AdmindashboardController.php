<?php
namespace App\Controllers;
use Core\Controller;
use Core\H;
use App\Lib\Utilities\CreatePdf;
use App\Lib\Utilities\Mailer;
use App\Models\Paginate;
use App\Models\Sales;

class AdmindashboardController extends Controller {

  public function __construct($controller, $action) {
    parent::__construct($controller, $action);
    $this->view->setLayout('admin');
  }

  public function indexAction($currentPage=1) {
    // $paginate = new Paginate('contacts', 1, $currentPage);
    // $value = $paginate->getData((int)$currentPage);
    // $links = $paginate->createPaginationLinks(2, 'pagination')

    $pdf = new CreatePdf();

    // $mail = new Mailer();
    // $mailParams = [
    //   'mail_Address' => 'jesper.gullman@outlook.com',
    //   'mail_AddressName' => 'Jesper Gullman',
    //   'mail_Subject' => 'Test Mail Class',
    //   'mail_Body' => 'Detta är bara en liten test för att se så allt fungerar som det ska'
    // ];

    // $this->view->posts = $value;
    // $this->view->links = $links;
    $this->view->render('admindashboard/index');
  }

  public function getStatsAction(){
    $range = $this->request->get('range');
    $sales = Sales::getDailySales($range);
    $labels = [];
    $data = [];
    foreach($sales as $tx){
      $labels[] = $tx->booking_date;
      $data[] = $tx->price;
    }

    $resp = ['data'=>$data, 'labels'=>$labels];

    $this->jsonResponse($resp);

  }
}

?>