<?php //setup
  $monthName = array(
    1 => "Janvier",   2 => "Février",   3 => "Mars",
    4 => "Avril",     5 => "Mai",       6 => "Juin",
    7 => "Juillet",   8 => "Août",      9 => "Septembre",
    10 => "Octobre",  11 => "Novembre", 12 => "Décembre"
  );
?>
  <div id="report" class="container-fluid">
    <div class="row">
      <table class="table" bgcolor="white">
        <tbody>
          <?php for ($monthNumber=1; $monthNumber <= 12 ; ++$monthNumber):?>
            <tr>
              <td colspan="31"><?php echo $monthName[$monthNumber]; ?></td>
            </tr>
            <tr>
              <?php for ($day=1; $day<= 31 ; ++$day):?>
                <td><?php echo $day; ?></td>
              <?php endfor; ?>
            </tr>
            <tr>
              <?php for ($day=1; $day<= 31 ; ++$day):?>
                <td>
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
