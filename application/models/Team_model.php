<?php
class Team_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
                public function getTeamArchive($user)
{
                $sql = "SELECT * FROM sportssocialrank.twitter_archive where display_name = '".$user."';";
";
                $query = $this->db->query($sql);            
                return $query->result_array();
              
        
       }
}
