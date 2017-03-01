<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports_model extends CI_Model
{
    const direct = 'ola_direct';
    const undirect = 'ola_indirect';

  function __construct(){
    parent::__construct();
  }

  function updateCubes(){
    /*$query =$this->db->query('CALL direct_update_Report();');
    $query =$this->db->query('CALL indirect_update_Report();');*/

    $query =$this->db->query('CALL ola_compta_refresh();');
    $query =$this->db->query('CALL ola_criad_refresh();');
    $query =$this->db->query('CALL ola_prospreh_refresh();');
  //  $raw = $query->result_array();
  }

  function getAnnualDirectReport($year, $userId){
    $queryTxt =
      "SELECT intervenant_id, date, sum(duration) as duration, annonyme
      FROM ".self::direct."
      WHERE
        intervenant_id = ".$userId."
        AND date BETWEEN  '".($year-1)."-12-31' and  '".($year+1)."-01-01'
      GROUP BY date
      ORDER BY date ASC";
    $query = $this->db->query($queryTxt);
    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $raw[$key]['date']=fromSystemToUi($row['date']);
    return $raw;
  }
  function getAnnualProtpretReport($year){
    $queryTxt =
      "SELECT user_id, date, sum(duration) as duration, prestGrp, prest_id
      FROM ".self::undirect."
      WHERE
        date BETWEEN  '".($year-1)."-12-31' and  '".($year+1)."-01-01'
      GROUP BY date, prest_id
      ORDER BY date ASC";
    $query = $this->db->query($queryTxt);
    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $raw[$key]['date']=fromSystemToUi($row['date']);
    return $raw;
  }
  function getCompta($year){
    $this->db->where('year', $year);
    $this->db->order_by("month", "asc");
    $query =$this->db->get('ola_compta');
    $rows=  $query->result_array();
    $report = array();
    foreach ($rows as $row) {
      if(false == isset($report[$row['user']]))
        $report[$row['user']]= $this->_getComptaUser();
      $report[$row['user']][$row['month']]['duration']  += $row['duration'];
      $report[$row['user']][$row['month']]['km']        += $row['km'];
      $report[$row['user']][$row['month']]['extraCost'] += $row['extraCost'];
    }
    return $report;
  }
  function _getComptaUser(){
    $defaultUserReport = array(
      1=>0, 2=>0, 3=>0, 4=>0,
      5=>0, 6=>0, 7=>0, 8=>0,
      9=>0, 10=>0, 11=>0, 12=>0);
    foreach ($defaultUserReport as $key => $value)
      $defaultUserReport[$key] = array('duration' => 0, 'km' => 0,'extraCost' => 0);
    return $defaultUserReport;
  }

  function getCriad($year){
    $this->db->where('year', $year);
    $this->db->order_by("month", "asc");
    $query =$this->db->get('ola_criad');
    $rows=  $query->result_array();

    $rows=  $query->result_array();
    $report  = array();
    foreach ($rows as $row) {
      $trim =  floor(($row['month']-1)/3)+1;
      if(false == isset($report[$row['user']]))
        $report[$row['user']]=$this->_getCriadUser();
      $report[$row['user']][$trim] += $row['duration'];
    }
    return $report;
  }
  function _getCriadUser(){
    return array(1=>0, 2=>0, 3=>0 ,4=>0);
  }

  function getProspreh($year){
    $this->db->where('year', $year);
    $this->db->order_by("month", "asc");
    $query =$this->db->get('ola_prospreh');
    $rows=  $query->result_array();
    $report = array(1=>array(), 2=>array(), 3=>array() ,4=>array());
    foreach ($rows as $row) {
      $trim =  floor(($row['month']-1)/3)+1;
      $currentValue=0;
      if(isset($report[$trim][$row['prestGroupId']][$row['prest']]))
        $currentValue=0;
      $currentValue += $row['duration'];
      $report[$trim][$row['prestGroupId']][$row['prest']] = $currentValue;
    }
    return $report;
  }

}
