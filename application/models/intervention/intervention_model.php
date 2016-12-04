<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Intervention_Model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function getFuturs(){
    $this->db->where('date >=', 'NOW()', FALSE);
    $query = $this->db->get('intreventions');
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOld(){
    $this->db->where('date <', 'NOW()', FALSE);
    $query = $this->db->get('intreventions');
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getById($value)
  {
    $this->db->where('id_intrevention', $value);
    $query = $this->db->get('intreventions');

    if ($query->num_rows() != 1){
        return null;
    }

    $raw = $query->row(0);

    $intervention = array(
      'id_intrevention'  => $raw->id_intrevention,
      'intervenant_id'  => $raw->intervenant_id,
      'date'            => $raw->date,
      'place_id'        => $raw->place_id,
      'duration'        => $raw->duration,
      'extraCost'       => $raw->extraCost,
      'distance'       => $raw->distance,
      'kind_id'         => $raw->kind_id
     );

    $this->_populate($intervention);

    return $intervention;
  }
  function insert($intervenant_id, $date, $place_id, $kind_id){
    $insertRow = array(
      'intervenant_id' => $intervenant_id,
      'date' => $date,
      'place_id' => $place_id,
      'kind_id' => $kind_id
     );
     $this->db->insert('intreventions', $insertRow);
  }
  function update($intervention){
    $insertRow = array(
      'intervenant_id' => $intervention['intervenant']['id'],
      'date' => $intervention['date'],
      'place_id' => $intervention['place']['id'],
      'duration' => $intervention['duration'],
      'extraCost' => $intervention['extraCost'],
      'kind_id' => $intervention['kind']['id']
     );
    $this->db->where('id_intrevention', $intervention['id_intrevention']);
    $this->db->update('intreventions', $insertRow);
  }
  function _populate(&$intervention){
    $this->db->where('id_kind', $intervention['kind_id']);
    $query = $this->db->get('intrevention_kinds');
    $kind = $query->result_array(0);

    $intervention['intervenant'] =
        $this->intervenant_model->getIntervenantById($intervention['intervenant_id']);
    $intervention['place'] =
        $this->place_model->getById($intervention['place_id']);
    $intervention['kind'] = $kind;
    }
}
