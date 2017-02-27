<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gender_Model extends CI_Model
{

  const  TABLE_NAME = 'genders';


  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }

  //====================Selection=================================
  function getAllFullGender(){
    $this->db->order_by("position", "asc");
    $query=$this->db->get(self::TABLE_NAME);

    $genders=array();
    $rows=$query->result_array();
    foreach ($rows as $key => $row) {
    $gender=array(
      'id_gender'=>$row['id_gender'],
      'name'=>$row['name'],
      'position'=>$row['position'],
      'activated'=>$row['activated']
    );
    $genders[$row['id_gender']]= $gender;
    }
    return $genders;
  }
  function getSelector(){
    $this->db->where('activated', 1);
    $this->db->order_by("position", "asc");
    $query =$this->db->get(self::TABLE_NAME);

    $activs = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $activs[$row['id_gender']]= $row['name'];
    }
    return $activs;
  }
  function getActivs(){

		$this->db->where('activated', 1);
    $this->db->order_by("position", "asc");
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
      'activated'=>$raw->activated,
      );

  }
  //====================Insertion=================================
  function insert_gender($newGender){
    $this->name = $newGender;
   $this->db->insert(self::TABLE_NAME,$this);

  }
  //====================Update====================================
  function update($gender){

    $this->db->select('*');
    $this->db->from(self::TABLE_NAME);
    $this->db->where('id_gender', $material['id_gender']);
    $query =$this->db->get();

    if ($query->num_rows() != 1)
        return;

    $genderRow = $query->result_array()[0];

    foreach($genderRow as $key => $value){
      if(true == isset($gender[$key]))
        $genderRow[$key] = $gender[$key];
    }
    if($genderRow['position']<1)
      $genderRow['position']=1;
    $this->db->where('id_gender', $gender['id_gender']);
    $this->db->update(self::TABLE_NAME, $genderRow);

  }
  function setDefaultName($name){
    $set = array('name' => $name);
    $this->db->where('id_gender', 0);
    $this->db->update(self::TABLE_NAME, $set);
  }
  //====================Delete====================================


}
