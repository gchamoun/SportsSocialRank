<?php
class UserRank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->model('UserRank_model');
        $this->load->model('User_model');
        $this->load->model('Category_model');
    }

    public function getCurrentRank($user)
    {
        $accountId = $this->User_model->getUserId($user);
        $users = $this->UserRank_model->getAllRanks($accountId);
    }
}
