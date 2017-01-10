<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Intervenant_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function getSelector(){
    $this->db->where('activated', 1);
    //$this->db->where('group_id', 300);
    $query =$this->db->get('users');

    $intervenants = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $intervenants[$row['id']]= $row['username'];
    }
    return $intervenants;
  }
  function getAllIntervenant(){

		$this->db->where('activated', 1);
    //$this->db->where('group_id', 300);
    $query =$this->db->get('users');

    $intervenants = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $intervenants[$row['id']]= $row['username'];
    }
    return $intervenants;
  }

    function getAllFullIntervenant(){
        $query =$this->db->get('users');

      $intervenants = array();
      $rows = $query->result_array();
      foreach ($rows as $key => $row) {
        $intervenant = array(
            'id'        => $row['id'],
            'activated' => $row['activated'],
            'username'  => $row['username'],
            'email'     => $row['email'],
            'group_id'  => $row['group_id']
            );
          $intervenants[$row['id']]=  $intervenant;
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
      'activated'=> $row->activated,
      'username'=> $row->username,
      'email' =>$row->email,
      'group_id' => $row->group_id
      );
    return $intervenant;
  }

  function update($intervenant)
  {
    $oldUser = $this->getIntervenantById($intervenant['id']);
    $userRow = array(
      'id'        => $oldUser['id'],
      'activated' => $oldUser['activated'],
      'username'  => $oldUser['username'],
      'email'     => $oldUser['email'],
      'group_id'  => $oldUser['group_id']);

      foreach ($userRow as $key => $value) {
      if(true ==isset($intervenant[$key]))
          $userRow[$key]=$intervenant[$key];
      }
    $this->db->where('id', $intervenant['id']);
    $this->db->update('users', $userRow);
  }
}
