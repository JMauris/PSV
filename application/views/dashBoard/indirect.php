<?php //setup
	$this->output->enable_profiler(true);
	{ // convert $places for dropDown use
		$tmp = array(''=>'');
		foreach ($places as $key => $place)
			$tmp[$place['id_lieu']] =$place['descr']." >> ".$place['Name'];
		$places = $tmp;
	}
?>
<div class="container">
	<h2>Créer</h2>
  <?php	echo form_open('indirect/');?>

  		<br/>
  		<div class="form-group row">
  			<?php //setup for div class (admin have more éléments)
  		 		$divClass ="col-sm-4 col-xs-6";
  				if($this->session->userdata['groupId']==500){
  					$divClass ="col-sm-3 col-xs-6";
        ?>
            <div class="<?php echo($divClass); ?>">
              <?php
      					echo form_label('Intervenant');
      					array_unshift($intervenants,'');
      					echo form_dropdown('added[owner]', $intervenants,$user);
      				?>
      			</div>
  			<?php
          	}else{
          		echo form_hidden('added[owner]',$user);
          	}?>
  			<div class="<?php echo($divClass); ?>">
          <?php
  					$dateInput= array(
  						'id' 		=> 'added[date]',
      				'name'	=> 'added[date]',
  						'value'	=>  date ('d-m-Y'),
  					 	'class'	=> 'form-control date');
  					echo form_label('Date');
  					echo form_input($dateInput);
  				?>
  			</div>
  			<div class="<?php echo($divClass); ?>">
  				<?php
  					echo form_label('Lieu');
  					array_unshift($places,'');
  					echo form_dropdown('added[place]', $places,'');
  				?>
  			</div>
  			<div class="col-xs-6 hidden-xl hidden-lg hidden-md hidden-sm">
  				<?php
  				echo'<br/>';
  					echo anchor(base_url(). index_page(). '/places/create/', 'créer un nouveau lieu', "class='btn btn-default'");
  				?>
  			</div>
  		</div>
  		<div class="form-group row">
  			<div class="col-sm-9 col-xs-12 ">
  				<?php
  					echo form_submit('submit_Profil', 'Créer un nouvel entretient', "class='btn btn-lg btn-primary btn-block'");
  				?>
  			</div>
  			<div class="col-sm-3 hidden-xs">
  				<?php
  					echo anchor(base_url(). index_page(). '/places/create/', 'créer un nouveau lieu', "class='btn btn-default'");
  				?>
  			</div>
  		</div>
	</form>
</div>
<?php
	$divClass = "col-sm-4 col-xs-6";
	if($this->session->userdata['groupId']==500)
		$divClass ="col-sm-3 col-xs-6";
	$allIndirect = array(
		'A venir' => $futurs,
		//'Les entretients passés' => $past
	 );
	 foreach ($allIndirect as $title => $indirects) {?>
		 <div class="conatiner">
	 	 	<h2><?php echo ($title);?></h2>
			<?php foreach ($indirects as $key => $indirect) {?>
				<div class="container">
					<div class="row">
						<div class="<?php echo($divClass); ?>">
							<?php echo form_label($indirect['date']); ?>
						</div>
						<div class="<?php echo($divClass); ?>">
							<?php echo form_label($indirect['place']['Name']); ?>
						</div>
						<div class="<?php echo($divClass); ?>">
							<?php
								echo anchor(
									'indirect/edit/' . $indirect["id_indirect"],
									'éditer - completer',
									"class='btn btn-default'");
							?>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
		<?php } ?>