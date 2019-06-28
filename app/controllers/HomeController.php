<?php
namespace App\Controllers;
use App\Lib\Utilities\Mailer;
use App\Models\Contactmail;
use Core\Controller;
use Core\Model;
use Core\H;
use Core\Router;

class HomeController extends Controller {

    public function indexAction() {
      $this->view->render('home/index');
    }

    public function contactAction() {

      $contact = new Mailer();

      if($this->request->isPost()){
        $this->request->csrfCheck();
        $contact->assign($this->request->get());
        $contact->validator();
        if($contact->validationPassed()){
          $contact->contactMail();
          Router::redirect('home');
        }
      }

      $this->view->contact = $contact;
      $this->view->displayErrors = $contact->getErrorMessages();
      $this->view->contactAction = PROOT . 'home/contact';
      $this->view->render('home/contact');
    }
  }
