<?php
	//include_once('/../header.php');

$DropDownextra  = array('style' => 'width: 100% ; height: 35px');
	echo form_open('intervention/edit/'. $intervention['id_intrevention']);

?>
	<div class="container-fluid">
		<br/>
		<div class="row text-center">
				<h2>Informations générales</h2>
		</div>
		<div class="form-group row">
			<div class="col-sm-4">
				<?php
					echo form_label('Intervenant');
					echo "<br/>";
					echo form_dropdown('$intervention[intervenant_id]', $intervenants, $intervention['intervenant_id'],$DropDownextra);

				?>
			</div>
			<div class="col-sm-4">
				<?php
					$dateInput= array(
						'id' 		=> 'date',
    				'name'	=> '$intervention[date]',
					 	'class'	=> 'form-control date',
						'value' => $intervention['date']);
					echo form_label('Date');
					echo form_input($dateInput);
				?>
			</div>
			<div class="col-sm-4">
				<?php

					echo form_label('Lieu');
					echo "<br/>";
					echo form_dropdown('$intervention[place_id]', $places, $intervention['place_id'], $DropDownextra);
				?>
			</div>
			<div class="col-sm-4">
				<?php
					$durationInput= array(
						'id' 		=> 'duration',
						'name'	=> '$intervention[duration]',
						'class'	=> 'form-control',
						'value' => $intervention['duration']);
					echo form_label('Durée');
					echo form_input($durationInput);
				?>
			</div>
			<div class="col-sm-4">
				<?php
				$value =0;
				if($intervention['distance']!=null)
					$value=$intervention['distance'];
					$distanceInput= array(
						'id' 		=> 'distance',
						'name'	=> '$intervention[distance]',
						'class'	=> 'form-control',
						'value' => $value);
					echo form_label('Distance (Km)');
					echo form_input($distanceInput);
				?>
			</div>
			<div class="col-sm-4">
				<?php
				$value =0;
				if($intervention['extraCost']!=null)
					$value=$intervention['extraCost'];
					$extraCostInput= array(
						'id' 		=> 'extraCost',
						'name'	=> '$intervention[extraCost]',
						'class'	=> 'form-control',
						'value' => $value);
					echo form_label('Note de frais');
					echo form_input($extraCostInput);
				?>
			</div>
		</div>
		<div class="row text-center">
				<h2>Thèmes abordés</h2>
		</div>
		<div class="form-group row">
			<?php
			$labelExtraTopLevel = array('style' => 'font-weight:700');
			$labelExtraMidLevel = array('style' => 'font-weight:400');
			$labelExtraLowLevel = array('style' => 'font-weight:400;font-style: italic');
			if(isset($thematics['children']))
				foreach ($thematics['children'] as $topLevelThema) {
					echo '<div class="col-sm-3 col-xs-6">'."\n";
					$cheked= false;
					if(isset($intervention['thematics']))
							if(in_array($topLevelThema['id'],$intervention['thematics']))
								$cheked=true;
					$data = array(
								'name'          => '$intervention[thematics][]',
								'id'            => 'thematics_'.$topLevelThema['id'],
								'value'         => $topLevelThema['id'],
								'checked'       => $cheked,
								'style'         => 'margin:10px'
						);
						echo form_checkbox($data);
						echo form_label($topLevelThema['text'],'',$labelExtraTopLevel);

						if(isset($topLevelThema['children']))
							foreach ($topLevelThema['children'] as $midLevelThema) {
								echo '<div style="padding-left: 10px">'."\n";
								$cheked= false;
								if(isset($intervention['thematics']))
										if(in_array($midLevelThema['id'],$intervention['thematics']))
												$cheked=true;
								$data = array(
											'name'          => '$intervention[thematics][]',
											'id'            => 'thematics_'.$midLevelThema['id'],
											'value'         => $midLevelThema['id'],
											'checked'       => $cheked,
											'style'         => 'margin:10px'
									);
									echo form_checkbox($data);
									echo form_label($midLevelThema['text'],'',$labelExtraMidLevel);
									if(isset($midLevelThema['children']))
										foreach ($midLevelThema['children'] as $lowLevelThema) {
											echo '<div style="padding-left: 10px">'."\n";
											$cheked= false;
											if(isset($intervention['thematics']))
													if(in_array($lowLevelThema['id'],$intervention['thematics']))
															$cheked=true;
											$data = array(
														'name'          => '$intervention[thematics][]',
														'id'            => 'thematics_'.$lowLevelThema['id'],
														'value'         => $lowLevelThema['id'],
														'checked'       => $cheked,
														'style'         => 'margin:10px'
												);
												echo form_checkbox($data);
												echo form_label($lowLevelThema['text'],'',$labelExtraLowLevel);
												echo '</div>'."\n";
										}
								echo '</div>'."\n";
							}
					echo '</div>'."\n";
			}
			?>
		</div>
		<div class="row text-center">
			<h2>Materiel distribué</h2>
		</div>
		<div class="form-group row">
			<?php
				foreach ($materials as $key => $material) {
					echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">'."\n";
					$value=0;
					if(isset($intervention['materials']))
						if(isset($intervention['materials'][$key]))
							$value = $intervention['materials'][$key];
					$data = array(
					  'name' => '$intervention[materials]['.$key.']',
					  'id' => 'material_'.$key,
						'value' => $value,
					  'class' => 'form-control',
					  'type' => 'number'
					);
					echo form_label($material);
					echo form_input($data);
					echo "</div>"."\n";
				}
			 ?>
		</div>

		<div class="form-group row">
		<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
		</div>
		<div class="row text-center">
			<h2>presonnes rencontrées</h2>
		</div>
		<div class="form-group row">
		</div>
		<div class="form-group row">
		<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
		</div>
