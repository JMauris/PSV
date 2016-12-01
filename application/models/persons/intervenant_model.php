<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Intervenant_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function getAllIntervenant(){

		$this->db->where('activated', 1);
    $this->db->where('group_id', 300);
    $query =$this->db->get('users');

    $intervenants = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $intervenants[$row['id']]= $row['username'];
    }
    return $intervenants;
  }
  function getIntervenantById($id){

    $this->db->where('id', $id);
    $query =$this->db->get('users');

    if ($query->num_rows() != 1){
        return null;
    }
    $row = $query->row(0);
    $intervenant = array(
      'id'=> $row->id,
      'username'=> $row->username
      );
    return $intervenant;
  }
}
