<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Intervention_Model extends CI_Model
{

  const intervention_Table   = 'intreventions';
  const thematics_LinkTable  = 'intervention_has_thematics';
  const material_LinkTable   = 'intrevention_has_material';
  const person_linkTable     = 'intervention_has_persons';


  function __construct(){
    parent::__construct();
  }
  function _delete(&$intervention){
    $this->db->where('id_intrevention',$intervention['id_intrevention']);
    $this->db->delete(self::intervention_Table);

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
}
