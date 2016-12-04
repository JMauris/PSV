<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Material_Model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  function getById($id){
    $this->db->where('id_material', $id);
    $query =$this->db->get('materials');

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);

    return array(
      'id_material' => $raw->id_material,
      'descr' => $raw->descr
      );
  }
  function getAll(){
    $this->db->where('actived', 1);
    $query =$this->db->get('materials');

    $materials = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $materials[$row['id_material']]= $row['descr'];
    }
    return $materials;
  }

  function insert(){

  }
  function update(){

  }

}
