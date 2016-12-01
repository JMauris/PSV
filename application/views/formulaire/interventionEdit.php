<?php
	//include_once('/../header.php');
	$interventionType = array(
		'1' => 'Mail',
		'2' => 'Entretient',
		'3' => 'Téléphone',
		'4' => 'Démarche',
	);
	echo form_open('request/createRequest');
?>
	<div class="container">
		<br/>
		<div class="form-group row">
			<div class="col-xs-4">
				<?php
					$intervenantInput= array(
						'id' 		=> 'intervenant',
    				'name'	=> 'intervenant',
					 	'class'	=> 'form-control');
					echo form_label('Intervenant');
					echo form_input($intervenantInput);
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
					echo form_input($placeInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php
					$durationInput= array(
						'id' 		=> 'duration',
						'name'	=> 'duration',
						'class'	=> 'form-control');
					echo form_label('Durée');
					echo form_input($durationInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php
					$distanceInput= array(
						'id' 		=> 'distance',
						'name'	=> 'distance',
						'class'	=> 'form-control');
					echo form_label('Distance (Km)');
					echo form_input($distanceInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php
					$extraCostInput= array(
						'id' 		=> 'extraCost',
						'name'	=> 'extraCost',
						'class'	=> 'form-control');
					echo form_label('Note de frais');
					echo form_input($extraCostInput);
				?>			</div>
		</div>
		<div class="form-group row">
			<?php
				echo form_label('Type d\'intervention');
				echo form_dropdown('type', $interventionType);
			 ?>
<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
