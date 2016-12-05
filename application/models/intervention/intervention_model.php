<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Intervention_Model extends CI_Model
{

  const intervention_Table   = 'intreventions';
  const thematics_LinkTable  = 'intervention_has_thematics';
  const material_LinkTable   = 'intrevention_has_material';
  const person_linkTable     = 'intervention_has_persons';
  function __construct()
  {
    parent::__construct();
  }
  function getFuturs_OnlyMine($id){
    $this->db->where('date >=', 'NOW()', FALSE);
    $this->db->where('intervenant_id =', $id, FALSE);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOld_OnlyMine($id){
    $this->db->where('date <', 'NOW()', FALSE);
    $this->db->where('intervenant_id =', $id, FALSE);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getFuturs(){
    $this->db->where('date >=', 'NOW()', FALSE);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getOld(){
    $this->db->where('date <', 'NOW()', FALSE);
    $this->db->order_by("date", "desc");
    $query = $this->db->get(self::intervention_Table);
    $raw = $query->result_array();
    foreach ($raw as $key => $value) {
      $this->_populate($raw[$key]);
    }
    return $raw;
  }
  function getById($value)
  {
    $this->db->where('id_intrevention', $value);
    $query = $this->db->get(self::intervention_Table);

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
      'distance'        => $raw->distance,
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
    //search current data in db
    $oldIntervention = $this->getById($intervention['id_intrevention']);
    $interventionRow = array(
      'id_intrevention'  => $oldIntervention['id_intrevention'],
      'intervenant_id'  => $oldIntervention['intervenant_id'],
      'place_id'        => $oldIntervention['place_id'],
      'date'            => $oldIntervention['date'],
      'duration'        => $oldIntervention['duration'],
      'extraCost'       => $oldIntervention['extraCost'],
      'distance'        => $oldIntervention['distance'],
      'kind_id'         => $oldIntervention['kind_id']
    );
    foreach ($interventionRow as $fieldName => $fieldValue) {
      if(true ==isset($intervention[$fieldName]))
        $interventionRow[$fieldName]=$intervention[$fieldName];
    }
    $this->db->where('id_intrevention', $intervention['id_intrevention']);
    $this->db->update('intreventions', $interventionRow);
    if(true == isset($intervention['thematics']))
      $this->_updateThematics( $intervention['id_intrevention'],$intervention['thematics']);
    if(true == isset($intervention['materials']))
      $this->_updateMaterials( $intervention['id_intrevention'],$intervention['materials']);
    if(true == isset($intervention['persons']))
      $this->_updatePersons( $intervention['id_intrevention'],$intervention['persons']);
  }



  function _populate(&$intervention){
    $this->_addIntervenant($intervention);
    $this->_addKind($intervention);
    $this->_addPlace($intervention);
    $this->_addMaterial($intervention);
    $this->_addThematics($intervention);
    $this->_addPersons($intervention);
    }
    function _addIntervenant(&$intervention){
      $intervention['intervenant'] =
          $this->intervenant_model->getIntervenantById($intervention['intervenant_id']);
    }
    function _addKind(&$intervention){
      $this->db->where('id_kind', $intervention['kind_id']);
      $query = $this->db->get('intrevention_kinds');
      $kind = $query->result_array(0);
      $intervention['kind'] = $kind;
    }
    function _addPlace(&$intervention){
      $intervention['place'] =
          $this->place_model->getById($intervention['place_id']);
    }
    function _addMaterial(&$intervention){
      $this->db->where('intrevention_id', $intervention['id_intrevention']);
      $query = $this->db->get(self::material_LinkTable);
      $rows = $query->result_array();
      $materialsForInter= array();
      foreach ($rows as $key => $row) {
        $materialsForInter[$row['material_id']]=$row['quantity'];
      }
      $intervention['materials']=$materialsForInter;
    }
    function _addThematics(&$intervention){
      $this->db->where('intervention_id', $intervention['id_intrevention']);
      $query = $this->db->get('intervention_has_thematics');
      $rows = $query->result_array();
      $thematics= array();
      foreach ($rows as $key => $row) {
          array_push($thematics, $row['thematic_id']);
      }
      $intervention['thematics']=$thematics;
    }
    function _addPersons(&$intervention){
      $intervention['persons'] =
          $this->person_model->getByIntervention($intervention['id_intrevention']);
    }
    function _updateThematics($interventionId, $thematicsIdsArray){

      $this->db->where('intervention_id',$interventionId);
      $this->db->delete(self::thematics_LinkTable);
      foreach ($thematicsIdsArray as $key => $value) {
        $row = array(
          'intervention_id' => $interventionId,
          'thematic_id' => $value
        );
        $this->db->insert(self::thematics_LinkTable, $row);
      }
    }
    function _updateMaterials($interventionId, $materialsArray){
      $this->db->where('intrevention_id',$interventionId);
      $this->db->delete(self::material_LinkTable);
      foreach ($materialsArray as $key => $value) {
        if($value >0){
          $row = array(
            'intrevention_id' => $interventionId,
            'material_id' => $key ,
            'quantity' => $value
          );
          $this->db->insert(self::material_LinkTable, $row);
        }
      }
    }
    function _updatePersons($interventionId, $personsArray){
      foreach ($personsArray as $key => $person)
        switch ($person['quickAction']) {
          case 'added':
              $this->_addPersonInIntervention($interventionId,$person['id_Person']);
            break;
          case 'duplic':
              $this->_addNewPersonInIntervention($interventionId,$person);
            break;
          case 'remove':
              $this->_addPersonInIntervention($interventionId,$person['id_Person']);
            break;
          case 'addMeet':
              $this->_addPersonInIntervention($interventionId,$person['id_Person']);
            break;

          }
    }
    function _addPersonInIntervention($interventionId, $personsid){
      $row = array(
        'intervention_id' => $interventionId ,
        'person_id' => $personsid
      );
      $this->db->insert(self::person_linkTable, $row);
    }
    function _addNewPersonInIntervention($interventionId, $persons){
      $this->_addPersonInIntervention($interventionId,
          $this->person_model->insertPerson(
            "",
            $persons['origine_id'],
            $persons['ageGroup_id'],
            $persons['gender_id'],
            $persons['sexuality_id']
          )
        );
    }
    function _removePersonInIntervention($interventionId, $personsid){
      $this->db->where('intervention_id',$interventionId);
      $this->db->where('person_id',$personsid);
      $this->db->delete(self::thematics_LinkTable);
    }
    function _addInerIntervention($interventionId, $personsid){
        $toto;
    }
}
