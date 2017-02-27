<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Thematics_Model extends CI_Model
{
  const  TABLE_NAME = 'thematics';
  function __construct() {
    parent::__construct();
  }

  function getTree(){

    $respons = array('id' => 0,
                  'text' => '');
    $this->populate($respons);

    return $respons;
  }
  function getAdminTree(){

    $respons = array('id_thematic' => 0,
                  'name' => 'racine');
    $this->populateAdmin($respons);

    return $respons;
  }

  function populate(&$daddy){
    $this->db->order_by("position", "asc");
    $this->db->where('parent_id', $daddy['id']);
    $this->db->where('isActiv', 1);
    $query = $this->db->get('thematics');
    if ($query->num_rows() == 0)
      return NULL;

    $rows = $query->result_array();

    $children = array();
    foreach ($rows as $row) {
      $temp = array('id' => $row['id_thematic'],
                    'text' => $row['name']);
      $this->populate($temp);
      array_push($children , $temp);
    }


    $daddy['children']=$children;

  }
  function populateAdmin(&$daddy){
    $this->db->order_by("position", "asc");
    $this->db->where('parent_id', $daddy['id_thematic']);
    $query = $this->db->get(self::TABLE_NAME);
    if ($query->num_rows() == 0)
      return NULL;

    $rows = $query->result_array();

    $children = array();
    foreach ($rows as $row) {
      $this->populateAdmin($row);
      $children[$row['id_thematic']]=$row;
    }


    $daddy['children']=$children;

  }
  function insert($parentId, $name){
    $row = array(
      'name' => $name,
      'parent_id' => $parentId
      );
   $this->db->insert(self::TABLE_NAME,$row);
  }


  function updateTree($tree){
    foreach ($tree['children'] as $value)
      $this->updateElement($value);

  }
  function updateElement($element){
    $this->db->select('*');
    $this->db->from(self::TABLE_NAME);
    $this->db->where('id_thematic', $element['id_thematic']);
    $query =$this->db->get();

    if ($query->num_rows() != 1)
        return;

    $themaRow = $query->result_array()[0];
    foreach($themaRow as $key => $value){
      if(true ==isset($element[$key]))
            $themaRow[$key]=$element[$key];
    }
    if($themaRow['position']<1)
      $themaRow['position']=1;
    $this->db->where('id_thematic', $themaRow['id_thematic']);
    $this->db->update(self::TABLE_NAME, $themaRow);
    if(isset($element['children']))
      foreach ($element['children'] as $value)
        $this->updateElement($value);
  }
}
