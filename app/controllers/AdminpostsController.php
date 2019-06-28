<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Model;
use App\Models\Users;
use Core\Router;
use App\Models\Posts;
use App\Models\Category;
use Core\FH;
use Core\H;
use App\Models\PostImages;
use App\Lib\Utilities\Uploads;

class AdminpostsController extends Controller {

  public function onConstruct() {
    $this->view->setLayout('admin');
    $this->currentUser = Users::currentUser();
  }

  public function indexAction() {
    $posts = Posts::findAllByUserId(Users::currentUser()->id);

    $this->view->posts = $posts;
    $this->view->render('adminposts/index');
  }

  public function addAction() {
    $posts = new Posts();
    $postImages = new PostImages();
    $category = new Category();

    if($this->request->isPost()){
      $this->request->csrfCheck();
      $files = $_FILES['postImages'];

      if($files['tmp_name'][0] == ''){
        $posts->addErrorMessage('postImages[]', 'You must choose an image.');
      }else{
        $uploads = new Uploads($files);
        $uploads->runValidation();
        $imagesErrors = $uploads->validates();
        if(is_array($imagesErrors)){
          $msg = "";
          foreach($imagesErrors as $name => $message){
            $msg .= $message . " ";
          }
          $posts->addErrorMessage('postImages[]',trim($msg));
        }
      }
      $posts->assign($this->request->get(), Posts::blackList);
      $posts->user_id = Users::currentUser()->id;
      // H::dnd($posts);
      $posts->save();
      if($posts->validationPassed()){

        // Upload Images
        PostImages::uploadPostImages($posts->id, $uploads);

        // Redirect
        Session::addMsg('success', 'Post Added Successfully!');
        Router::redirect('adminposts');
      }
    }

    $this->view->posts = $posts;
    $this->view->category = Category::getOptionsForForm();
    $this->view->displayErrors = $posts->getErrorMessages();
    $this->view->formAction = PROOT . 'adminposts/add';
    $this->view->render('adminposts/add');
  }

  public function editAction($id){
    $user = Users::currentUser();
    $post = Posts::findByIdAndUserId((int)$id, $user->id);

    if(!$post){
      Session::addMsg('danger', 'You do not have persmission to edit this post!');
      Router::redirect('adminposts/index');
    }

    $images = PostImages::findByPostId($post->id);

    if($this->request->isPost()){
      $this->request->csrfCheck();
      $files = $_FILES['postImages'];
      $isFiles = $files['tmp_name'][0] != '';
      if($isFiles){
        $uploads = new Uploads($files);
        $uploads->runValidation();
        $imagesErrors = $uploads->validates();
        if(is_array($imagesErrors)){
          $msg = "";
          foreach ($imagesErrors as $name => $message) {
            $msg .= $message . " ";
          }
          $post->addErrorMessage('postImage', trim($msg));
        }
      }

      $post->assign($this->request->get(), Posts::blackList);
      $post->user_id = $this->currentUser->id;
      $post->save();
      if($post->validationPassed()){

      }
    }

    $this->view->images = $images;
    $this->view->post = $post;
    $this->view->category = Category::getOptionsForForm();
    $this->view->displayErrors = $post->getErrorMessages();
    $this->view->render('adminposts/edit');
  }

  public function detailsAction($postId) {
    $post = Posts::findByIdAndUserId((int)$postId, Users::currentUser()->id);

    // H::dnd($post);
    $this->view->post = $post;
    $this->view->render('adminposts/details');
  }

  public function deleteAction() {
    $response = ['success' => false, 'msg' => 'Something went wrong!'];

    if($this->request->isPost()){
      $id = $this->request->get('id');
      $post = Posts::findByIdAndUserId((int)$id, Users::currentUser()->id);

      if($post){
        PostImages::deleteImages($id);
        $post->delete();
        $response = ['success' => true, 'msg' => 'Post was deleted!', 'model_id' => $id];
      }
    }

    $this->jsonResponse($response);
  }
}

?>