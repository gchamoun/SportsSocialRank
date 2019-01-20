<?php
class FormSubmission_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function demoFormSubmit($data)
    {
        $this->db->insert('demo_form', $data);

        echo("1");
    }
    public function contactFormSubmit($data)
    {
        $this->db->insert('contact_form', $data);

        echo("1");
    }
}
