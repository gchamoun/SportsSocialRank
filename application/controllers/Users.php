<?php
class Users extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->database();
       $this->load->helper('url_helper');
       $this->load->model('Users_model');

   }


    public function get_latest()
    {
       $users = $this->Users_model->getLatest();

       echo json_encode($users);
       exit();
    }

}
