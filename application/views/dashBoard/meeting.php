<h2>Créer un nouvel entretient</h2>
<?php

	echo form_open('meeting/create');
?>
	<div class="container">
		<br/>
		<div class="form-group row">
			<div class="col-sm-3 col-xs-6">
				<?php
					echo form_label('Intervenant');
					array_unshift($intervenants,'');
					echo form_dropdown('intervenant', $intervenants,$user);
				?>
			</div>
			<div class="col-sm-3 col-xs-6">
				<?php
					$dateInput= array(
						'id' 		=> 'date',
    				'name'	=> 'date',
					 	'class'	=> 'form-control date');
					echo form_label('Date');
					echo form_input($dateInput);
				?>
			</div>
			<div class="col-sm-3 col-xs-6">
				<?php
					$dateInput= array(
						'id' 		=> 'date',
						'name'	=> 'date',
						'class'	=> 'form-control date');
					echo form_label('Moyen');
					echo form_dropdown('moyen', $type);
				?>
			</div>
			<div class="col-sm-3 col-xs-6">
				<?php
					echo form_label('Lieu');
					array_unshift($places,'');
					echo form_dropdown('place', $places,'');
				?>
			</div>
			<div class="col-xs-6 hidden-xl hidden-lg hidden-md hidden-sm">
				<?php
				echo'<br/>';
					echo anchor('', 'créer un nouveau lieu', "class='btn btn-default'");
				?>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-8 col-xs-12 ">
				<?php
					echo form_submit('submit_Profil', 'Créer un nouvel entretient', "class='btn btn-lg btn-primary btn-block'");
				?>
			</div>
			<div class="col-sm-4 hidden-xs">
				<?php
					echo anchor('', 'créer un nouveau lieu', "class='btn btn-default'");
				?>
			</div>
	</div>
<h2>Les entretiens à venir</h2>
<?php
foreach ($futur as $key => $value) {

//  var_dump($value);
  echo '<div class="container">';
    echo '<div class="col-sm-3 col-xs-6">';
      echo form_label($value['date']);
    echo "</div>";
    echo '<div class="col-sm-3 col-xs-6">';
			echo form_label($value['place']['Name']);
		echo "</div>";
		echo '<div class="col-sm-3 col-xs-6">';
			echo form_label($value['intervenant']['username']);
    echo "</div>";
		echo '<div class="col-sm-3 col-xs-6">';
			echo form_label($value['kind']['descr']);
		echo "</div>";
		echo '<div class="col-xs-12">';
			echo anchor(
				'intervention/edit/' . $value["id_intrevention"],
				'éditer - completer',
				"class='btn btn-default'");
		echo "</div>";
  echo "</div>";
}
 ?>
 <h2>Les entretiens passés</h2>
 <?php
 foreach ($past as $key => $value) {

	 //  var_dump($value);
	   echo '<div class="container">';
	     echo '<div class="col-sm-3 col-xs-6">';
	       echo form_label($value['date']);
	     echo "</div>";
	     echo '<div class="col-sm-3 col-xs-6">';
	 			echo form_label($value['place']['Name']);
	 		echo "</div>";
	 		echo '<div class="col-sm-3 col-xs-6">';
	 			echo form_label($value['intervenant']['username']);
	     echo "</div>";
	 		echo '<div class="col-sm-3 col-xs-6">';
	 			echo form_label($value['kind']['descr']);
	 		echo "</div>";
	 		echo '<div class="col-xs-12">';
	 			echo anchor(
	 				'intervention/edit/' . $value["id_intrevention"],
	 				'éditer - completer',
	 				"class='btn btn-default'");
	 		echo "</div>";
	   echo "</div>";
 }
  ?>
	<script>
	$(function() {
		$(".date").datepicker({ dateFormat: 'dd-mm-yy' });
			var today = new Date();
			var dd = ("0" + (today.getDate())).slice(-2);
			var mm = ("0" + (today.getMonth() +　1)).slice(-2);
			var yyyy = today.getFullYear();
			today = yyyy + '-' + mm + '-' + dd ;
			$(".date").attr("value", today);
	});
	</script>
