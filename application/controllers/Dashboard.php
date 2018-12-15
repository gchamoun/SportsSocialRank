<?php
class Dashboard extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->database();
       $this->load->helper('url_helper');
       $this->load->model('Users_model');
       $this->load->library('ion_auth');
$this->ion_auth->user();
   }



    public function home()
    {
      if ($this->ion_auth->logged_in())
      {      if ($this->ion_auth->is_admin())
            {
              $this->load->view('admin/header');

              $this->load->view('admin/dashboard');
}
else{

  $this->load->view('admin/header');

  $this->load->view('admin/dashboard');
    }}
      else{
        echo 'You are NOT Logged in';

      }
    }

    public function accounts()
    {
      if ($this->ion_auth->logged_in())
      {      if ($this->ion_auth->is_admin())
            {
              $this->load->view('admin/header');

              $this->load->view('admin/accounts');
}
else{

  $this->load->view('admin/header');

  $this->load->view('admin/accounts');
    }}
      else{
        echo 'You are NOT Logged in';

      }
    }







}
