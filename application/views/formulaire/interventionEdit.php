<?php
	//include_once('/../header.php');
	$interventionType = array(
		'1' => 'Mail',
		'2' => 'Entretient',
		'3' => 'Téléphone',
		'4' => 'Démarche',
	);

$DropDownextra  = array('style' => 'width: 100% ; height: 35px');
	echo form_open('intervention/edit/'. $intervention['id_intrevention']);

?>
	<div class="container">
		<br/>
		<div class="form-group row">
			<div class="col-xs-4">
				<?php
					echo form_label('Intervenant');
					echo "<br/>";
					echo form_dropdown('intervenant', $intervenants, $intervention['intervenant_id'],$DropDownextra);

				?>
			</div>
			<div class="col-xs-4">
				<?php
					$dateInput= array(
						'id' 		=> 'date',
    				'name'	=> 'date',
					 	'class'	=> 'form-control date',
						'value' => $intervention['date']);
					echo form_label('Date');
					echo form_input($dateInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php

					echo form_label('Lieu');
					echo "<br/>";
					echo form_dropdown('place', $places, $intervention['place_id'], $DropDownextra);
				?>
			</div>
			<div class="col-xs-4">
				<?php
					$durationInput= array(
						'id' 		=> 'duration',
						'name'	=> 'duration',
						'class'	=> 'form-control',
						'value' => $intervention['duration']);
					echo form_label('Durée');
					echo form_input($durationInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php
				$value =0;
				if($intervention['distance']!=null)
					$value=$intervention['distance'];
					$distanceInput= array(
						'id' 		=> 'distance',
						'name'	=> 'distance',
						'class'	=> 'form-control',
						'value' => $value);
					echo form_label('Distance (Km)');
					echo form_input($distanceInput);
				?>
			</div>
			<div class="col-xs-4">
				<?php
				$value =0;
				if($intervention['extraCost']!=null)
					$value=$intervention['extraCost'];
					$extraCostInput= array(
						'id' 		=> 'extraCost',
						'name'	=> 'extraCost',
						'class'	=> 'form-control',
						'value' => $value);
					echo form_label('Note de frais');
					echo form_input($extraCostInput);
				?>
			</div>
		</div>
		<div class="form-group row">
			<?php
			$labelExtraTopLevel = array('style' => 'font-weight:700');
			$labelExtraMidLevel = array('style' => 'font-weight:400');
			$labelExtraLowLevel = array('style' => 'font-weight:400;font-style: italic');
			if(isset($thematics['children']))
				foreach ($thematics['children'] as $topLevelThema) {
						echo '<div class="col-xs-3">';
					$data = array(
								'name'          => 'thematics_'.$topLevelThema['id'],
								'id'            => 'thematics_'.$topLevelThema['id'],
								'value'         => 'accept',
								'checked'       => false,
								'style'         => 'margin:10px'
						);
						echo form_checkbox($data);
						echo form_label($topLevelThema['text'],'',$labelExtraTopLevel);

						if(isset($topLevelThema['children']))
							foreach ($topLevelThema['children'] as $midLevelThema) {
								echo '<div style="padding-left: 10px">';
								$data = array(
											'name'          => 'thematics_'.$midLevelThema['id'],
											'id'            => 'thematics_'.$midLevelThema['id'],
											'value'         => 'accept',
											'checked'       => false,
											'style'         => 'margin:10px'
									);
									echo form_checkbox($data);
									echo form_label($midLevelThema['text'],'',$labelExtraMidLevel);
									if(isset($midLevelThema['children']))
										foreach ($midLevelThema['children'] as $lowLevelThema) {
											echo '<div style="padding-left: 10px">';
											$data = array(
														'name'          => 'thematics_'.$lowLevelThema['id'],
														'id'            => 'thematics_'.$lowLevelThema['id'],
														'value'         => 'accept',
														'checked'       => false,
														'style'         => 'margin:10px'
												);
												echo form_checkbox($data);
												echo form_label($lowLevelThema['text'],'',$labelExtraLowLevel);
												echo "</div>";
										}
								echo "</div>";
							}
					echo "</div>";
			}
			echo "</div>";
			?>
		</div>

<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
