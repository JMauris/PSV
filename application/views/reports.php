<?php //setup
$monthName = array(
  1 => "janvier",   2 => "février",   3 => "mars",
  4 => "avril",     5 => "mai",       6 => "juin",
  7 => "juillet",   8 => "août",      9 => "septembre",
  10 => "octobre",  11 => "novembre", 12 => "décembre");
$comptaLine = array(
  'duration' => 'Durée des interventions',
  'km' => 'Km',
  'extraCost' => 'Notte de frais'
  );
?>
<div class="container">
  <div>
    <?php
      echo anchor(
        "reports/updateCubes",
        'Rafraichir les rapports',
        "class='btn btn-warning col-xs-12'");
    ?>
  </div>
  <div id="report" class="container-fluid prospreh-report">
    <div class="col-xs-12">
      <div class="row">
        <h3>Comptabilité</h3>
        <table class="table">
          <thead>
            <tr>
              <th/>
              <?php for ($cpt=1; $cpt <=12 ; $cpt++):?>
                <th><?php echo $monthName[$cpt]; ?></th>
              <?php endfor; ?>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($compta as $intervenant => $report):?>
              <tr>
                <td colspan="14"><?php echo $intervenant; ?></td>
              </tr>
              <?php foreach ($comptaLine as $reportLine => $descr): ?>
                <tr>
                  <td><?php echo $descr; ?></td>
                  <?php $sum=0; for ($cpt=1; $cpt <=12 ; $cpt++):?>
                    <td>
                      <?php
                        $value = $report[$cpt][$reportLine];
                        $sum+= $value;
                        if($value >0)
                          echo $value;
                      ?>
                    </td>
                  <?php endfor; ?>
                  <td><?php echo $sum; ?></td>
                </tr>
              <?php endforeach; ?>
              <tr class="groupRow"> <td colspan="14">&nbsp</td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="row">
        <h3>conseil et aides</h3>
        <table class="table">
          <thead>
            <tr>
              <th></th>
                <th>1er trimestre</th>
                <th>2eme trimestre</th>
                <th>3eme trimestre</th>
                <th>4eme trimestre</th>
                <th>BC</th>
                <th>Heures (25%)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($criad as $intervenant => $report):?>
              <tr>
                <td><?php echo $intervenant; ?></td>
                <?php $sum=0; for ($cpt=1; $cpt <=4 ; $cpt++):?>
                  <td>
                    <?php
                      $value = $report[$cpt];
                      $sum+= $value;
                      if($value >0)
                        echo $value;
                    ?>
                  </td>
                <?php endfor; ?>
                <td><?php echo $sum; ?></td>
                <td><?php echo $sum*4; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="row">
        <h3>PROSPREH</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Prestation</th>
                <th class="trim">1er trimestre</th>
                <th class="trim">2eme trimestre</th>
                <th class="trim">3eme trimestre</th>
                <th class="trim">4eme trimestre</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prospreh['meta'] as $groupId => $group): ?>
              <tr class="groupRow">
                <td colspan="5"><?php echo $group['presstationGroup_descr']; ?></td>
                <?php $linbr=0; foreach ($group['prestations'] as $prestId => $prest): ?>
                  <tr class="prestRow-<?php ++$linbr; if($linbr%2==0):?>odd<?php else:?>even<?php endif?>">
                    <td><?php echo $prest['descr']; ?></td>
                    <?php for ($trimnum=1; $trimnum <=4 ; $trimnum++): ?>
                      <td>
                        <?php
                        if(isset($prospreh['trim'][$trimnum][$groupId][$prestId]))
                          echo round($prospreh['trim'][$trimnum][$groupId][$prestId],2);
                        ?>
                      </td>
                    <?php endfor; ?>
                  </tr>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
