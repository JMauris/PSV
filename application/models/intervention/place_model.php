<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Place_Model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  function getById($id){
    $this->db->where('id_lieu', $id);
    $query =$this->db->get('place');

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);

    return array(
      'id_lieu' => $raw->id_lieu,
      'Name' => $raw->Name,
      'kind' => $raw->kind,
      'adresse' => $raw->adresse
      );

  }
  function getAll(){
    $this->db->where('actived', 1);
    $query =$this->db->get('place');

    $places = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $places[$row['id_lieu']]= $row['Name'];
    }
    return $places;
  }

  function getAllKind(){
    $query =$this->db->get('place_kind');
    $kinds = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $kinds[$row['id_kind']]= $row['descr'];
    }
    return $kinds;
  }

  function insert(){

  }
  function update(){

  }
}
