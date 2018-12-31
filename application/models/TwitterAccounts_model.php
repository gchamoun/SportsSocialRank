<?php
class TwitterAccounts_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getAccountInfo($accountName)
    {
        $accountId = $this->User_model->getUserId($accountName);
        $this->db->where('accounts_id', $accountId);
        $query = $this->db->get('twitter_accounts');
        $result = $query->row();
        return $result;
    }
    public function getAccountInfoTwitter($accountName)
    {
        $this->db->where('screen_name', $accountName);
        $query = $this->db->get('twitter_accounts');
        $result = $query->row();
        return $result;
    }
    public function getFollowers($twitterAccountId)
    {
        $sql = "select * from twitter_data_archive where twitter_accounts_id = '" . $twitterAccountId ."' order by date desc";
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            $followers = $row->followers;
            $date = $row->date;
        }
        return json_encode($query->result());
    }
}
