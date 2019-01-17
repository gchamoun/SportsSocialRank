<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->model('Users_model');
        $this->load->model('Accounts_model');
        $this->load->model('UserRank_model');
        $this->load->model('TwitterAccounts_model');
        $this->load->model('Category_model');

        $this->load->helper('html');

        $this->load->library('ion_auth');
        $this->ion_auth->user();
    }



    public function home()
    {
        // if ($this->ion_auth->logged_in()) {
        //     if ($this->ion_auth->is_admin()) {
        $this->load->view('admin/header');
        $data['categories']=$this->Category_model->getAllCategoriesId();
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer', $data);
        //     } else {
        //         $data['user']=$this->ion_auth->user()->row();
        //         $user = $this->ion_auth->user()->row();
        //         $accountName = $user->company;
        //         $data['rankings']=$this->UserRank_model->getAllRanks($accountName);
        //         $this->load->view('members/header');
        //         $data['userInfo']=$this->TwitterAccounts_model->getAccountInfo($accountName);
        //         $this->load->view('members/dashboard', $data);
        //         $this->load->view('members/footer');
        //     }
        // } else {
        //     redirect('auth/login', 'refresh');
        // }
    }
    public function user($user)
    {
        if ($this->ion_auth->logged_in()) {
            $accountName = $user;
            $data['rankings']=$this->UserRank_model->getAllRanks($accountName);
            $this->load->view('members/header');
            $data['userInfo']=$this->TwitterAccounts_model->getAccountInfoTwitter($accountName);
            $this->load->view('members/user', $data);
            $this->load->view('members/footer');
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function accounts()
    {
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                $this->load->view('admin/header');
                $data['accountsArray'] = $this->Accounts_model->getRecentlyAdded();
                $this->load->view('admin/accounts', $data);
            } else {
                $this->load->view('admin/header');
                $data['accountsList'] = $this->Accounts_model->getRecentlyAdded();
                $this->load->view('admin/accounts', $data);
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
}
