<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Intervention_Model extends CI_Model
{
  const meetingTypes            = array(1, 2,3);
  const interventionTypes       = array(4);
  const intervention_Table      = 'intreventions';
  const kind_Table              = 'intrevention_kinds';
  const kind_join_claus         = 'intreventions.kind_id = intrevention_kinds.id_kind';
  const intervenant_Table       = 'users';
  const intervenant_join_claus  = 'intreventions.intervenant_id = users.id';
  /*const place_Table             = 'place';
  const place_join_claus        = 'intreventions.place_id = place.id_lieu';*/
  const thematics_LinkTable     = 'intervention_has_thematics';
  const material_LinkTable      = 'intrevention_has_material';
  const person_linkTable        = 'intervention_has_persons';
  const placeKind_Table='place_kind';
  const placeKind_join_claus ='intreventions.place_id = place_kind.id_kind';
  const groupSelectClaus =
    self::intervention_Table.'.id_intrevention, '.
    self::intervention_Table.'.kind_id, '.
    self::intervention_Table.'.date, '.
    self::intervenant_Table.'.username, '.
    self::placeKind_Table.'.descr';

  function __construct(){
    parent::__construct();
  }

  function getFutursByIntervenant($id){
    $this->db->select(self::groupSelectClaus);
    $this->db->from(self::intervention_Table);
    $this->db->join(self::intervenant_Table, self::intervenant_join_claus);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::placeKind_Table, self::placeKind_join_claus);
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('intervenant_id', $id);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    $respons = array();
    foreach ($raw as $key => $row) {
      $row['date']=fromSystemToUi($row['date']);
      if($row['kind_id']==4)
        $row['subClass']='demarche';
      else
        $row['subClass']='meeting';
      $respons[$raw[$key]['date'].'int'.$row['id_intrevention']]=$row;
    }
    return $respons;
  }
  function getOldByIntervenant($id){
    $this->db->select(self::groupSelectClaus);
    $this->db->from(self::intervention_Table);
    $this->db->join(self::intervenant_Table, self::intervenant_join_claus);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::placeKind_Table, self::placeKind_join_claus);
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('intervenant_id', $id);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    $respons = array();
    foreach ($raw as $key => $row) {
      $row['date']=fromSystemToUi($row['date']);
      if($row['kind_id']==4)
        $row['subClass']='demarche';
      else
        $row['subClass']='meeting';
      $respons[$raw[$key]['date'].'int'.$row['id_intrevention']]=$row;
    }
    return $respons;
  }
  function getFuturs(){
    $this->db->select(self::groupSelectClaus);
    $this->db->from(self::intervention_Table);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::intervenant_Table, self::intervenant_join_claus);
    $this->db->join(self::placeKind_Table, self::placeKind_join_claus);
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    $respons = array();
    foreach ($raw as $key => $row) {
      $row['date']=fromSystemToUi($row['date']);
      if($row['kind_id']==4)
        $row['subClass']='demarche';
      else
        $row['subClass']='meeting';
      $respons[$raw[$key]['date'].'int'.$row['id_intrevention']]=$row;
    }
    return $respons;
  }
  function getOld(){
    $this->db->select(self::groupSelectClaus);
    $this->db->from(self::intervention_Table);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::intervenant_Table, self::intervenant_join_claus);
    $this->db->join(self::placeKind_Table, self::placeKind_join_claus);
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    $respons = array();
    foreach ($raw as $key => $row) {
      $row['date']=fromSystemToUi($row['date']);
      if($row['kind_id']==4)
        $row['subClass']='demarche';
      else
        $row['subClass']='meeting';
      $respons[$raw[$key]['date'].'int'.$row['id_intrevention']]=$row;
    }
    return $respons;
  }
  function getTimeByIntervenant($intervenantId, $year){


    $txtz = "SELECT date, duration FROM `intreventions`
WHERE intervenant_id =".$intervenantId."
and date BETWEEN  '".($year-1)."-12-31' and  '".($year+1)."-01-01'";
  var_dump($txtz);
    $botomBound = ($year-1) ."-12-31";
    $upBound = ($year+1) ."-01-01";



    $this->db->select(self::intervention_Table.'.date, duration');
    $this->db->from(self::intervention_Table);
    $this->db->where('intervenant_id', $intervenantId);
    $this->db->where('date <', $botomBound, FALSE);
    $this->db->where('date >', $upBound, FALSE);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    return $raw;
  }

  function _delete(&$intervention){
    $this->db->where('id_intrevention',$intervention['id_intrevention']);
    $this->db->delete(self::intervention_Table);

  }
  function _populate(&$intervention){
    $intervention['date']=fromSystemToUi($intervention['date']);
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
    $intervention['kind'] = $kind[0];
  }
  function _addPlace(&$intervention){
    $intervention['place'] =
        $this->placekinds_model->getById($intervention['place_id']);
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
