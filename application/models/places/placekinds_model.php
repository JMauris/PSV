<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Placekinds_Model extends CI_Model
{
  const  TABLE_NAME             = 'place_kind';


  function __construct(){
    parent::__construct();
  }
  //====================Selection=================================
  function getAllFullKinds(){
    $this->db->order_by("position", "asc");
    $query =$this->db->get(self::TABLE_NAME);

    $kinds = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $kind = array(
        'id_kind' =>$row['id_kind'],
        'descr' => $row['descr'],
        'kind_actived' => $row['kind_actived'],
        'position' => $row['position']);
      $kinds[$row['id_kind']]= $kind;
    }
    return $kinds;
  }
  function getSelector(){
    $this->db->order_by("position", "asc");
    $this->db->where('kind_actived', 1);
    $query =$this->db->get(self::TABLE_NAME);

    $activs = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $activs[$row['id_kind']]= $row['descr'];
    }
    return $activs;
  }
  function getById($id){
    $this->db->where('id_kind', $id);
    $query =$this->db->get(self::TABLE_NAME);
    if ($query->num_rows() != 1){
        return null;
    }
    $rows = $query->result_array();
    return $rows[0];
  }
  //====================Insertion=================================
  function insert($name){
    $inserted = array('descr' => $name);
    return $this->db->insert(self::TABLE_NAME, $inserted);
  }
  //====================Update====================================
  function update($kind){
    $this->db->where('id_kind', $kind['id_kind']);
    $query =$this->db->get(self::TABLE_NAME);
    if ($query->num_rows() != 1){
        return null;
    }
    $rows = $query->result_array();
    $kindRow = $rows[0];
    foreach($kindRow as $key => $value){
      if(true ==isset($kind[$key]))
            $kindRow[$key]=$kind[$key];
    }
    if($kindRow['position']<1)
      $kindRow['position']=1;
    $this->db->where('id_kind', $kindRow['id_kind']);
    $this->db->update(self::TABLE_NAME, $kindRow);
  }
  function setDefaultName($name){
    $set = array('descr' => $name);
    $this->db->where('id_kind', 0);
    $this->db->update(self::TABLE_NAME, $set);
  }
  //====================Delete====================================
  //====================Internal==================================

}
