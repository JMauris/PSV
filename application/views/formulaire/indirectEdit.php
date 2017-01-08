<?php //setup
	//$this->output->enable_profiler(true);
	//var_dump($indirect);


	{ // convert $places for dropDown use
		$tmp = array(''=>'');
		foreach ($places as $key => $place)
			$tmp[$place['id_lieu']] =$place['descr']." - ".$place['Name'];
		$places = $tmp;
	}

	$ownerDropDown = array();{
		$ownerDropDown[$indirect['owner']['id']]=$indirect['owner']['username'];
		foreach ($intervenants as $id => $name)
			$ownerDropDown[$id]= $name;
	}

	$placeDropDown = array();{
		$placeDropDown[$indirect['place']['id_lieu']]=$indirect['place']['Name'];
			foreach ($places as $id => $name)
				$placeDropDown[$id]= $name;
	}

	$dropDownDuration = array(
		'0' => 'Durée',
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
	echo form_open('indirect/edit/'. $indirect['id_indirect']);

		?>
	<div class="container-fluid">
		<!--========================================== general info of indirect ========================================== -->
		<div class="row text-center">
				<h2>Informations générales</h2>

				<!--========================================== prestations for indirect ========================================== -->
				<div id="general_edit">
					<?php echo form_hidden('indirect[id_indirect]',	$indirect['id_indirect']);?>
					<div class="form-group row">
						<div class="col-sm-4">
							<?php //Owner, only admin can change it
								echo form_label('Responsable');
								echo "<br/>";
								if($this->session->userdata['groupId']==500){
										echo form_dropdown('indirect[ownerId]', $ownerDropDown, $indirect['owner']['id']);
								}else{
									echo form_label($indirect['owner']['username']);
									echo form_hidden('indirect[ownerId]', $indirect['owner']['id']);
								}
							?>
						</div>
						<div class="col-sm-4">
							<?php //date input
								$dateInput= array(
									'id' 		=> 'date',
			    				'name'	=> 'indirect[date]',
								 	'class'	=> 'form-control date',
									'value' => $indirect['date']);
								echo form_label('Date');
								echo form_input($dateInput);
							?>
						</div>
						<div class="col-sm-4">
							<?php // place input
								echo form_label('Lieu');
								echo "<br/>";
								echo form_dropdown('indirect[place]', $placeDropDown, $indirect['place']['id_lieu']);
							?>
						</div>
						<div class="col-sm-4">
							<?php //distance output
								$distanceInput= array(
									'id' 		=> 'distance',
									'name'	=> 'indirect[distance]',
									'class'	=> 'form-control',
									'type'	=> 'number',
									'value' => $indirect['distance']);
								echo form_label('Distance (Km)');
								echo form_input($distanceInput);
							?>
						</div>
						<div class="col-sm-4">
							<?php //extra cost input
								$extraCostInput= array(
									'id' 		=> 'extraCost',
									'name'	=> 'indirect[extraCost]',
									'class'	=> 'form-control',
									'type'	=> 'number',
									'value' => $indirect['extraCost']);
								echo form_label('Note de frais');
								echo form_input($extraCostInput);
							?>
						</div>
					</div>
				</div>
		</div>
		<!--============================================ called for indirect ============================================= -->
	<div class="row text-center">
		<h2>Intervenants présents</h2>
		<div id="called_edit">
			<div class="form-group row text-left">
				<?php foreach ($intervenants as $id => $value):?>
					<div class="col-sm-4">
						<?php //Owner, only admin can change it
							$cheked = false;
							if(isset($indirect['called']))
									if(isset($indirect['called'][$id]))
											$cheked=true;
							$data = array(
										'name'          => 'indirect[called]['.$id.']',
										'id'            => 'called'.$key,
										'value'         => $intervenants[$id],
										'checked'       => $cheked,
										'style'         => 'margin:10px'
								);
							echo form_label($value);
							echo form_checkbox($data);
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<!--========================================== prestations for indirect ========================================== -->
	<div class="row text-center">
		<h2>Prestations</h2>
		<div id="prestations_edit">
			<?php foreach ($prestations as $prestGroup):?>
				<div class="form-group row text-left">
					<div class="row">
						<h4><?php echo ($prestGroup['presstationGroup_descr']); ?></h4>
					</div>
					<div class="form-group row">
						<?php foreach ($prestGroup['prestations'] as $id => $prest): ?>
							<div class="form-group row">
								<div class="col-xs-2">
									<?php
										$value=0;
										if(isset($indirect['prestations']))
											if(isset($indirect['prestations'][$id]))
												$value = $indirect['prestations'][$id];
										$data = array(
											'name' => 'indirect[prestations]['.$id.']',
											'id' => 'prestations'.$id,
											'value' => $value,
											'class' => 'form-control',
											'type' => 'number'
										);
										echo form_dropdown('indirect[prestations]['.$id.']', $dropDownDuration, $value);
										//echo form_input($data);
									?>
								</div>
								<div class="col-xs-10">
									<p><?php echo $prest; ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</form>
<!--========================================== Validation button ========================================== -->

		<div style="height: 40px;"> </div>
			<nav class="navbar navbar-fixed-bottom navbar-light bg-faded">
					<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
			</nav>
