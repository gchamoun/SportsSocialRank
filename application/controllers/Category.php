<?php
class Category extends CI_Controller {
  public function __construct() {
     parent::__construct();
     $this->load->database();
      $this->load->helper('url_helper');
      $this->load->model('Category_model');
  }


public function insertCategory($category){
      $categoryExist = $this->Category_model->categoryExist($category);
        if($categoryExist == 0){
          $this->Category_model->addNewCategory($category);
        }

}

public function removeCategory($category){
  return $this->Category_model->removeCategory($category);


}
public function categoryExist($category){
  return $this->Category_model->removeCategory($category);


}
public function addNewAccountCategory($accountId, $categoryId){
  return $this->Category_model->addNewAccountCategory($accountId, $categoryId);


}


}
