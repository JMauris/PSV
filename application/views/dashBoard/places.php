<?php //setUp
	$this->output->enable_profiler(true);
?>
<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Type</th>
        <th>Adresse</th>
        <th>Actif</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($places as $key => $value) {
        ?>
          <tr class="<?php if($value['actived']==0):?>active<?php else:?>info<?php endif?>">
            <td>
              <?php echo form_label($value['Name']);?>
            </td>
            <td>
              <?php echo form_label($value['descr']);?>
            </td>
            <td>
              <?php
                $stingedAdress="Aucune adresse";
                if(false == ($value['adresse']==NULL)){
                  $adresse = $value['adresse'];
                  $stingedAdress = $adresse['line_1']."<br/>";
                  if(false == ($adresse['line_2']==NULL))
                    $stingedAdress = $stingedAdress . $adresse['line_2']."<br/>";
                  $stingedAdress = $stingedAdress . $adresse['npa']." - ".$adresse['name'];
                }
                echo form_label($stingedAdress);
              ?>
            </td>
            <td>
              <?php echo form_label('TODO CHECKBOX & GESTION');?>
            </td>
            <td>
              <?php
                echo anchor(
                  'Places/edit/' . $value["id_lieu"],
                  'éditer',
                  "class='btn btn-default'");
              ?>
            </td>
          </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
