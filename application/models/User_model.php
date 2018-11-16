<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

   public function isUser($user){
                $sql = "SELECT id FROM sportssocialrank.twitter_archive where display_name =  '" . $user ."' limit 1; ";
                $query = $this->db->query($sql);

               if($query->num_rows() > 0){
                  ;} else {
}}
public function getAllUsers(){
  $query = $this->db->get_where('twitter');
  return $query->result();

}

}
