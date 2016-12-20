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
echo form_open('demarche/edit/'. $intervention['id_intrevention']);

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


		<div class="row text-center">
			<h2>presonnes rencontrées</h2>
		</div>
		<div class="form-group row">
			<?php
				foreach ($intervention['persons'] as $key => $person) {
					echo '<div class="in-intervention-meeting">';
					echo '<div class="form-group row">';
						echo form_hidden('intervention[persons]['.$key.'][id_Person]',
							$person['id_Person']);



					$choices = array(
						'origins' => array(),
						'genders' =>  array(),
						'sexuality' =>  array(),
						'ageGroups' => array()
					);

					$choices['origins'][$intervention['persons'][$key]['origine_id']]
					 		= $intervention['persons'][$key]['origine'];
					$choices['genders'][$intervention['persons'][$key]['gender_id']]
							= $intervention['persons'][$key]['gender'];
					$choices['sexuality'][$intervention['persons'][$key]['sexuality_id']]
							= $intervention['persons'][$key]['sexuality'];
					$choices['ageGroups'][$intervention['persons'][$key]['ageGroup_id']]
							= $intervention['persons'][$key]['ageGroup'];

					foreach ($origins as $id => $value)
						$choices['origins'][$id]=$value;
					foreach ($genders as $id => $value)
						$choices['genders'][$id]=$value;
					foreach ($sexuality as $id => $value)
						$choices['sexuality'][$id]=$value;
					foreach ($ageGroups as $id => $value)
						$choices['ageGroups'][$id]=$value;

					$quckActions = array(
						'update' => "",
						'addMeet'=>'Ajouter un entretient personnel',
						'duplic' => 'dupliquer',
						'remove' =>"supprimer" );

						echo '<div class="col-sm-3 col-xs-6">';
							echo form_label('Origine');
							echo form_dropdown('intervention[persons]['.$key.'][origine_id]', 	$choices['origins'], $intervention['persons'][$key]['origine_id']);
						echo "</div>"."\n";
						echo '<div class="col-sm-3 col-xs-6">';
							echo form_label('Genre');
							echo form_dropdown('intervention[persons]['.$key.'][gender_id]', 	$choices['genders'], $intervention['persons'][$key]['gender_id']);
						echo "</div>"."\n";
						echo '<div class="col-sm-3 col-xs-6">';
							echo form_label('Orinentation');
							echo form_dropdown('intervention[persons]['.$key.'][sexuality_id]', 	$choices['sexuality'], $intervention['persons'][$key]['sexuality_id']);
						echo "</div>"."\n";
						echo '<div class="col-sm-3 col-xs-6">';
							echo form_label("Groupe d'age");
							echo form_dropdown('intervention[persons]['.$key.'][ageGroup_id]', 	$choices['ageGroups'], $intervention['persons'][$key]['ageGroup_id']);
						echo "</div>"."\n";
						echo '<div class="col-xs-6">';
							echo form_label('Action rapide');
							echo form_dropdown('intervention[persons]['.$key.'][quickAction]', $quckActions, 'none');
						echo "</div>"."\n";
						$currentKey = $person['id_Person'];
						if(true == isset($intervention['interventions'][$currentKey])){
							$current = $intervention['interventions'][$currentKey];
							echo '<div class="col-xs-12">';
								echo "<h4>Entretient personel</h4>";
								echo form_hidden('intervention[interventions]['.$currentKey.'][id_intrevention]',
									$current['id_intrevention']);
								echo "<div>";
									echo form_label('Durée');
									echo form_dropdown('intervention[interventions]['.$currentKey.'][duration]', $dropDownDuration , $current['duration']);
								echo "</div>"."\n";
								echo "<div>";
								$labelExtraTopLevel = array('style' => 'font-weight:700');
								$labelExtraMidLevel = array('style' => 'font-weight:400');
								$labelExtraLowLevel = array('style' => 'font-weight:400;font-style: italic');
								if(isset($thematics['children']))
									foreach ($thematics['children'] as $topLevelThema) {
										echo '<div class="col-sm-3 col-xs-6">'."\n";
										$cheked= false;
										if(isset($intervention['interventions'][$currentKey]['thematics']))
												if(in_array($topLevelThema['id'],$intervention['interventions'][$currentKey]['thematics']))
													$cheked=true;
										$data = array(
												'name'          => 'intervention[interventions]['.$currentKey.'][thematics][]',
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
												if(isset($intervention['interventions'][$currentKey]['thematics']))
														if(in_array($midLevelThema['id'],$intervention['interventions'][$currentKey]['thematics']))
																$cheked=true;
												$data = array(
															'name'          => 'intervention[interventions]['.$currentKey.'][thematics][]',
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
															if(isset($intervention['interventions'][$currentKey]['thematics']))
																	if(in_array($lowLevelThema['id'],$intervention['interventions'][$currentKey]['thematics']))
																			$cheked=true;
															$data = array(
																		'name'          => 'intervention[interventions]['.$currentKey.'][thematics][]',
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

								echo "</div>"."\n";
							echo "</div>"."\n";
						}
					echo "</div>"."\n";
					echo "</div>"."\n";
				}
			 ?>
			 <div class="form-group row">
				 <div class="col-sm-3 col-xs-6">
					 <?php
					 echo form_label('Origine');
					 $origins['0']="";
					 echo form_dropdown('intervention[persons][added][origine_id]', $origins, 0);
					  ?>
				 </div>
				 <div class="col-sm-3 col-xs-6">
					  <?php
					 echo form_label('Genre');
					 $genders['0']="";
					 echo form_dropdown('intervention[persons][added][gender_id]', $genders, 0);
					  ?>
				 </div>
				 <div class="col-sm-3 col-xs-6">
					  <?php
					 echo form_label('Orinentation');
					 $sexuality['0']="";
					 echo form_dropdown('intervention[persons][added][sexuality_id]', $sexuality, 0);
					  ?>
				 </div>
				 <div class="col-sm-3 col-xs-6">
					  <?php
					 echo form_label("Groupe d'age");
						$ageGroups['0']= "";
					 echo form_dropdown('intervention[persons][added][ageGroup_id]', $ageGroups, 0);
					  ?>
				 </div>
				 <div class="col-xs-12">
					   <?php
					 echo "<br/>";
					 echo form_submit('submit_Profil', 'Ajouter', "class='btn btn-lg btn-primary btn-block'");
					  ?>
				 </div>
			 </div>
		</div>


			<nav class="navbar navbar-fixed-bottom navbar-light bg-faded">
					<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
			</nav>
