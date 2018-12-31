<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getUserId($accountName)
    {
        $sql =  "SELECT * FROM accounts WHERE REPLACE(name, ' ', '') = REPLACE( '".$accountName."', ' ', '')";
        $query = $this->db->query($sql);
        $row = $query->row();
        foreach ($query->result() as $row) {
            return $row->id;
        }
    }
    public function getTwitterId($accountId)
    {
        $sql =  "SELECT * FROM twitter_accounts WHERE REPLACE(accounts_id, ' ', '') = REPLACE( '".$accountId."', ' ', '')";
        $query = $this->db->query($sql);
        $row = $query->row();
        foreach ($query->result() as $row) {
            $twitterId = $row->id;
            return $twitterId;
        }
    }
    public function getAccountNameFromTwitter($twitterScreenName)
    {
        $sql =  "Select accounts.name from accounts inner join twitter_accounts where twitter_accounts.accounts_id = accounts.id and twitter_accounts.screen_name = '".$twitterScreenName."'";
        $query = $this->db->query($sql);
        $row = $query->row();
        foreach ($query->result() as $row) {
            $accountName = $row->name;
            return $accountName;
        }
    }
    public function isUser($user)
    {
        $sql = "SELECT id FROM sportssocialrank.twitter_archive where display_name =  '" . $user ."' limit 1; ";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            ;
        } else {
        }
    }

    public function getAllUsers()
    {
        $query = $this->db->get_where('twitter');
        return $query->result();
    }
}
