<?php //setup
  //$this->output->enable_profiler(true);
 ?>

<div class="container">
 	<h2>Selectionner le rapport</h2>
    <div class="col-xs-12">
      <?php
        echo anchor(
          "reports/updateCubes",
          'Regénérer les cubes',
          "class='btn btn-warning col-xs-12'");
      ?>
    </div>
   <?php	echo form_open('reports/');?>
   		<br/>
   		<div class="form-group row">
 			<?php $divClass ="col-xs-4 col-xs-6"; ?>
       <div class="<?php echo($divClass); ?>">
         <?php
 					echo form_label('Intervenant');
 					echo form_dropdown('select[userId]', $intervenants);
 				?>
 			</div>
 			<div class="<?php echo($divClass); ?>">
         <?php
           $data = array(
             'name' => 'select[year]',
             'value' => date("Y"),
             'class' => 'form-control',
             'type' => 'number'
           );
           echo form_label("Année");
           echo form_input($data);
 				?>
 			</div>
 			<div class="<?php echo($divClass); ?>">
 				<?php
 					echo form_label('Type');
 					echo form_dropdown('select[kind]', $reportTypes);
 				?>
 			</div>
 		</div>
 		<div class="form-group row">
 			<div class="col-xs-12 ">
 				<?php
 					echo form_submit('submit_Profil', 'Lancer le rapport', "class='btn btn-lg btn-primary btn-block'");
 				?>
 			</div>
 		</div>
 	</form>
 </div>
