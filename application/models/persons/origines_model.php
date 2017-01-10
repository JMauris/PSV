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
  function getFlatTree(){
    $mock = array('id' => 0,
                  'text' => 'Origine');
    $respons = array();
    $respons['0']="Originie non déclarée";
    $this->populateFlat($respons,$mock,'');

    return $respons;
  }
  function populateFlat(&$respons, &$daddy,$prefix){
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
}
