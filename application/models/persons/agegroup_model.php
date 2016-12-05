<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AgeGroup_Model extends CI_Model
{

  const  TABLE_NAME = 'age_groups';


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
      $activs[$row['id_ages_goup']]= $row['name'];
    }
    return $activs;
  }
  function getById($id){
    $this->db->where('id_ages_goup', $id);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);

    return array(
      'ageGroup_id' => $raw->id_ages_goup,
      'name' => $raw->name,
      );

  }
}
