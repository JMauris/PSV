<?php
$this->output->enable_profiler(true);
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
			<h2>Matériels distribués</h2>
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
			<div class="col-sm-1">
			</div>
			<div class="col-sm-2 col-xs-6">
				<?php
				echo form_label('Origine');
				$origins['0']="";
				echo form_dropdown('intervention[persons][added][origine_id]', $origins, 0);
				 ?>
			</div>
			<div class="col-sm-2 col-xs-6">
				 <?php
				echo form_label('Genre');
				$genders['0']="";
				echo form_dropdown('intervention[persons][added][gender_id]', $genders, 0);
				 ?>
			</div>
			<div class="col-sm-2 col-xs-6">
				 <?php
				echo form_label('Orinentation');
				$sexuality['0']="";
				echo form_dropdown('intervention[persons][added][sexuality_id]', $sexuality, 0);
				 ?>
			</div>
			<div class="col-sm-2 col-xs-6">
				 <?php
				echo form_label("Groupe d'age");
				 $ageGroups['0']= "";
				echo form_dropdown('intervention[persons][added][ageGroup_id]', $ageGroups, 0);
				 ?>
			</div>
			<div class="col-sm-2 col-xs-6">
				 <?php

				 $quantityInput= array(
					 'id' 		=> 'intervention[persons][added][quantity]',
					 'name'	=> 'intervention[persons][added][quantity]',
					 'class'	=> 'form-control',
					 'type'  => 'number',
					 'value' => 1);
				 echo form_label('Nombre');
				 echo form_input($quantityInput);
				 ?>
			</div>
			<div class="col-sm-10 col-sm-offset-1 col-xs-6">
					<?php
				echo "<br/>";
				echo form_submit('submit_Profil', 'Ajouter', "class='btn btn-lg btn-primary btn-block'");
				 ?>
			</div>
		</div>
		<div class="form-group row">
			<?php

				foreach ($intervention['persons'] as $key => $person) {
					$personId=$person['id_Person'];
					$personDivId = 'PersDetail_'.$key;
					?>
					<div class="in-intervention-meeting" id="<?php echo($personDivId); ?>" data-toggle="modal" data-target="#editModal_<?php echo($personId);?>">

						<div class="form-group row">
							<h4>Persone n°<?php echo($key+1); ?> #<?php echo($personId); ?></h4>
							<?php
							$quickActionName='intervention[persons]['.$key.'][quickAction]';
							$quickAction = array(
				        'type'  => 'hidden',
				        'name'  => $quickActionName,
				        'id'    => $quickActionName,
				        'value' => 'none');//remove
							echo form_input($quickAction);
							echo form_hidden('intervention[persons]['.$key.'][id_Person]',$personId);
							if(isset($intervention['interventions'][$personId]))
								echo form_hidden(
									'intervention[interventions]['.$personId.'][id_intrevention]',
									$intervention['interventions'][$personId]['id_intrevention']);

							?>
						</div>
						<div class="form-group row">
							<?php
							$personInfos = array(
								'Origine' 	=> $person['origine'],
								'Genre' 		=> $person['gender'],
								'Sexualité' => $person['sexuality'],
								'Age' 			=> $person['ageGroup'],
							);
							foreach ($personInfos as $name => $value) {
								?>
								<div class="col-sm-3 col-xs-6">
										<p id=<?php  echo($key."_".$name);?>><?php echo($value) ?></p>

								</div><?php
							}
							?>
						</div>
					</div>
					<div id="editModal_<?php echo($personId);?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="gridModalLabel">Détail pour personne <?php echo ($key+1); ?></h4>
					      </div>
					      <div class="modal-body">
					        <div class="container-fluid bd-example-row">
										<div id="modal_editPerson_<?php echo($personId);?>" class="form-group row">
											<?php // seeting for dropDown Choices, trick came from origine, gender, sexuality or ageGroup who are unactif, and do not apear in sended choices, but must stay present
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
											?>
											<div class="col-sm-3 col-xs-6">
												<?php //dropDown for origin Modification
													$dropDownId='intervention[persons]['.$key.'][origine_id]';
													$script="var yourSelect = document.getElementById('$dropDownId' );
														$('#".$key."_Origine').html(yourSelect.options[ yourSelect.selectedIndex ].innerHTML);
													 document.getElementById('$quickActionName').value = 'update';";
													echo form_label('Origine');
													echo form_dropdown(
														$dropDownId,
														$choices['origins'],
														$intervention['persons'][$key]['origine_id'],
														array('id' =>$dropDownId, 'onchange' => $script)
													);
												?>
											</div>
											<div class="col-sm-3 col-xs-6">
												<?php //dropDown for Gender Modification
													$dropDownId='intervention[persons]['.$key.'][gender_id]';
													$script="var yourSelect = document.getElementById('$dropDownId' );
														$('#".$key."_Genre').html(yourSelect.options[ yourSelect.selectedIndex ].innerHTML);
														document.getElementById('$quickActionName').value = 'update';";
														echo form_label('Genre');
														echo form_dropdown(
															$dropDownId,
															$choices['genders'],
															$intervention['persons'][$key]['gender_id'],
															array('id' =>$dropDownId, 'onchange' => $script)
														);
												?>
											</div>
											<div class="col-sm-3 col-xs-6">
												<?php //dropDown for sexuality Modification
													$dropDownId='intervention[persons]['.$key.'][sexuality_id]';
													$script="var yourSelect = document.getElementById('$dropDownId' );
														$('#".$key."_Sexualité').html(yourSelect.options[ yourSelect.selectedIndex ].innerHTML);
														document.getElementById('$quickActionName').value = 'update';";
													echo form_label('Orinentation');
													echo form_dropdown(
														$dropDownId,
														$choices['sexuality'],
														$intervention['persons'][$key]['sexuality_id'],
														array('id' =>$dropDownId, 'onchange' => $script)
													);
												?>
											</div>
											<div class="col-sm-3 col-xs-6">
												<?php //dropDown for ageGroup Modification
													$dropDownId='intervention[persons]['.$key.'][ageGroup_id]';
													$script="var yourSelect = document.getElementById('$dropDownId' );
														$('#".$key."_Age').html(yourSelect.options[ yourSelect.selectedIndex ].innerHTML);
														document.getElementById('$quickActionName').value = 'update';";
													echo form_label("Groupe d'age");
													echo form_dropdown(
														$dropDownId,
														$choices['ageGroups'],
														$intervention['persons'][$key]['ageGroup_id'],
														array('id' =>$dropDownId, 'onchange' => $script)
													);
												?>
											</div>
										</div>
										<?php //setUp for iner metting
											$hasInerMeeting =isset($intervention['interventions'][$personId]);
											$themaDivID='editModal_'.$personId.'_MeetingThemaDiv';
											$themaButtonAddDivID='editModal_'.$personId.'_AddMeetingButtonDiv';
											$personButtonDeleteDivID='editModal_'.$personId.'_RemovePersonButtonDiv';
											$meetingDuration=0;
											if(isset($intervention['interventions'][$personId]['duration']))
												$meetingDuration=$intervention['interventions'][$personId]['duration'];
											$labelExtra = array(
												'1' => array('style' => 'font-weight:700'),
												'2' => array('style' => 'font-weight:400;font-style: italic')
											);
											$divClassLevel = array(
												'1' => 'form-group row',
												'2' => 'col-sm-4 col-xs-6'
											);
											$mettingThema = array();
											foreach ($thematics['children'] as $topLevelThema) {
												$thema = array();
												{// checkBoxData
													$CheckBoxData = array(
														'name'          => 'intervention[interventions]['.$personId.'][thematics][]',
														'id'            => 'thematics_'.$topLevelThema['id'],
														'value'         => $topLevelThema['id'],
														'checked'       => false,
														'style'         => 'margin:10px'
													);
													if($hasInerMeeting)
														if(in_array($topLevelThema['id'],$intervention['interventions'][$personId]['thematics']))
															$CheckBoxData['checked']=true;

													$thema['checkBoxData']=$CheckBoxData;
												}
												{//labelData
													$labelData = array(
														'label_text' 	=> $topLevelThema['text'],
														'id '					=> '',
														'attributes' => $labelExtra['1']
													);

													$thema['labelData']=$labelData;
												}
												{// children
													$themaChildren = array();
													foreach ($topLevelThema['children'] as $lowLevelThema) {
														$childthema = array();
														{ // checkBoxData
															$CheckBoxData = array(
																'name'          => 'intervention[interventions]['.$personId.'][thematics][]',
																'id'            => 'thematics_'.$lowLevelThema['id'],
																'value'         => $lowLevelThema['id'],
																'checked'       => false,
																'style'         => 'margin:10px'
															);
															if($hasInerMeeting)
																if(in_array($lowLevelThema['id'],$intervention['interventions'][$personId]['thematics']))
																	$CheckBoxData['checked']=true;

															$childthema['checkBoxData']=$CheckBoxData;
														}
														{ //labelData
															$labelData = array(
																'label_text' 	=> $lowLevelThema['text'],
																'id '					=> '',
																'attributes' => $labelExtra['2']
															);
															$childthema['labelData']=$labelData;
														}
														// div class
														$childthema['divClass']= $divClassLevel['2'];
														//push himself in parent
														array_push($themaChildren,$childthema);
													}
													$thema['children']= $themaChildren;
												}
												$thema['divClass']= $divClassLevel['1'];
												array_push($mettingThema,$thema);
											}
										?>
										<div id="modal_editMeeting_<?php echo($personId);?>" class="form-group row">
											<div id="<?php echo($themaDivID);?>" <?php if($hasInerMeeting== false):?>hidden="true"<?php endif?>>
												<div>
													<?php
													echo form_label('Durée');
													echo form_dropdown('intervention[interventions]['.$personId.'][duration]', $dropDownDuration , $meetingDuration);
													 ?>
												</div>
												<?php
													foreach ($mettingThema as $topLevelThema) {
														?>
															<div class="<?php echo($topLevelThema['divClass']);?>">
																<?php
																	echo form_checkbox($topLevelThema['checkBoxData']);
																	echo form_label($topLevelThema['labelData']['label_text'],'',$topLevelThema['labelData']['attributes']);
																	?>
																	<div class="<?php echo($topLevelThema['divClass']);?>">
																		<?php
																			foreach ($topLevelThema['children'] as $lowLevelThema) {
																				?>

																						<div class="<?php echo($lowLevelThema['divClass'])?>">
																							<?php
																								echo form_checkbox($lowLevelThema['checkBoxData']);
																								echo form_label($lowLevelThema['labelData']['label_text'],'',$lowLevelThema['labelData']['attributes']);
																							 ?>
																						</div>

																				<?php
																			}
																		?>
																</div>
															</div>
														<?php
													}
												?>
											</div>
										</div>
										<div id="modal_buttons_<?php echo($personId);?>" class="form-group row">
											<div id="<?php echo ($personButtonDeleteDivID);?>"<?php if($hasInerMeeting):?>class="col-xs-12"<?php else:?> class="col-xs-6"<?php endif?>>
												<?php
													$script="document.getElementById('$quickActionName').value = 'remove';
															document.getElementById('$personDivId').style.display = 'none';
														";
												 ?>
												<button type="button" class="btn btn-danger btn-lg btn-block" onclick="<?php echo($script);?>" data-dismiss="modal">
													Supprimer
												</button>
											</div>
											<div id="<?php echo($themaButtonAddDivID);?>" <?php if($hasInerMeeting):?>style="display: none"<?php else:?> class="col-xs-6"<?php endif?>>
												<?php
													$script="document.getElementById('$themaDivID').style.display = 'inline';
														document.getElementById('$themaButtonAddDivID').style.display = 'none';
														document.getElementById('$personButtonDeleteDivID').className = 'col-xs-12';
														";
												 ?>
												<button type="button" class="btn btn-info btn-lg btn-block" onclick="<?php echo($script);?>">
													Ajouter un entretient
												</button>
											</div>
										</div>
					        </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-lg btn-primary btn-block" data-dismiss="modal">OK</button>
					      </div>
					    </div>
					  </div>
					</div>
				<?php
				}
			 ?>
		</div>
<div style="height: 40px;"> </div>

			<nav class="navbar navbar-fixed-bottom navbar-light bg-faded">
					<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
			</nav>
