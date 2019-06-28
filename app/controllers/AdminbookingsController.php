<?php
namespace App\Controllers;
use Core\Controller;
use App\Lib\Utilities\CreatePdf;
use Core\H;
use App\Models\Users;
use App\Models\Bookings;
use Core\Session;
use Core\Router;

class AdminbookingsController extends Controller {

  public function onConstruct() {
    $this->view->setLayout('admin');
    $this->currentUser = Users::currentUser();
  }

  public function indexAction(){
    $bookings = Bookings::findAllByUserId($this->currentUser->id);

    $this->view->bookings = $bookings;
    $this->view->render('adminbookings/index');
  }

  public function addAction(){
    $booking = new Bookings();

    if($this->request->isPost()){
      $booking->assign($this->request->get(), Bookings::blacList);
      $booking->user_id = $this->currentUser->id;
      $booking->booking_nr = $booking->createBookingNr($this->currentUser->id);
      $booking->save();
      if($booking->validationPassed()){
        Session::addMsg('success', 'Booking added.');
        Router::redirect('adminbookings/index');
      }
      // H::dnd($this->request->get());
      // H::dnd($booking->user_id);
    }


    $this->view->displayErrors = $booking->getErrorMessages();
    $this->view->booking = $booking;
    $this->view->formAction = PROOT . 'adminbookings/add';
    $this->view->render('adminbookings/add');
  }

  public function editAction($id){
    $editBooking = Bookings::findByIdAndUserId((int)$id, Users::currentUser()->id);
    if(!$editBooking) {
      Session::addMsg('danger', 'You dont have permission to edit this booking!');
      Router::redirect('adminbookings/index');
    }

    if($this->request->isPost()){
      $this->request->csrfCheck();
      $editBooking->assign($this->request->get(), Bookings::blacList);
      $editBooking->save();
      if($editBooking->validationPassed()){

        Session::addMsg('success', 'Booking Updated.');
        Router::redirect('adminbookings/index');
      }
    }


    $this->view->displayErrors = $editBooking->getErrorMessages();
    $this->view->booking = $editBooking;
    $this->view->formAction = PROOT . 'adminbookings' . DS . 'edit' . DS . $editBooking->id;
    $this->view->render('adminbookings/edit');
  }

  public function detailsAction($id){
    $booking = Bookings::findBookingByIdAndUserId((int)$id, Users::currentUser()->id);

    if(!$booking){
      Router::redirect('adminbookings/index');
    }

    $this->view->booking = $booking;
    $this->view->render('adminbookings/details');
  }


  public function createPdfAction(){
    $response = ['success'=>false, 'msg'=>'Something went wrong'];
    $bookingPdf = new CreatePdf();

    if($this->request->isPost()){
      $id = $this->request->get('id');
      $booking = Bookings::findByIdAndUserId((int)$id, Users::currentUser()->id);
      $bookingPdf->createBookingPdf($booking);
      // Create what is happening when the PDF is being created.
      $response = ['success'=>true, 'msg'=>'PDF created for '.$booking->booking_nr.'.', 'booking_id'=>$id];
    }


    $this->jsonResponse($response);
  }


  public function deleteAction(){
    $response = ['success'=>false, 'msg'=>'Something went wrong!'];

    if($this->request->isPost()){
      $id = $this->request->get('id');
      $booking = Bookings::findByIdAndUserId((int)$id, Users::currentUser()->id);

      if($booking){
        $booking->delete();
        $response = ['success'=>true, 'msg'=>'Booking was deleted!', 'model_id'=>$id];
      }
    }

    $this->jsonResponse($response);
  }

  public function openPdfAction($id){
    $booking = new Bookings();
    $booking = $booking->findByIdAndUserId((int)$id, Users::currentUser()->id);

    // $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $user_id . DS;
    // H::dnd($location . $result->booking_nr);
    if($booking->pdfExists($booking->booking_nr, Users::currentUser()->id)){
      $url = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $booking->user_id . DS . $booking->booking_nr . '.pdf';
      $content = file_get_contents($url);

      header('Content-Type: application/pdf');
      header('Content-Length: ' . strlen($content));
      header('Content-Disposition: inline; filename="'.$booking->booking_nr.'.pdf"'); // inline to view in browser attachment to download pdf
      header('Cache-Control: private, max-age=0, must-revalidate');
      header('Pragma: public');
      ini_set('zlib.output_compression','0');

      die($content);
    // H::dnd($content);
    // $url = '';
    // $content = file_get_contents($url);
    }
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="filename.pdf"');

    H::dnd('hello');
  }




}


?>