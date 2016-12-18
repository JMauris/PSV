<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Meetings_Model extends Intervention_Model
{

  function __construct() {
    parent::__construct();
  }
  function getFutursByIntervenant($id){
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('intervenant_id =', $id, FALSE);
    $this->db->where_in('kind_id',self::meetingTypes);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOldByIntervenant($id){
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('intervenant_id =', $id, FALSE);
    $this->db->where_in('kind_id',self::meetingTypes);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getFuturs(){
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('parent', null);
    $this->db->where_in('kind_id',self::meetingTypes);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOld(){
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('parent', null);
    $this->db->where_in('kind_id',self::meetingTypes);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getById($value){
    $this->db->where('id_intrevention', $value);
    $query = $this->db->get(self::intervention_Table);

    if ($query->num_rows() != 1){
        return null;
    }

    $raw = $query->row(0);

    $meeting = array(
      'id_intrevention'  => $raw->id_intrevention,
      'intervenant_id'  => $raw->intervenant_id,
      'date'            => $raw->date,
      'place_id'        => $raw->place_id,
      'duration'        => $raw->duration,
      'extraCost'       => $raw->extraCost,
      'distance'        => $raw->distance,
      'kind_id'         => $raw->kind_id,
      'person_id'         => $raw->person_id
     );

    $this->_populate($meeting);

    return $meeting;
  }
  function getByIntervention($id){
    $this->db->where('parent', $id);
    $query = $this->db->get(self::intervention_Table);

    $interventions = array();
    $rows = $query->result_array();
    foreach ($rows as $key => $row) {
      $meet= array(
        'id_intrevention'  => $row['id_intrevention'],
        'intervenant_id'  => $row['intervenant_id'],
        'date'            => $row['date'],
        'place_id'        => $row['place_id'],
        'duration'        => $row['duration'],
        'extraCost'       => $row['extraCost'],
        'distance'        => $row['distance'],
        'kind_id'         => $row['kind_id'],
        'person_id'       => $row['person_id']
       );
      $this->_populate($meet);
      $interventions[$meet['person_id']] =$meet;
    }
    return $interventions;
  }
  function insert($intervenant_id, $date, $place_id, $kind_id){
    $insertRow = array(
      'intervenant_id' => $intervenant_id,
      'date' => $date,
      'place_id' => $place_id,
      'kind_id' => $kind_id
     );
     return $this->db->insert(self::intervention_Table, $insertRow);
  }
  function update($meeting){
    //search current data in db
    $oldmeeting = $this->getById($meeting['id_intrevention']);
    $meetingRow = array(
      'id_intrevention'  => $oldmeeting['id_intrevention'],
      'intervenant_id'  => $oldmeeting['intervenant_id'],
      'place_id'        => $oldmeeting['place_id'],
      'date'            => $oldmeeting['date'],
      'duration'        => $oldmeeting['duration'],
      'extraCost'       => $oldmeeting['extraCost'],
      'distance'        => $oldmeeting['distance'],
      'person_id'        => $oldmeeting['person_id'],
      'kind_id'         => $oldmeeting['kind_id']
    );
    foreach ($meetingRow as $fieldName => $fieldValue) {
      if(true ==isset($meeting[$fieldName]))
        $meetingRow[$fieldName]=$meeting[$fieldName];
    }
    $this->db->where('id_intrevention', $meeting['id_intrevention']);
    $this->db->update('intreventions', $meetingRow);
    if(true == isset($meeting['thematics']))
      parent::_updateThematics( $meeting['id_intrevention'],$meeting['thematics']);
    if(true == isset($meeting['materials']))
      parent::_updateMaterials( $meeting['id_intrevention'],$meeting['materials']);
  }
  function _populate(&$meeting){
    parent::_populate($meeting);
  }
  function _addPersons(&$meeting){
    if(false==($meeting['person_id']==null))
      $meeting['person'] =
          $this->person_model->getById($meeting['person_id']);
  }
}
