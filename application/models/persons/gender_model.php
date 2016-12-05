<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gender_Model extends CI_Model
{

  const  TABLE_NAME = 'genders';


  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }

  function getActivs(){

		$this->db->where('activated', 1);
    $query =$this->db->get(self::TABLE_NAME);

    $activs = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $activs[$row['id_gender']]= $row['name'];
    }
    return $activs;
  }
  function getById($id){
    $this->db->where('id_gender', $id);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);

    return array(
      'id_gender' => $raw->id_gender,
      'name' => $raw->name,
      );

  }
}
