<?php
class Category_model extends CI_Model {


        public function __construct()
        {
                $this->load->database();
        }

 public function categoryExist($category)
       {
         $this->db->from('category_details');
         $this->db->where('name',$category);
         $query = $this->db->get();
         $lastQuery = $this->db->last_query();
         foreach ($query->result() as $row)
         {
           return $row->id;
         }
return 0;

}



public function addNewCategory($category){
if($this->categoryExist($category) == 0){
        $data = array(
    'name' => $category
);
$this->db->insert('category_details', $data);
}
$this->db->from('category_details');
$this->db->where('name',$category);
$query = $this->db->get();
foreach ($query->result() as $row)
{
  return $row->id;
}
      }




public function removeCategory($category){
        return $this->db->delete('category_details', array('name' => $category));
}

public function addNewAccountCategory($accountId, $categoryId)
      {
        // if($this->accountCategoryExist($accountId, $categoryId) == false){
// echo "IT WENT HERE";
        $data = array(
    'accounts_id' => $accountId,
    'category_details_id' => $categoryId,

);

  $this->db->insert('accounts_category', $data);
// }
//
// $this->db->from('accounts_category');
// $this->db->where('accounts_id',$accountId);
// $this->db->where('category_details_id',$categoryId);
// $query = $this->db->get();
// foreach ($query->result() as $row)
// {
//   echo $row->id;
//   return $row->id;
// }
}
public function accountCategoryExist($accountId, $categoryId){
  $this->db->from('accounts_category');
  $this->db->where('accounts_id',$accountId);
  $this->db->where('category_details_id',$categoryId);
  $query = $this->db->get();
  $lastQuery = $this->db->last_query();
  foreach ($query->result() as $row)
  {
    echo "There is already a account";
    return $row->id;
  }
  echo "There is no account";
return false;

}

}
