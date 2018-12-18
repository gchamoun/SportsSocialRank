<?php
class Accounts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->model('Users_model');
        $this->load->model('Accounts_model');

        $this->load->library('ion_auth');
        $this->ion_auth->user();
    }

    public function insertTwitterList()
    {
        $slug = $this->input->post('slug');
        $owner_screen_name = $this->input->post('owner_screen_name');
        $category = $this->input->post('category');

        $this->load->model('Accounts_model');
        $this->Accounts_model->getTwitterList($slug, $owner_screen_name, $category);

        $this->load->view('dashboard/accounts');
    }
    public function getAllAccounts()
    {
        $this->load->model('Accounts_model');
        $accountsArray =  $this->Accounts_model->getAllAccounts();
        return $accountsArray;
    }
    public function getAccountsRecentlyAdded()
    {
        $this->load->model('Accounts_model');
        $accountsArray =  $this->Accounts_model->getRecentlyAdded();
        print_r($accountsArray);
        return $accountsArray;
    }
}
