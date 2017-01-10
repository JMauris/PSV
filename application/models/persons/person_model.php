<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Person_Model extends CI_Model
{

  const TABLE_NAME = 'persons';
  const TABLE_INTERVENTION_LINK_NAME ='intervention_has_persons';

  //self::intervention_Table

  function __construct()
  {
    parent::__construct();
  }

  function insertPerson($name, $originId, $ageGroupId, $genderId, $sexualityId){
    $insertRow = array(
      'name' => $name,
      'declared_origine_id' => $originId,
      'age_group_id' => $ageGroupId,
      'gender_id' => $genderId,
      'sexuality_id' => $sexualityId,
     );
     $this->db->insert(self::TABLE_NAME, $insertRow);
     return $this->db->insert_id();
  }
  function getById($id){

    $this->db->where('id_Person', $id);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
        return null;
    }
    $row = $query->row(0);
    $person = array(
      'id_Person' => $row->id_Person,
      'name' => $row->name,
      'origine_id' => $row->declared_origine_id,
      'ageGroup_id' => $row->age_group_id,
      'gender_id' => $row->gender_id,
      'sexuality_id' => $row->sexuality_id,
     );
     $this->_populate($person);
    return $person;
  }
  function getByIntervention($id){
    $this->db->select('*');
    $this->db->from(self::TABLE_NAME);
    $likeClaus =self::TABLE_NAME.'.id_Person'
      .' = '
      . self::TABLE_INTERVENTION_LINK_NAME.'.person_id'
      ;
    $this->db->join(self::TABLE_INTERVENTION_LINK_NAME,$likeClaus );

    $this->db->where('intervention_id', $id);
    $query = $this->db->get();

    $persons = array();
    $rows = $query->result_array();
        foreach ($rows as $key => $row){
      $person = array(
        'id_Person' => $row['id_Person'],
        'name' => $row['name'],
        'origine_id' => $row['declared_origine_id'],
        'ageGroup_id' => $row['age_group_id'],
        'gender_id' => $row['gender_id'],
        'sexuality_id' => $row['sexuality_id']
       );
      $this->_populate($person);
      array_push($persons,$person);
    }
    return $persons;
  }
  function resolveName($name){
    $id;
    $this->db->where('name', $name);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
      $insertRow = array('name' => $name);
      $this->db->insert(self::TABLE_NAME, $insertRow);
      return $this->db->insert_id();
    }
    $row = $query->row(0);
    return $row->id_Person;
  }
  function update($person){
    $this->db->where('id_Person', $person['id_Person']);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);
    $row = array(
      'id_Person' => $raw->id_Person,
      'name' => $raw->name,
      'origine_id' => $raw->declared_origine_id,
      'ageGroup_id' => $raw->age_group_id,
      'gender_id' => $raw->gender_id,
      'sexuality_id' => $raw->sexuality_id,
     );
    foreach ($row as $fieldName => $fieldValue)
      if(true ==isset($person[$fieldName]))
        $row[$fieldName]=$person[$fieldName];
    {
      $row['declared_origine_id']=$row['origine_id'];
      unset($row['origine_id']);
      $row['age_group_id']=$row['ageGroup_id'];
      unset($row['ageGroup_id']);
    }
    $this->db->where('id_Person', $row['id_Person']);
    $this->db->update(self::TABLE_NAME, $row);
  }
  function _populate(&$person){
    $this->_addOrigine($person);
    $this->_addAgeGroup($person);
    $this->_addGender($person);
    $this->_addSexuality($person);
  }


  function _addOrigine(&$person){
    $origine = $this->origines_model->getById($person['origine_id']);
    $person['origine'] = $origine['name'];
  }
  function _addAgeGroup(&$person){
    $ageGroup = $this->agegroup_model->getById($person['ageGroup_id']);
    $person['ageGroup'] = $ageGroup['name'];
  }
  function _addGender(&$person){
    $gender = $this->gender_model->getById($person['gender_id']);
    $person['gender'] = $gender['name'];
  }
  function _addSexuality(&$person){
    $sexuality = $this->sexuality_model->getById($person['sexuality_id']);
    $person['sexuality'] = $sexuality['name'];
  }


}
