<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;
use Core\H;
use Core\FH;

class ContactsController extends Controller {

  public function onConstruct() {
    $this->view->setLayout('default');
  }

  public function indexAction() {
    $contactsModel = Contacts::findAllByUserId(Users::currentUser()->id,['order'=>'lname, fname']);
    $this->view->contacts = $contactsModel;
    $this->view->render('contacts/index');
  }

  public function addAction(){
    $newContact = new Contacts();

    if($this->request->isPost()){
      $this->request->csrfCheck();
      $newContact->assign($this->request->get(), Contacts::blackListedFormKeys);
      $newContact->deleted = $this->request->get('deleted');
      $newContact->user_id = Users::currentUser()->id;
      $newContact->save();
      if($newContact->validationPassed()){
        Router::redirect('contacts');
      }
    }
    $this->view->contact = $newContact;
    $this->view->displayErrors = $newContact->getErrorMessages();
    $this->view->postAction = PROOT . 'contacts' . DS . 'add';
    $this->view->render('contacts/add');
  }

  public function editAction($id){
    $editContact = Contacts::findByIdAndUserId((int)$id, Users::currentUser()->id);
    if(!$editContact) Router::redirect('contacts');

    if($this->request->isPost()){
      $this->request->csrfCheck();
      $editContact->assign($this->request->get());
      $editContact->save();
      if($editContact->validationPassed()){
        Router::redirect('contacts');
      }
    }
    $this->view->displayErrors = $editContact->getErrorMessages();
    $this->view->contact = $editContact;
    $this->view->postAction = PROOT . 'contacts' . DS . 'edit' . DS . $editContact->id;
    $this->view->render('contacts/edit');
  }

  public function deleteAction($id){
    $deleteContact = Contacts::findByIdAndUserId((int)$id, Users::currentUser()->id);

    if($deleteContact){
      $deleteContact->delete();
      Session::addMsg('success', 'Contact has been deleted.');
    }
    Router::redirect('contacts');
  }

  public function detailsAction($id){
    $contactsModel = Contacts::findByIdAndUserId((int)$id, Users::currentUser()->id);
    if(!$contactsModel){
      Router::redirect('contacts');
    }
    $this->view->contact = $contactsModel;
    $this->view->render('contacts/details');
  }
}

?>