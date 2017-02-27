<?php //setup
  $linbr;
  $datacolunCount=0;
?>
  <div id="report" class="container-fluid prospreh-report">
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th>Prestation</th>
            <?php foreach ($report['trim'] as $trimNumber => $unUsedVariable): ?>
              <th class="trim">Trimestre&nbsp<?php echo $trimNumber; ?></th>
            <?php ++$datacolunCount; endforeach; ?>
            <th/>
            <?php foreach ($report['day'] as $monthNumber => $month): ?>
              <?php foreach ($month as $daynumber => $unUsedVariable): ?>
                <th class="day">
                  <?php $Mcom=""; if($monthNumber<10)$Mcom='0'; $Dcom=""; if($daynumber<10)$Dcom='0'; echo $Dcom.$daynumber.'-'.$Mcom. $monthNumber; ?></th>
              <?php ++$datacolunCount; endforeach; ?>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($report['meta'] as $groupId => $group): ?>
            <tr class="groupRow">
              <td style="background-color: silver;"><?php echo $group['presstationGroup_descr']; ?></td>
              <?php for ($column=0; $column <=$datacolunCount; $column++) : ?>
                <td>&nbsp</td>
              <?php endfor; ?>
              <?php $linbr=0; foreach ($group['prestations'] as $prestId => $prest): ?>
                <tr class="prestRow-<?php ++$linbr; if($linbr%2==0):?>odd<?php else:?>even<?php endif?>">
                  <td><?php echo $prest['descr']; ?></td>
                  <?php foreach ($report['trim'] as $trimNumber => $trimContent): ?>
                    <td>
                      <?php
                      if(isset($trimContent[$groupId][$prestId]))
                        echo round($trimContent[$groupId][$prestId],2);
                      ?>
                    </td>
                  <?php endforeach; ?>
                  <td/>
                  <?php foreach ($report['day'] as $monthNumber => $month): ?>
                    <?php foreach ($month as $daynumber => $dayContent): ?>
                      <td>
                        <?php
                          if(isset($dayContent[$groupId][$prestId]))
                            echo round($dayContent[$groupId][$prestId],2);
                        ?>
                      </td>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
