<h2>Créer une nouvelle intervention</h2>
<?php
	//include_once('/../header.php');

	echo form_open('intervention/create');
?>
	<div class="container">
		<br/>
		<div class="form-group row">
			<div class="col-xs-4">
				<?php
					echo form_label('Intervenant');
					echo "<br/>";
					array_unshift($intervenants,'');
					echo form_dropdown('intervenant', $intervenants);
				?>
			</div>
			<div class="col-xs-4">
				<?php
					$dateInput= array(
						'id' 		=> 'date',
    				'name'	=> 'date',
					 	'class'	=> 'form-control date');
					echo form_label('Date');
					echo form_input($dateInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php
					$placeInput= array(
						'id' 		=> 'place',
						'name'	=> 'place',
						'class'	=> 'form-control date');
					echo form_label('Lieu');
					echo "<br/>";
					array_unshift($places,'');
					echo form_dropdown('place', $places);
				?>
			</div>
			<div class="col-xs-8">
				<?php
					echo form_submit('submit_Profil', 'Créer une nouvelle intervention', "class='btn btn-lg btn-primary btn-block'");
				?>
			</div>
			<div class="col-xs-4">
				<?php
					echo anchor('', 'créer un nouveau lieu', "class='btn btn-default'");
				?>
			</div>
	</div>
<h2>Les interventions à venir</h2>
<?php
foreach ($futur as $key => $value) {

//  var_dump($value);
  echo '<div class="container">';
    echo '<div class="col-lg-3">';
      echo form_label($value['date']);
    echo "</div>";
    echo '<div class="col-lg-3">';
			echo form_label($value['place']['Name']);
		echo "</div>";
		echo '<div class="col-lg-3">';
			echo form_label($value['intervenant']['username']);
    echo "</div>";
		echo '<div class="col-lg-3">';
			echo anchor(
				'intervention/edit/' . $value["id_intrevention"],
				'éditer - completer',
				"class='btn btn-default'");
		echo "</div>";
  echo "</div>";
}
 ?>
 <h2>Les interventions passée</h2>
 <?php
 foreach ($past as $key => $value) {

 //  var_dump($value);
   echo '<div class="container">';
     echo '<div class="col-lg-3">';
       echo form_label($value['date']);
     echo "</div>";
     echo '<div class="col-lg-3">';
       echo form_label($value['place']['Name']);
     echo "</div>";
     echo '<div class="col-lg-3">';
       echo form_label($value['intervenant']['username']);
     echo "</div>";
		 echo '<div class="col-lg-3">';
			 echo anchor(
				 'intervention/edit/' . $value["id_intrevention"],
				 'éditer - completer',
				 "class='btn btn-default'");
		 echo "</div>";
	 echo "</div>";
 }
  ?>
