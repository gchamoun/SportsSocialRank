<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Item extends CI_Controller {


   /**
    * Get All Data from this method.
    *
    * @return Response
   */
   public function __construct() {
      parent::__construct();
      $this->load->database();
       $this->load->helper('url_helper');

   }


   /**
    * Create from display on this method.
    *
    * @return Response
   */
   
   public function index()
   {
      $this->load->view('index');
   }


   /**
    * Create from display on this method.
    *
    * @return Response
   */
   public function get_items()
   {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      
            $query = $this->db->query("
     SELECT tt.*,users.Category
            FROM twitter tt
                INNER JOIN users
            ON Twitter_username = display_name 
            ORDER 
            BY followers desc;");


      $data = [];


      foreach($query->result() as $key => $r) 
          {
      $followers = (int) $r->followers;
          $newfollowers = number_format($followers);
          $following = (int) $r->following;
          $newfollowing = number_format($following);
          $followerstoday = (int) $r->followers_today_count;
          $followerstoday = number_format($followerstoday);
          $baseurl = base_url();
          $imageAvater = $r->profile_image_url;
         
          $usernameName = $r->display_name;

          $data[] = array(
                 $usernameName, $key+1,$newfollowers,$newfollowing,$followerstoday,$r->Category);
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
      exit();
   }
   public function get_nfl()
   {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));



            $query = $this->db->query("
     SELECT tt.*,users.Category
            FROM twitterdata_old tt
                INNER JOIN users
            ON Twitter_username = display_name 
            
            FROM twitterdata_new
            GROUP BY display_name) groupedtt 
            ON tt.display_name = groupedtt.display_name 
            AND tt.Date = groupedtt.MaxDateTime
            Where category = 'NFL'
            
            ORDER 
            BY followers desc;


");


      $data = [];


      foreach($query->result() as $key => $r) 
          {
          $followers = (int) $r->followers;
          $newfollowers = number_format($followers);
          $following = (int) $r->following;
          $newfollowing = number_format($following);
          $followerstoday = (int) $r->followers_today_count;
          $followerstoday = number_format($followerstoday);
          $string =  "<img src='" . $r->profile_image_url. "'/>" . "<a href='".$r->profile_image_url. "'>".  " @" . $r->display_name . " | " . $r->name . "</a>";
                 
          $data[] = array(
                   $key+1,
             $string ,

$newfollowers,
               $newfollowing,
                               $followerstoday,
                               $r->Category                   );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
      exit();
   }
}