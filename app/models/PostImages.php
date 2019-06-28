<?php
namespace App\Models;
use Core\Model;
use Core\H;

class PostImages extends Model {

  protected static $_table = 'post_images';
  protected static $_softDelete = true;


  public $id;
  public $post_id;
  public $name;
  public $url;
  public $sort;
  public $deleted = 0;

  const blackList = [];

  public static function uploadPostImages($post_id,$uploads){

    $lastImage = self::findFirst([
      'conditions' =>  "post_id = ?",
      'bind' => [$post_id],
      'order' => 'sort DESC'
    ]);

    $lastSort = (!$lastImage)? 0 : $lastImage->sort;
    $path = 'uploads' . DS . 'post_images' . DS . 'post_' . $post_id . DS;

    foreach($uploads->getFiles() as $file){
      $parts = explode('.',$file['name']);
      $ext = end($parts);
      $hash = sha1(time().$post_id.$file['tmp_name']);
      $uploadName = $hash . '.' . $ext;
      $image = new self();
      $image->url = $path . $uploadName;
      $image->name = $uploadName;
      $image->post_id = $post_id;
      $image->sort = $lastSort;
      if($image->save()){
        $uploads->upload($path,$uploadName,$file['tmp_name']);
        $lastSort++;
      }
    }
  }public static function deleteImages($post_id, $unlink = false) {
    $images = self::find([
      'conditions' => 'post_id = ?',
      'bind' => [$post_id]
    ]);

    foreach($images as $image) {
      $image->delete();
    }

    if($unlink){
      $dirname = ROOT . DS . 'uploads' . DS . 'post_images' . DS . 'post_' . $post_id;
      array_map('unlink', glob("$dirname/*.*"));
      rmdir($dirname);
    }
  }

  public static function findByPostId($post_id){
    return self::find([
      'conditions' => 'post_id = ?',
      'bind' => [$post_id],
      'order' => 'sort'
    ]);
  }



  // public function validateImages($images){
  //   $files = self::restructureFiles($images);

  //   $errors = [];
  //   $maxSize = 5242880; // 5mb
  //   $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG];

  //   foreach($files as $file){

  //     $name = $file['name'];

  //     // Check filesize
  //     if($file['size'] > $maxSize){
  //       $errors[$name] = $name . " is over the max allowed size of 5mb.";
  //     }

  //     // Check image filetype
  //     if(!in_array(exif_imagetype($file['tmp_name']),$allowedTypes)){
  //       $errors[$name] = $name . " is not an allowed file type. Please use JPG or PNG";
  //     }

  //   }
  //   return (empty($errors) ? true : $errors);
  // }

  // public static function restructureFiles($files){
  //   $structured = [];
  //   foreach($files['tmp_name'] as $key => $val){
  //     $structured[$key] = [
  //       'tmp_name' => $files['tmp_name'][$key],
  //       'name' => $files['name'][$key],
  //       'size' => $files['size'][$key],
  //       'error' => $files['error'][$key],
  //       'type' => $files['type'][$key]
  //     ];
  //   }
  //   return $structured;
  // }

}



?>