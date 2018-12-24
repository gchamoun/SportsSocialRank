<?php
class Users_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function getLatest($category)
    {
        if ($category=="cfb") {
            $category="College Football";
        }
        if ($category=="nflplayers") {
            $category="NFL Player";
        }
        if ($category=="premierleague") {
            $category="Premier League";
        }
        if ($category=="FCSFootball") {
            $category="FCS Football";
        }
        if ($category=="collegebasketball") {
            $category="College Basketball";
        }
        $this->db->select('*');

        $query = $this->db->query("
        SELECT tr.rank_day_change, tr.rank_day_change,tr.rank, tr.category_details_id, acc.name, td.followers,td.following,td.followers_today_count, tc.screen_name,  tc.profile_image_url
  FROM accounts_category c
  INNER JOIN accounts acc
      on acc.id = c.accounts_id
  INNER JOIN twitter_accounts tc
  	on acc.id = tc.accounts_id
  INNER JOIN twitter_data td
      on tc.id = td.twitter_accounts_id
  INNER JOIN category_details cd
  	on c.category_details_id = cd.id
  INNER JOIN twitter_rank tr
  	on (tr.twitter_accounts_id = tc.id) and (c.category_details_id = tr.category_details_id)and (td.twitter_dbupdates_id = tr.twitter_dbupdates_id)
WHERE cd.name = '$category'
 order by td.followers desc;");
        return $query->result();
    }
    public function getTopFive($category)
    {
        if ($category=="cfb") {
            $category="College Football";
        }
        if ($category=="nflplayers") {
            $category="NFL Player";
        }
        if ($category=="premierleague") {
            $category="Premier League";
        }

        $this->db->select('*');

        //   $query = $this->db->query("
        // SELECT tt.*,users.Category
        //   FROM twitter tt
//       INNER JOIN users
        //   ON Twitter_username = display_name where users.category ='" . $category ."'
        //   ORDER
        //   BY followers desc limit 5;");
        $query = $this->db->query("
  SELECT acc.name, td.followers,td.following,td.followers_today_count, tc.screen_name,  tc.profile_image_url
FROM accounts_category c
INNER JOIN accounts acc
    on acc.id = c.accounts_id
INNER JOIN twitter_accounts tc
	on acc.id = tc.accounts_id
INNER JOIN twitter_data td
    on tc.id = td.twitter_accounts_id
INNER JOIN category_details cd
	on c.category_details_id = cd.id
WHERE cd.name = '$category'
ORDER
  BY followers desc limit 5;");

        return $query->result();
    }
}
