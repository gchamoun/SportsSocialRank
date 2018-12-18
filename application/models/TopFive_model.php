<?php
class TopFive extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


public function collegeFootball(){

  $this->db->select('*');

  $query = $this->db->query("
SELECT tt.*,users.Category
  FROM twitter tt
      INNER JOIN users
  ON Twitter_username = display_name where user = collegeFootball;
  ORDER
  BY followers desc;");

  return $query->result();

}

}
