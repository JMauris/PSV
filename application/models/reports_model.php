<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports_model extends CI_Model
{
    const direct = 'ola_direct';
    const undirect = 'ola_indirect';

  function __construct(){
    parent::__construct();
  }

  function updateCubes(){
    $query =$this->db->query('CALL direct_update_Report();');
    $query =$this->db->query('CALL indirect_update_Report();');
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
  function getAnnualProtpretReport($year, $userId){
    $queryTxt =
      "SELECT user_id, date, sum(duration) as duration, prestGrp, prest_id
      FROM ".self::undirect."
      WHERE
        user_id = ".$userId."
        AND date BETWEEN  '".($year-1)."-12-31' and  '".($year+1)."-01-01'
      GROUP BY date, prest_id
      ORDER BY date ASC";
    $query = $this->db->query($queryTxt);
    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $raw[$key]['date']=fromSystemToUi($row['date']);
    return $raw;
  }

}
