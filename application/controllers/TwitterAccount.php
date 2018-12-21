<?php
class TwitterAccount extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('TwitterAccounts_model');
    }
    public function getAccountInfo($accountId)
    {
        $this->TwitterAccounts_model->getAccountInfo($accountId);
    }
}
