<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Indirect_Model extends CI_Model
{

  const indirect_Table      = 'indirect';
  const prestation_Link_LinkTable     = 'indirect_has_prestations';
  const called_LinkTable      = 'indirect_has_called';
  const called_join_claus ='indirect_has_called.user_id = users.id';
  const user_table = 'users';
  /*const kind_Table              = 'intrevention_kinds';
  const kind_join_claus         = 'intreventions.kind_id = intrevention_kinds.id_kind';
  const intervenant_Table       = 'users';
  const intervenant_join_claus  = 'intreventions.intervenant_id = users.id';
  const place_Table             = 'place';
  const place_join_claus        = 'intreventions.place_id = place.id_lieu';
  const thematics_LinkTable     = 'intervention_has_thematics';
  const material_LinkTable      = 'intrevention_has_material';
  const person_linkTable        = 'intervention_has_persons';
*/

  function __construct(){
    parent::__construct();
  }

  function getFuturByOwner($intervenant_id){
    $this->db->select('*');
    $this->db->from(self::indirect_Table);
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('owner', $intervenant_id);
    $query =$this->db->get();

    $raw = $query->result_array();
    foreach ($raw as $key => $indirect){
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getFuturs(){
    $this->db->select('*');
    $this->db->from(self::indirect_Table);
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $query =$this->db->get();

    $raw = $query->result_array();
    foreach ($raw as $key => $indirect){
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOldByOwner($intervenant_id){
    $this->db->select('*');
    $this->db->from(self::indirect_Table);
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('owner', $intervenant_id);
    $query =$this->db->get();

    $raw = $query->result_array();
    foreach ($raw as $key => $indirect){
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOlds(){
    $this->db->select('*');
    $this->db->from(self::indirect_Table);
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $query =$this->db->get();

    $raw = $query->result_array();
    foreach ($raw as $key => $indirect){
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getById($id){
    $this->db->select('*');
    $this->db->from(self::indirect_Table);
    $this->db->where('id_indirect', $id);
    $query =$this->db->get();
    if ($query->num_rows() != 1)
        return null;

    $raw = $query->result_array();
    $indirect = $raw[0];
    $this->_populate($indirect);

    return $indirect;

  }
  function _populate(&$indirect){
    $indirect['date']= fromSystemToUi($indirect['date']);
    $this->_populatePrest($indirect);
    $this->_populateCalled($indirect);
    $this->_populatePlace($indirect);
    $this->_populateOwner($indirect);
  }
  function _populatePrest(&$indirect){
    $Indirect['prestations'] = array();
    $this->db->select('*');
    $this->db->from(self::prestation_Link_LinkTable);
    $this->db->where('indirect_id', $indirect['id_indirect']);
    $query =$this->db->get();
    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $indirect['prestations'][$row['prestation_id']]=$row['duration'];
  }
  function _populateCalled(&$indirect){
    $Indirect['called'] = array();
    $this->db->select('users.username, users.id');
    $this->db->from(self::user_table);
    $this->db->join(self::called_LinkTable, self::called_join_claus);
    $this->db->where('indirect_id', $indirect['id_indirect']);
    $query =$this->db->get();
    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $indirect['called'][$row['id']]=$row['username'];
  }
  function _populatePlace(&$indirect){
    $indirect['place'] =
        $this->places_model->getById($indirect['place']);
  }
  function _populateOwner(&$indirect){
    $indirect['owner_id']= $indirect['owner'];
    $indirect['owner'] =
        $this->intervenant_model->getIntervenantById($indirect['owner']);
  }
  function insert($owner, $placeId, $date){
    $date= fromUiToSystem($date);
    $insertRow = array(
      'date' => $date,
      'place' => $placeId,
      'owner' => $owner
    );
    $this->db->insert(self::indirect_Table, $insertRow);
    return $this->db->insert_id();
  }
  function update($indirect){
    $id =  $indirect['id_indirect'];
    if(isset($indirect['date']))
      $indirect['date']=fromUiToSystem($indirect['date']);
    //search current data in db
    $this->db->select('*');
    $this->db->from(self::indirect_Table);
    $this->db->where('id_indirect', $id);
    $query =$this->db->get();
    if ($query->num_rows() != 1)
        return null;

    $raw = $query->result_array();
    $indirectRow = $raw[0];
    foreach ($indirectRow as $fieldName => $fieldValue) {
      if(true ==isset($indirect[$fieldName]))
        $indirectRow[$fieldName]=$indirect[$fieldName];
    }
    $this->db->where('id_indirect', $id);
    $this->db->update(self::indirect_Table, $indirectRow);

    if(true == isset($indirect['called']))
      $this->_updateCalled( $id,$indirect['called']);
    if(true == isset($indirect['prestations']))
      $this->_updatePrestations($id,$indirect['prestations']);

  }
  function _updateCalled($indirect_id, $called){
    $this->db->where('indirect_id',$indirect_id);
    $this->db->delete(self::called_LinkTable);
    foreach ($called as $id => $value) {
      $row = array(
        'indirect_id' => $indirect_id,
        'user_id' => $id
      );
      $this->db->insert(self::called_LinkTable, $row);
    }
  }
  function _updatePrestations($indirect_id, $prestations){
    $this->db->where('indirect_id',$indirect_id);
    $this->db->delete(self::prestation_Link_LinkTable);
    foreach ($prestations as $id => $duration) {
      if($duration>0){
        $row = array(
          'indirect_id' => $indirect_id,
          'prestation_id' => $id,
          'duration' => $duration,
        );
        $this->db->insert(self::prestation_Link_LinkTable, $row);
      }
    }
  }


}
