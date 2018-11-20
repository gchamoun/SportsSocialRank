<?php
class DBUpdate_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function latestUpdate()
{
                $sql = "SELECT MAX(date) as max_date
FROM twitter_dbupdates";

                $query = $this->db->query($sql);
                $row = $query->row();
                return $row->max_date;
       }

       public function previousUpdate()
       {
               $sql = "Select date as prev_date from twitter_dbupdates order by date DESC Limit 1,1" ;

               $query = $this->db->query($sql);
               $row = $query->row();
               return $row->prev_date;
       }


}
