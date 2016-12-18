<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Demarches_Model extends Intervention_Model
{
  function __construct(){
    parent::__construct();
  }
  function getFutursByIntervenant($id){
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('intervenant_id =', $id, FALSE);
    $this->db->where_in('kind_id',self::interventionTypes);
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
    $this->db->order_by("date", "desc");
    $this->db->where_in('kind_id',self::interventionTypes);
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
    $this->db->order_by("date", "desc");
    $this->db->where_in('kind_id',self::interventionTypes);
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
    $this->db->order_by("date", "desc");
    $this->db->where_in('kind_id',self::interventionTypes);
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

    $demarche = array(
      'id_intrevention'  => $raw->id_intrevention,
      'intervenant_id'  => $raw->intervenant_id,
      'date'            => $raw->date,
      'place_id'        => $raw->place_id,
      'duration'        => $raw->duration,
      'extraCost'       => $raw->extraCost,
      'distance'        => $raw->distance,
      'kind_id'         => $raw->kind_id
     );

    $this->_populate($demarche);

    return $demarche;
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
  function update($demarche){
    //search current data in db
    $olddemarche = $this->getById($demarche['id_intrevention']);
    $demarcheRow = array(
      'id_intrevention'  => $olddemarche['id_intrevention'],
      'intervenant_id'  => $olddemarche['intervenant_id'],
      'place_id'        => $olddemarche['place_id'],
      'date'            => $olddemarche['date'],
      'duration'        => $olddemarche['duration'],
      'extraCost'       => $olddemarche['extraCost'],
      'distance'        => $olddemarche['distance'],
      'kind_id'         => $olddemarche['kind_id']
    );
    foreach ($demarcheRow as $fieldName => $fieldValue) {
      if(true ==isset($demarche[$fieldName]))
        $demarcheRow[$fieldName]=$demarche[$fieldName];
    }
    $this->db->where('id_intrevention', $demarche['id_intrevention']);
    $this->db->update('intreventions', $demarcheRow);
    if(true == isset($demarche['thematics']))
      parent::_updateThematics( $demarche['id_intrevention'],$demarche['thematics']);
    if(true == isset($demarche['materials']))
      parent::_updateMaterials( $demarche['id_intrevention'],$demarche['materials']);
    if(true == isset($demarche['interventions']))
      foreach ($demarche['interventions'] as $key => $meeting)
        $this->meetings_model->update($meeting);
    if(true == isset($demarche['persons']))
      $this->_updatePersons( $demarche['id_intrevention'],$demarche['persons']);

    $query = $this->db->query('SELECT sum(duration) asInerDuration FROM intreventions WHERE parent='.$demarcheRow['id_intrevention'].';');
    $inerDuration = $query->row(0)->asInerDuration;
    $this->db->where('id_intrevention', $demarche['id_intrevention']);
    $this->db->update('intreventions',array('duration' => $demarche['duration']-$inerDuration ));
  }
  function _populate(&$demarche){
    parent::_populate($demarche);
    $this->_addMeet($demarche);
    foreach ($demarche['interventions'] as $key => $intervention)
      $demarche['duration']= $demarche['duration']+$intervention['duration'];
  }
  function _addPersons(&$intervention){
    $intervention['persons'] =
        $this->person_model->getByIntervention($intervention['id_intrevention']);
  }
  function _addMeet(&$intervention){
    $intervention['interventions']=
      $this->meetings_model->getByIntervention($intervention['id_intrevention']);

  }
  function _updatePersons($demarcheId, $personsArray){
    foreach ($personsArray as $key => $person)
      switch ($person['quickAction']) {
        case 'added':
            $this->_addPersonInDemarche($demarcheId,$person['id_Person']);
          break;
        case 'duplic':
            $this->_addNewPersonIndemarche($demarcheId,$person);
          break;
        case 'remove':
            $this->_removePersonInDemarche($demarcheId,$person['id_Person']);
          break;
        case 'addMeet':
            $this->_addInerMeeting($demarcheId,$person['id_Person']);
          break;
        case 'update':
            $this->person_model->update($person);
          break;
        }
  }
  function _addPersonIndemarche($demarcheId, $personsid){
    $row = array(
      'intervention_id' => $demarcheId ,
      'person_id' => $personsid
    );
    $this->db->insert(self::person_linkTable, $row);
  }
  function _addNewPersonInDemarche($demarcheId, $persons){
    $this->_addPersonIndemarche($demarcheId,
        $this->person_model->insertPerson(
          "",
          $persons['origine_id'],
          $persons['ageGroup_id'],
          $persons['gender_id'],
          $persons['sexuality_id']
        )
      );
  }
  function _removePersonInDemarche($demarcheId, $personsid){
    $this->db->where('intervention_id',$demarcheId);
    $this->db->where('person_id',$personsid);
    $this->db->delete(self::person_linkTable);

    $this->db->where('parent',$demarcheId);
    $this->db->where('person_id',$personsid);
    $this->db->delete(self::intervention_Table);
  }
  function _addInerMeeting($demarcheId, $personsid){
    $this->db->where('id_intrevention', $demarcheId);
    $query = $this->db->get(self::intervention_Table);
    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->row(0);
    $insertRow = array(
      'intervenant_id'  => $raw->intervenant_id,
      'date'            => $raw->date,
      'place_id'        => $raw->place_id,
      'kind_id'         => 3,
      'parent'          => $demarcheId,
      'person_id'       => $personsid

     );
     $this->db->insert(self::intervention_Table, $insertRow);

  }
}
