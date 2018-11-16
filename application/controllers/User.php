<?php
class User extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->database();
       $this->load->helper('url_helper');
       $this->load->model('User_model');

   }

   function _remap($param) {
               if($param=="get_team"){
           $this-> get_team();
        }
else{
$this->index($param);}
       }


    function index($param){

                $data['team'] = $param;
        $data['title'] = ucfirst($param); // Capitalize the first letter
 $this->load->view('templates/header', $data);
                $this->load->model('User_model');
     $this->User_model->isUser($param);
            $this->load->view('user/userPage',  $data);
        $this->load->view('templates/footer', $data);



    }
    public function get_users()
    {
       $users = $this->User_model->getAllUsers();

       echo json_encode($users);
       exit();
    }

   public function get_team()
   {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
if (isset($_POST['formName'])) {
    $values = $_POST['formName'];

    // $login = $values['login'];
    // ...
}


            $query = $this->db->query("
     SELECT * FROM twitter_archive where display_name = '" . $values ."'
            ORDER
            BY date desc;");


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
                    $date =  $r->date;
                    $groupRunId = $r->group_run_id;
           $growthRate =  $followerstoday / $followers;
          $data[] = array(

$newfollowers,
               $newfollowing,
                               $followerstoday,
              $date
            ,
          $groupRunId);
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
