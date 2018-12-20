<?php
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->model('User_model');
    }

    public function _remap($param)
    {
        if ($param=="get_team") {
            $this-> get_team();
        } elseif ($param=="get_team_chart") {
            $this-> get_team_chart();
        } else {
            $this->index($param);
        }
    }


    public function index($param)
    {
        $data['team'] = $param;
        $data['title'] = ucfirst($param); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->model('User_model');
        $this->User_model->isUser($param);
        $this->load->view('user/userPage', $data);
        $this->load->view('templates/footer', $data);
    }
    public function get_users()
    {
        $users = $this->User_model->getAllUsers();

        echo json_encode($users);
        exit();
    }


    //Ajax for Returning all data on a team
    public function get_team()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        if (isset($_POST['team'])) {
            $team = $_POST['team'];

            // $login = $values['login'];
    // ...
        }


        $query = $this->db->query("
     SELECT * FROM twitter_archive where display_name = '" . $team ."'
            ORDER
            BY date desc ;");


        $data = [];


        foreach ($query->result() as $key => $r) {
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


    //Ajax for Returning all data on a team
    public function get_team_chart()
    {
        if (isset($_POST['team'])) {
            $team = $_POST['team'];

            // $login = $values['login'];
       // ...
        }


        $query = $this->db->query("
        SELECT * FROM twitter_archive where display_name = '" . $team ."'
               ORDER
               BY date asc;");




        $data = [];

        $responce->cols[] = array(
             "id" => "",
             "label" => "Topping",
             "pattern" => "",
             "type" => "string"
         );
        $responce->cols[] = array(
             "id" => "",
             "label" => "followers",
             "pattern" => "",
             "type" => "number"
         );



        foreach ($query->result() as $key => $r) {
            $responce->rows[]["c"] = array(

                 array(
                     "v" => "$r->date",
                     "f" => null
                 ) ,
                 array(
                     "v" => (int) $r->followers,
                     "f" => null
                 )
             );
        }



        echo json_encode($responce);
        exit();
    }
}
