<?php
class FormSubmission extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FormSubmission_model');
    }


    public function demoForm()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        //Validating Name Field
        $this->form_validation->set_rules('full-name', 'full-name', 'required|min_length[1]|max_length[20]');


        //Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        //Validating Mobile no. Field
        if ($this->form_validation->run() == false) {
            echo "Error";
            echo validation_errors();
        } else {
            $data = array(
  'full-name' => $this->input->post('full-name'),
  'email' => $this->input->post('email'),
  'subject' => $this->input->post('subject'),
  'message' => $this->input->post('message'),
  );
            $this->db->set($data);
            $this->FormSubmission_model->contactFormSubmit($data);
        }
    }
}
