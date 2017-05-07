<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Origines_Model extends CI_Model
{
  const  TABLE_NAME = 'origines';
  function __construct()
  {
    parent::__construct();
  }

  function getTree(){
    $respons = array('id' => 0,
                  'text' => '');
    $this->populate($respons);

    return $respons;
  }

  function getAdminTree(){

    $this->db->where('id_origine',0);
    $query = $this->db->get(self::TABLE_NAME);
    if ($query->num_rows() == 0)
      return NULL;
    $rows = $query->result_array();
    $rows[0]['depth']= 0;
    $respons = array();
    array_push($respons, $rows[0]);
    $this->populateAdmin($respons, 0 , 1);

    return $respons;
  }

  function getFlatTree(){
    $this->db->where('id_origine',0);
    $query = $this->db->get(self::TABLE_NAME);
    if ($query->num_rows() == 0)
      return NULL;
    $rows = $query->result_array();

    $respons = array();
    $respons['0']=$rows['0']['name'];
    $this->populateFlat($respons,$mock,'');

    return $respons;
  }
  function populateFlat(&$respons, &$daddy,$prefix){
    $this->db->order_by("position", "asc");
    $this->db->where('actived', 1);
    $this->db->where('parent_id', $daddy['id']);
    $query = $this->db->get(self::TABLE_NAME);
    if ($query->num_rows() == 0)
      return NULL;

    $rows = $query->result_array();
    foreach ($rows as $row) {
      $temp = array('id' => $row['id_origine'],
                    'text' => $prefix.$row['name']);
      $respons[$temp['id']]=$temp['text'];
      $this->populateFlat($respons,$temp, $prefix."-");
      }
  }

  function populate(&$daddy){
    $this->db->where('parent_id', $daddy['id']);
    $this->db->where('actived', 1);
    $query = $this->db->get(self::TABLE_NAME);
    if ($query->num_rows() == 0)
      return NULL;

    $rows = $query->result_array();

    $children = array();
    foreach ($rows as $row) {
      $temp = array('id' => $row['id_origine'],
                    'text' => $row['name']);
      $this->populate($temp);
      array_push($children , $temp);
    }

    $daddy['children']=$children;
  }


  function populateAdmin(&$respons, $daddyID, $depth){
    $this->db->order_by("position", "asc");
    $this->db->where('parent_id', $daddyID);
    $query = $this->db->get(self::TABLE_NAME);
    if ($query->num_rows() == 0)
      return NULL;

    $rows = $query->result_array();
    foreach ($rows as $row) {
      $row['depth']= $depth;
      array_push($respons, $row);
      $this->populateAdmin($respons,$row['id_origine'], $depth+1);
    }


  }

  function getById($id){
    $this->db->where('id_origine', $id);
    $query =$this->db->get(self::TABLE_NAME);

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);

    return array(
      'id_origine' => $raw->id_origine,
      'name' => $raw->name,
      );

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
  //  var_dump($element);
    $this->db->select('*');
    $this->db->from(self::TABLE_NAME);
    $this->db->where('id_origine', $element['id_origine']);
    $query =$this->db->get();

    if ($query->num_rows() != 1)
        return;

    $origineRow = $query->result_array()[0];
    foreach($origineRow as $key => $value){
      if(true ==isset($element[$key]))
            $origineRow[$key]=$element[$key];
    }
    if($origineRow['position']<1)
      $origineRow['position']=1;
    if($origineRow['id_origine']==$origineRow['parent_id'])
      $origineRow['parent_id']=0;
    $this->db->where('id_origine', $origineRow['id_origine']);
    $this->db->update(self::TABLE_NAME, $origineRow);
    if(isset($element['children']))
      foreach ($element['children'] as $value)
        $this->updateElement($value);
  }
  function setDefaultName($name){
    $set = array('name' => $name);
    $this->db->where('id_origine', 0);
    $this->db->update(self::TABLE_NAME, $set);
  }

}
