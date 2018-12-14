<?php
class Accounts_model extends CI_Model {


        public function __construct()
        {
                $this->load->database();
                require_once(APPPATH.'libraries/TwitterAPIExchange.php');
                $this->load->model('Category_model');

        }

 public function getTwitterList($slug, $owner_screen_name,$category)
       {
        $accountsList = $this->getTwitterListJSON($slug, $owner_screen_name);
        $this->addNewAccountsJSON($accountsList,$category);
}

public function getTwitterListJSON($slug, $owner_screen_name)
{
  $settings = array(

  'oauth_access_token' => "562520337-IWHslct3vqnZq9DPLHKKF7xlYrQrf5Nolatbm52T",

  'oauth_access_token_secret' => "BmbHCJgoTTlhX99PjgRiN6uWqle6xJCepHvFDtNSfEHLy",

  'consumer_key' => "6wR5l7KwDSDFmb6swY1seW5MP",

  'consumer_secret' => "RTg9GlOPcX0YCCkodKzMzUw7z1iOdVy5fwJlD5JxbqW33XKNmL"

  );
//Get Twitter List
$url = "https://api.twitter.com/1.1/lists/members.json";
$getfield = "?slug=".$slug."&owner_screen_name=".$owner_screen_name."&count=5000";
      $requestMethod = 'GET';

      $twitter = new TwitterAPIExchange($settings);

      $json =  $twitter->setGetfield($getfield)

                       ->buildOauth($url, $requestMethod)

                       ->performRequest();

                       $accountsList = json_decode($json);
                       echo "</br>";
                       $arr = (array)$accountsList->errors[0]->code;
                       if (!empty($arr)) {
    if($accountsList->errors[0]->code = 34){
      echo $accountsList->errors[0]->message;
      exit;
    }
  }
                       return $accountsList;
}


public function addNewAccountsJSON($accountsList, $category){

//Add New Category
$categoryId = $this->Category_model->addNewCategory($category);

//StartLooping Through JSON
$i = -1;
foreach ($accountsList->users as $key=>$users) {
  $i++;

//Check To see if account exist
$accountName = $accountsList->users[$i]->name;
$accountId = $this->accountExist($accountName);
if($accountId != false){
}
else{
//Add Account to Accounts List
$data = array(
'name' => $accountName,
);
$this->db->insert('accounts', $data);
$accountId = $this->accountExist($accountName);

//Add Category to Account
$categoryAccountId = $this->Category_model->addNewAccountCategory($accountId, $categoryId);
echo $categoryAccountId;

//Add Account to Twitter Accounts

$data = array(
'accounts_id' => $accountId,
'name' => $accountName,
'screen_name'=> $accountsList->users[$i]->screen_name,
'location'=> $accountsList->users[$i]->location,
'url '=> $accountsList->users[$i]->url,
'description'=> $accountsList->users[$i]->description,
'verified'=> $accountsList->users[$i]->verified,
'profile_banner_url'=> $accountsList->users[$i]->profile_banner_url,
'profile_image_url'=> $accountsList->users[$i]->profile_image_url
);

$this->insertTwitterAccount($accountId, $data);

}
}

}


public function accountExist($account){
  $this->db->where('name',$account);
  $query = $this->db->get('accounts');
  $result = $query->row();
  if ($query->num_rows() > 0) {
  $accountId= $result->id;
return $accountId;
}
else{
 return 0;
}
}
public function twitterAccountExist($accounts_id){
  $this->db->where('accounts_id',$accounts_id);
  $query = $this->db->get('twitter_accounts');
  $result = $query->row();
  if ($query->num_rows() > 0) {
  $id= $result->id;
return $id;
}
else{
 return false;
}
}

public function insertTwitterAccount($accounts_id, $data){
$twitterAccountExist = $this->twitterAccountExist($accounts_id);
if($twitterAccountExist == false){
  $this->db->insert('twitter_accounts', $data);
}
}
}
