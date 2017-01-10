<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sexuality_Model extends CI_Model
{

  const  TABLE_NAME = 'sexuality';


  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }
//====================Selection=================================
  function getAllFullSexuality()
  {
    $this->db->order_by("position", "asc");
    $query =$this->db->get(self::TABLE_NAME);

    $sexualitys=array();
    $rows = $query->result_array();

    foreach ($rows as $key => $row) {
      $sexuality = array(
        'id_sexuality' => $row['id_sexuality'],
        'name' => $row['name'],
        'position' => $row['position'],
        'activated' => $row['activated']
      );
      $sexualitys[$row['id_sexuality']]= $sexuality;
    }
    return $sexualitys;
  }
  function getSelector(){
    $this->db->order_by("position", "asc");
    $this->db->where('activated', 1);
    $query =$this->db->get(self::TABLE_NAME);

    $activs = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $activs[$row['id_sexuality']]= $row['name'];
    }
    return $activs;
  }
  function getActivs(){
    $this->db->order_by("position", "asc");
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
  //====================Insertion=================================
  function insert_sexuality($newSexuality)
  {
    $this->name = $newSexuality;
   $this->db->insert(self::TABLE_NAME,$this);

  }
  //====================Update====================================
  function update($sexuality){
    $oldsexuality = $this -> getById($sexuality['id_sexuality']);
    $sexualityRow=array(
      'id_sexuality' => $oldsexuality['id_sexuality'],
      'name'=> $oldsexuality['name'],
      'position'=> $oldsexuality['position'],
      'activated' => $oldsexuality['activated']
    );
    foreach($sexualityRow as $key => $value){
      if(true ==isset($sexuality[$key]))
            $sexualityRow[$key]=$sexuality[$key];
    }
    if($sexualityRow['position']<1)
      $sexualityRow['position']=1;
    $this->db->where('id_sexuality', $sexuality['id_sexuality']);
    $this->db->update(self::TABLE_NAME, $sexualityRow);
  }
  function setDefaultName($name){
    $set = array('name' => $name);
    $this->db->where('id_sexuality', 0);
    $this->db->update(self::TABLE_NAME, $set);
  }
  //====================Delete====================================



}
