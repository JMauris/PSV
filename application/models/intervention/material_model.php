<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Material_Model extends CI_Model
{

  const  TABLE_NAME = 'materials';

  function __construct() {
    parent::__construct();
  }
  function getById($id){
    $this->db->where('id_material', $id);
    $query =$this->db->get(self::TABLE_NAME);

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

    $this->db->order_by("position", "asc");
    $this->db->where('actived', 1);
    $query =$this->db->get(self::TABLE_NAME);

    $materials = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $materials[$row['id_material']]= $row['descr'];
    }
    return $materials;
  }
  function getAllForAdmin(){
    $this->db->order_by("position", "asc");
    $query =$this->db->get(self::TABLE_NAME);

    $rows = $query->result_array();

    return $rows;
  }

  function insert($descr){
    $row = array('descr' => $descr );
   $this->db->insert(self::TABLE_NAME,$row);

  }
  function update($material){
    $this->db->select('*');
    $this->db->from(self::TABLE_NAME);
    $this->db->where('id_material', $material['id_material']);
    $query =$this->db->get();

    if ($query->num_rows() != 1)
        return;

    $matRow = $query->result_array()[0];
    foreach($matRow as $key => $value){
      if(true ==isset($material[$key]))
            $matRow[$key]=$material[$key];
    }
    if($matRow['position']<1)
      $matRow['position']=1;
    $this->db->where('id_material', $matRow['id_material']);
    $this->db->update(self::TABLE_NAME, $matRow);
  }

}
