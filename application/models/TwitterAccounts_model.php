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
}
