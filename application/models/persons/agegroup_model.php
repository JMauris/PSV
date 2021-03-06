<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AgeGroup_Model extends CI_Model
{

  const  TABLE_NAME = 'age_groups';


  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }
  //====================Selection=================================
  function getAllFullAgeGroup(){
    $this->db->order_by("position", "asc");
    $query =$this->db->get(self::TABLE_NAME);

    $ageGroups = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $age_group = array(
        'id_ages_goup' =>$row['id_ages_goup'],
        'name' => $row['name'],
        'position' => $row['position'],
        'activated' => $row['activated']);
      $ageGroups[$row['id_ages_goup']]= $age_group;
    }
    return $ageGroups;
  }
  function getSelector(){
    $this->db->order_by("position", "asc");
    $this->db->where('activated', 1);
    $query =$this->db->get(self::TABLE_NAME);

    $activs = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $activs[$row['id_ages_goup']]= $row['name'];
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
      'id_ages_goup' => $raw->id_ages_goup,
      'name' => $raw->name,
      'position' => $raw->position,
      'activated' =>   $raw->activated
      );

  }
  //====================Insertion=================================
  function insert_AgeGroup($newAgeGroup)
  {
    $this->name = $newAgeGroup;
    $this->db->insert(self::TABLE_NAME,$this);
  }
  //====================Update====================================
  function update($ageGroup){
    $oldAgeGroup = $this -> getById($ageGroup['id_ages_goup']);
    $AgeGroupRow=array(
      'id_ages_goup' => $oldAgeGroup['id_ages_goup'],
      'name'=> $oldAgeGroup['name'],
      'position'=> $oldAgeGroup['position'],
      'activated' => $oldAgeGroup['activated']
    );
    foreach($AgeGroupRow as $key => $value){
      if(true ==isset($ageGroup[$key]))
            $AgeGroupRow[$key]=$ageGroup[$key];
    }
    if($AgeGroupRow['position']<1)
      $AgeGroupRow['position']=1;
    $this->db->where('id_ages_goup', $ageGroup['id_ages_goup']);
    $this->db->update(self::TABLE_NAME, $AgeGroupRow);
  }
  function setDefaultName($name){
    $set = array('name' => $name);
    $this->db->where('id_ages_goup', 0);
    $this->db->update(self::TABLE_NAME, $set);
  }
  //====================Delete====================================

}
