<?php //setup
  $linbr;
?>
  <div id="report" class="container-fluid">
    <div class="row">
      <table class="table undirect-Table">
        <thead>
          <tr>
            <th>Prestation</th>
            <?php foreach ($report['trim'] as $trimNumber => $unUsedVariable): ?>
              <th>Trimestre <?php echo $trimNumber; ?></th>
            <?php endforeach; ?>
            <th/>
            <?php foreach ($report['day'] as $monthNumber => $month): ?>
              <?php foreach ($month as $daynumber => $unUsedVariable): ?>
                <th><?php echo $daynumber.'-'. $monthNumber; ?></th>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($report['meta'] as $groupId => $group): ?>
            <tr class="groupRow">
              <td><?php echo $group['presstationGroup_descr']; ?></td>
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
