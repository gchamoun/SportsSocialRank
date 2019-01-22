<?php
class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        if (! file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->load->helper('form');

        $data['title'] = ucfirst($page); // Capitalize the first letter
        // $this->load->model('DBUpdate_model');
        //
        // $data['latestUpdate'] = $this->DBUpdate_model->latestUpdate();
        // $data['previousUpdate'] = $this->DBUpdate_model->previousUpdate();
        if ($page == 'about') {
            $this->load->view('templates/aboutheader');
            $this->load->view('pages/'. $page, $data);
            $this->load->view('admin/footer', $data);
        }
        if ($page == 'contact') {
            $this->load->view('templates/contactheader');
            $this->load->view('pages/'. $page, $data);
]            $this->load->view('admin/footer', $data);
        }
    }

    public function user($name)
    {
        $this->load->model('User_model');
        echo 'efwefwef';
    }
}
