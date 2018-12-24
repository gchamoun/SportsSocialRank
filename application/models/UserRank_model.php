<?php
class UserRank_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Category_model');
        $this->load->model('User_model');
    }


    public function getRank($twitterId, $categoryId)
    {
        $sql =  "SELECT * FROM twitter_rank where twitter_accounts_id = '".$twitterId."' and category_details_id = '".$categoryId."' order by id desc limit 1";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $query->row()->rank;
    }

    public function getRankRange($twitterId, $categoryId, $days)
    {
        $sql =  "SELECT rank FROM twitter_rank tr inner join twitter_dbupdates td on td.id = tr.twitter_dbupdates_id  where date >= (CURDATE() - INTERVAL '".$days."' DAY)
 AND (tr.twitter_accounts_id = '".$twitterId."' and tr.category_details_id = '".$categoryId."') order by td.id desc limit 1";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $query->row()->rank;
    }

    public function getAllRanks($accountName)
    {
        $accountId = $this->User_model->getUserId($accountName);
        $categoryId = $this->Category_model->getAccountsCategories($accountId);
        $twitterId = $this->User_model->getTwitterID($accountId);
        $ranks = array();
        $i=0;
        foreach ($categoryId as $row) {
            $rank =  $this->UserRank_model->getRank($twitterId, $row->category_details_id);
            $ranks[$i][0] = $rank;
            $categoryId = $row->category_details_id;
            $categoryName = $this->Category_model->getCategoryName($categoryId);
            $ranks[$i][1] = $categoryName;
            $categoryCount = $this->Category_model->categoryCount($categoryId);
            $ranks[$i][2] = $categoryCount;
            $i++;
        }
        return $ranks;
    }
}
