
<?php //setUp
	$this->output->enable_profiler(true);

	$isCreate= ($place== null);

	$addAdressButtonDiv='addAdress';
	$adresseDivId = 'adresseDiv';
	$adressActionId = 'place[adresseAction]';

	$hasAdress = false;
	if(false == $isCreate)
		$hasAdress=(false == ($place['adresse']== null));
	$adressId = null;
	{// change kinds format for dropDown use
		$selectKinds;
		if(false == $isCreate)
			$selectKinds[$place['kind']]=$place['descr'];
		else
			$selectKinds = array(''=>'');
		foreach ($kinds as $kind)
			$selectKinds[$kind['id_kind']]=$kind['descr'];
		$kinds=	$selectKinds;
	}
	{// change cyty format for dropDown use
		$selectCyties = array();
		if(true == $hasAdress)
			$selectCyties[$place['adresse']['id_city']]= $place['adresse']['npa']." - ".$place['adresse']['name'];
		else
			$selectCyties = array(''=>'');
		foreach ($citys as $city)
			$selectCyties[$city['id_city']]=$city['npa'].' - '.$city['name'];
		$citys=	$selectCyties;
	}

?>
<div class="container-fluid">
	<?php echo form_open('Places/create'); ?>
	<div class="form-group row">
		<div class ="col-xs-6">
			<?php
				$value = '';
				if(false == $isCreate)
					$value=$place['Name'];
				$input= array(
					'id' 		=> 'nom',
					'name'	=> 'place[Name]',
					'class'	=> 'form-control',
					'value' => $value);
					echo form_label('nom');
					echo form_input($input);
			 ?>
		</div>
		<div class ="col-xs-6">
			<?php
				echo form_label('type');
				if(false == $isCreate)
					echo form_dropdown('place[kind]',$selectKinds,$place['kind']);
				else
					echo form_dropdown('place[kind]',$selectKinds);
			 ?>
		</div>
	</div>
	<div id="<?php echo($adresseDivId); ?>" style="display:<?php if($hasAdress):?>inline<?php else:?>none<?php endif?>">
		<?php
			$adressAction = array(
				'type'  => 'hidden',
				'name'  => $adressActionId,
				'id'    => $adressActionId,
				'value' => 'none');
			if($hasAdress)
				$adressAction['value']='update';

			echo form_input($adressAction);
			echo form_hidden('$adressActionId','update');
		?>
		<div class="form-group row">
			<div class="col-xs-3">
				<?php	echo form_label('Adresse ligne 1');?>
			</div>
			<div class="col-xs-9">
				<?php
					$value = '';
					if(true == $hasAdress)
						$value=$place['adresse']['line_1'];
					$input= array(
						'id' 		=> 'line1',
						'name'	=> 'place[adresse][line_1]',
						'class'	=> 'form-control',
						'value' => $value);
						echo form_input($input);
				?>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-xs-3">
				<?php	echo form_label('Adresse ligne 2');?>
			</div>
			<div class="col-xs-9">
				<?php
					$value = '';
					if(true == $hasAdress)
						if(false ==($place['adresse']['line_2']== null))
							$value=$place['adresse']['line_2'];
					$input= array(
						'id' 		=> 'line1',
						'name'	=> 'place[adresse][line_2]',
						'class'	=> 'form-control',
						'value' => $value);
						echo form_input($input);
				?>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-xs-3">
				<?php	echo form_label('Ville');?>
			</div>
			<div class="col-xs-9">
				<?php
					if(true == $hasAdress)
						echo form_dropdown('place[adresse][city]',$citys, $place['adresse']['id_city']);
					else
						echo form_dropdown('place[adresse][city]',$citys);
				?>
			</div>
		</div>
		<div class="form-group row">
			<?php
				$action = 'none';
				if($hasAdress)
					$action = 'delete';
				$script ="document.getElementById('$adresseDivId').style.display = 'none';
					document.getElementById('$addAdressButtonDiv').style.display = 'inline';
					document.getElementById('$adressActionId').value = '$action';";
			 ?>
			<button type="button" class="btn btn-warning btn-lg btn-block" onclick="<?php echo($script);?>">
				Retirer l'adresse
			</button>
		</div>
	</div>
	<div id="<?php echo($addAdressButtonDiv);?>" style="display:<?php if($hasAdress):?>none<?php else:?>inline<?php endif?>">
		<?php
			$action = 'create';
			if($hasAdress)
				$action = 'update';
			$script ="document.getElementById('$adresseDivId').style.display = 'inline';
				document.getElementById('$addAdressButtonDiv').style.display = 'none';
				document.getElementById('$adressActionId').value = '$action';";
		 ?>
		<button type="button" class="btn btn-info btn-lg btn-block" onclick="<?php echo($script);?>">
			Ajouter une adresse
		</button>
	</div>
<div style="height: 40px;"> </div>

<nav class="navbar navbar-fixed-bottom navbar-light bg-faded">
		<?php echo form_submit('submit_Profil', 'Valider', "class='btn btn-lg btn-primary btn-block'"); ?>
</nav>
