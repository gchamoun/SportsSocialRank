<?php
class Pages extends CI_Controller {
 
    
public function view($page = 'home')
{
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->model('Leagues_model');
        $this->load->view('templates/header', $data);
        $data['leagues'] = $this->Leagues_model->leagues_name();

        $this->load->view('pages/'. $page, $data);
        $this->load->view('templates/footer', $data);        
}

public function user($name){
                    $this->load->model('User_model');
                    echo 'efwefwef';

}




}
