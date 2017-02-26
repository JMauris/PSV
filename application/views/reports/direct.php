<?php //setup
  $monthName = array(
    1 => "JANVIER",   2 => "FÉVRIER",   3 => "MARS",
    4 => "AVRIL",     5 => "MAI",       6 => "JUIN",
    7 => "JUILLET",   8 => "AOÛT",      9 => "SEPTEMBRE",
    10 => "OCTOBRE",  11 => "NOVEMBRE", 12 => "DÉCEMBRE"

  );
?>
  <div id="report" class="container-fluid">
    <div class="row">
      <table class="table report-direct">
        <tbody>
          <?php for ($monthNumber=1; $monthNumber <= 12 ; ++$monthNumber):?>
            <tr>
              <td colspan="31"><b><?php echo $monthName[$monthNumber]; ?></b></td>
            </tr>
            <tr>
              <td><b>Saisies de prestations</b></td>
              <?php for ($day=1; $day<= 31 ; ++$day):?>
                <td><?php echo $day; ?></td>
              <?php endfor; ?>
            </tr>
            <tr>
              <td>Brefs conseils</td>
              <?php for ($day=1; $day<= 31 ; ++$day):?>
                <td class="report-direct-data_cell">
                  <?php
                    $value = '';
                    if(isset($report[$monthNumber][$day]))
                      $value = $report[$monthNumber][$day];
                    echo $value;
                  ?>
                </td>
              <?php endfor; ?>
            </tr>
            <tr>
              <tr colspan="31"> </td>
            </tr>
          <?php endfor ?>
        </tbody>
      </table>
    </div>
  </div>
