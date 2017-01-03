<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sexuality_Model extends CI_Model
{

  const  TABLE_NAME = 'sexuality';


  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }

  function getAllFullSexuality()
  {
      $query =$this->db->get(self::TABLE_NAME);

      $sexualitys=array();
      $rows = $query->result_array();

      foreach ($rows as $key => $row) {
        $sexuality = array(
          'id_sexuality' => $row['id_sexuality'],
          'name' => $row['name'],
          'activated' => $row['activated']
        );
        $sexualitys[$row['id_sexuality']]= $sexuality;
      }
      return $sexualitys;
  }
  function update($sexuality)
  {
    $oldsexuality = $this -> getById($sexuality['id_sexuality']);
    $sexualityRow=array(
      'id_sexuality' => $oldsexuality['id_sexuality'],
      'name'=> $oldsexuality['name'],
      'activated' => $oldsexuality['activated']
    );
    foreach($sexualityRow as $key => $value)
    {
      if(true ==isset($sexuality[$key]))
            $sexualityRow[$key]=$sexuality[$key];
        }
      $this->db->where('id_sexuality', $sexuality['id_sexuality']);
      $this->db->update(self::TABLE_NAME, $sexualityRow);
    }
    function insert_sexuality($newSexuality)
    {
      $this->name = $newSexuality;
     $this->db->insert(self::TABLE_NAME,$this);

    }
  function getActivs(){

		$this->db->where('activated', 1);
    $query =$this->db->get(self::TABLE_NAME);

    $activs = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $activs[$row['id_sexuality']]= $row['name'];
    }
    return $activs;
  }
  function getById($id){
    $this->db->where('id_sexuality', $id);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);

    return array(
      'id_sexuality' => $raw->id_sexuality,
      'name' => $raw->name,
      'activated' => $raw->activated
      );

  }
}
