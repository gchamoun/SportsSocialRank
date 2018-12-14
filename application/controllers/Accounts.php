<?php
class Accounts extends CI_Controller {

public function insertTwitterList(){
  $slug = $this->input->post('slug');
  $owner_screen_name = $this->input->post('owner_screen_name');
  $category = $this->input->post('category');

  $this->load->model('Accounts_model');
                    $this->Accounts_model->getTwitterList($slug, $owner_screen_name, $category);

                    $this->load->view('dashboard/accounts', $data);


}
public function getAllAccounts(){

}




}
