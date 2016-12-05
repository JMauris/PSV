<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Origines_Model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function getOriginsTree(){
    if ($query->num_rows() != 1)
    return NULL;

    $respons = array('id' => 0,
                  'text' => '');
    $this->populate($respons);

    return $respons;
  }


  function populate(&$daddy){
    $this->db->where('parent_id', $daddy['id']);
    $query = $this->db->get('origines');
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
}
