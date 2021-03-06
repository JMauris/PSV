<?php //setup
?>
<body class="individualContener">
<h2>Créer un nouvel entretien</h2>
<?php

	echo form_open('meeting/create');
?>
	<div class="container">
		<br/>
		<div class="form-group row">
			<?php
		 		$divType ='<div class="col-sm-4 col-xs-6">';
				if($this->session->userdata['groupId']==500){
					$divType ='<div class="col-sm-3 col-xs-6">';
					echo $divType;
						echo form_label('Intervenant');
						echo form_dropdown('intervenant', $intervenants,$user);
						?>
				</div>
					<?php
			}else{
				echo form_hidden('intervenant',$user);
			}
				echo $divType;
					$dateInput= array(
						'id' 		=> 'date',
    				'name'	=> 'date',
						'value'	=>  date ('d-m-Y'),
					 	'class'	=> 'form-control date');
					echo form_label('Date');
					echo form_input($dateInput);
				?>
			</div>
				<?php
				echo $divType;
					echo form_label('Moyen');
					echo form_dropdown('moyen', $type);
				?>
			</div>
				<?php
				echo $divType;
					echo form_label('Lieu');
					echo form_dropdown('place', $places,'');
				?>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-xs-12 ">
				<?php
					echo form_submit('submit_Profil', 'Créer un nouvel entretien', "class='btn btn-lg btn-primary btn-block'");
				?>
			</div>
	</div>
</div>
<?php
	$divType ='<div class="col-sm-4 col-xs-6">';
	if($this->session->userdata['groupId']==500)
		$divType ='<div class="col-sm-3 col-xs-6">';
	$allInterventions = array(
		'Les entretients à venir' => $futur,
		'Les entretients passés' => $past
	 );
	 foreach ($allInterventions as $title => $intervgentions) {
	 	echo " <h2>".$title."</h2>";
		foreach ($intervgentions as $key => $value) {
			echo '<div class="container">';
			  echo $divType;
					echo form_label($value['date']);
				echo "</div>";
				if($this->session->userdata['groupId']==500){
					echo $divType;
						echo form_label($value['intervenant']['username']);
			    echo "</div>";
				}
			  echo $divType;
					echo form_label($value['kind']['descr']);
				echo "</div>";
				if($this->session->userdata['groupId']==500){
					echo $divType;
					echo "</div>";
				}
			  echo $divType;
					echo anchor(
						'meeting/edit/' . $value["id_intrevention"],
						'éditer - completer',
						"class='btn btn-default'");
				echo "</div>";
			echo "</div>";

		}
	 }
?>
