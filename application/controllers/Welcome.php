<?php
class Welcome extends CI_Controller {
  public function __construct() {
     parent::__construct();
     $this->load->database();
      $this->load->helper('url_helper');
      $this->load->model('User_model');

  }

public function welcome(){
                    echo 'welcome user';

}




}
