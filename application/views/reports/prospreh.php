<?php //setup
  $linbr;
  $datacolunCount=0;
?>
  <div id="report" class="container-fluid prospreh-report">
    <div class="row">
      <h3>PROSPREJ</h3>
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
          <?php foreach ($report['meta'] as $groupId => $group): ?>
            <tr class="groupRow">
              <td colspan="5"><?php echo $group['presstationGroup_descr']; ?></td>
              <?php $linbr=0; foreach ($group['prestations'] as $prestId => $prest): ?>
                <tr class="prestRow-<?php ++$linbr; if($linbr%2==0):?>odd<?php else:?>even<?php endif?>">
                  <td><?php echo $prest['descr']; ?></td>
                  <?php for ($trimnum=1; $trimnum <=4 ; $trimnum++): ?>
                    <td>
                      <?php
                      if(isset($report['trim'][$trimnum][$groupId][$prestId]))
                        echo round($report['trim'][$trimnum][$groupId][$prestId],2);
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
