<?php
class Leagues_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function leagues_name()
{
                $sql = "SELECT  * 
FROM  `categorydata` ` 
";

                $query = $this->db->query($sql);            
                return $query->result_array();
              
        
       }
       



}
