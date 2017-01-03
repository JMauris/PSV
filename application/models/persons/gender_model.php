<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gender_Model extends CI_Model
{

  const  TABLE_NAME = 'genders';


  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }


  function getAllFullGender(){
    $query=$this->db->get(self::TABLE_NAME);

    $genders=array();
    $rows=$query->result_array();
    foreach ($rows as $key => $row) {
    $gender=array(
      'id_gender'=>$row['id_gender'],
      'name'=>$row['name'],
      'activated'=>$row['activated']
    );
    $genders[$row['id_gender']]= $gender;
    }
    return $genders;
  }
  function update($gender)
  {
    $oldGender = $this->getById($gender['id_gender']);
    $genderRow = array(
      'id_gender'=>$oldGender['id_gender'],
      'name'=>$oldGender['name'],
      'activated'=>$oldGender['activated']
    );

    foreach($genderRow as $key => $value){
      if(true == isset($gender[$key]))
        $genderRow[$key] = $gender[$key];
    }
    $this->db->where('id_gender', $gender['id_gender']);
    $this->db->update(self::TABLE_NAME, $genderRow);

  }
  function insert_gender($newGender)
  {
    $this->name = $newGender;
   $this->db->insert(self::TABLE_NAME,$this);

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
      'activated'=>$raw->activated,
      );

  }
}
