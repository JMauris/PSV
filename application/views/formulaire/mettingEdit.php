<?php
$intervenantsDropDown = array();{
	$intervenantsDropDown[$intervention['intervenant']['id']]=$intervention['intervenant']['username'];
	foreach ($intervenants as $id => $name)
		$intervenantsDropDown[$id]= $name;
}

$placeDropDown = array();{
	$placeDropDown[$intervention['place']['id_lieu']]=$intervention['place']['Name'];
		foreach ($places as $id => $name)
			$placeDropDown[$id]= $name;
}

$dropDownDuration = array(
	'0' => '',
	'5'  => '05',
	'10' => '10',
	'15' => '15',
	'20' => '20',
	'30' => '30',
	'40' => '40',
	'50' => '50',
	'60' => '1:00',
	'75' => '1:15',
	'90' => '1:30',
	'105' => '1:45',
	'120' => '2:00',
	'135' => '2:15',
	'150' => '2:30',
	'180' => '3:00',
	'210' => '3:30',
	'240' => '4:00',
	'310' => '4:30',
);
echo form_open('meeting/edit/'. $intervention['id_intrevention']);

		?>
	<div class="container-fluid">
		<br/>
		<div class="row text-center">
				<h2>Informations générales</h2>
		</div>
		<div class="form-group row">
			<div>
				<?php echo form_hidden('intervention[id_intrevention]',	$intervention['id_intrevention']);?>
			</div>
			<div class="col-sm-4 col-xs-6">
				<?php	echo form_label('Moyen');	?>
			</div>
			<div class="col-sm-8 col-xs-6">
				<?php
				echo form_dropdown('intervention[kind_id]', $types, $intervention['kind_id']);?>

			</div>


			<div class="col-sm-4">
				<?php
				echo form_label('Intervenant');
				echo "<br/>";
				if($this->session->userdata['groupId']==500){
						echo form_dropdown('intervention[intervenant_id]', $intervenantsDropDown, $intervention['intervenant_id']);
				}else{
					echo form_label($intervention['intervenant']['username']);
					echo form_hidden('intervention[intervenant_id]', $intervention['intervenant_id']);
				} ?>

			</div>
			<div class="col-sm-4">
				<?php
					$dateInput= array(
						'id' 		=> 'date',
    				'name'	=> 'intervention[date]',
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
					echo form_dropdown('intervention[place_id]', $placeDropDown, $intervention['place_id']);
				?>
			</div>
			<div class="col-sm-4">
				<?php
					echo form_label('Durée');
					echo form_dropdown('intervention[duration]', $dropDownDuration, $intervention['duration']);
				?>
			</div>
			<div class="col-sm-4">
				<?php
				$value =0;
				if($intervention['distance']!=null)
					$value=$intervention['distance'];
					$distanceInput= array(
						'id' 		=> 'distance',
						'name'	=> 'intervention[distance]',
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
						'name'	=> 'intervention[extraCost]',
						'class'	=> 'form-control',
						'value' => $value);
					echo form_label('Note de frais');
					echo form_input($extraCostInput);
				?>
			</div>
		</div>
		<div class="row text-center">
			<h2>presonne rencontrée</h2>
		</div>
		<div class="form-group row">
			<?php

				$choices = array(
					'origins' => array(),
					'genders' =>  array(),
					'sexuality' =>  array(),
					'ageGroups' => array()
				);
				if($intervention['person_id']==null){
					$intervention['person_id']=0;
					$intervention['person']= array(
						"id_Person"		=> 0,
		        "name"				=> "",
		        "origine_id"	=> 0,
		        "ageGroup_id"	=> 0,
		        "gender_id"		=> 0,
		        "sexuality_id"=> 0,
		        "origine"			=> "",
		      	"ageGroup"		=> "",
		        "gender"			=> "",
		        "sexuality"		=> ""
					);
				}
				echo form_hidden('intervention[person_id]',
					$intervention['person_id']);
				echo form_hidden('intervention[person][id_Person]',
						$intervention['person_id']);
				$choices['origins'][$intervention['person']['origine_id']]
						= $intervention['person']['origine'];
				$choices['genders'][$intervention['person']['gender_id']]
						= $intervention['person']['gender'];
				$choices['sexuality'][$intervention['person']['sexuality_id']]
						= $intervention['person']['sexuality'];
				$choices['ageGroups'][$intervention['person']['ageGroup_id']]
						= $intervention['person']['ageGroup'];
				foreach ($origins as $id => $value)
					$choices['origins'][$id]=$value;
				foreach ($genders as $id => $value)
					$choices['genders'][$id]=$value;
				foreach ($sexuality as $id => $value)
					$choices['sexuality'][$id]=$value;
				foreach ($ageGroups as $id => $value)
					$choices['ageGroups'][$id]=$value;
			?>
			<div class="col-sm-3 col-xs-6">';
				<?php
					echo form_label('Origine');
					echo form_dropdown('intervention[person][origine_id]', 	$choices['origins'], $intervention['person']['origine_id']);
					?>
			</div>
			<div class="col-sm-3 col-xs-6">
				<?php
					echo form_label('Genre');
					echo form_dropdown('intervention[person][gender_id]', 	$choices['genders'], $intervention['person']['gender_id']);
					?>
			</div>
			<div class="col-sm-3 col-xs-6">
				<?php
					echo form_label('Orinentation');
					echo form_dropdown('intervention[person][sexuality_id]', 	$choices['sexuality'], $intervention['person']['sexuality_id']);
					?>
			</div>
			<div class="col-sm-3 col-xs-6">
				<?php
					echo form_label("Groupe d'age");
					echo form_dropdown('intervention[person][ageGroup_id]', 	$choices['ageGroups'], $intervention['person']['ageGroup_id']);
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
							'name'          => 'intervention[thematics][]',
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
										'name'          => 'intervention[thematics][]',
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
													'name'          => 'intervention[thematics][]',
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
					  'name' => 'intervention[materials]['.$key.']',
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
			<nav class="navbar navbar-fixed-bottom navbar-light bg-faded">
					<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
			</nav>
