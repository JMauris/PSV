<?php //setup

?>
<body class="collectiveContener">
<div class="container-fluid">
	<h2>Créer une nouvelle intervention</h2>
	<?php

		echo form_open('demarche/create');
	?>
		<div class="container">
			<br/>
			<div class="form-group row">
				<?php
					$divType ='<div class="col-xs-6">';
					if($this->session->userdata['groupId']==500){
						$divType ='<div class="col-sm-4 col-xs-6">';
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
						echo form_label('Lieu');
						echo form_dropdown('place', $places,0);
					?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-xs-12 ">
					<?php
						echo form_submit('submit_Profil', 'Créer une nouvelle intervention', "class='btn btn-lg btn-primary btn-block'");
					?>
				</div>
		</div>
	</div>
	<?php
		$divType ='<div class="col-sm-4 col-xs-6">';
	if($this->session->userdata['groupId']==500)
		$divType ='<div class="col-sm-3 col-xs-6">';
		$allInterventions = array(
			'Les interventions à venir' => $futur,
			'Les interventions passées' => $past
		 );
		 foreach ($allInterventions as $title => $intervgentions) {
		 	echo " <h2>".$title."</h2>";
			foreach ($intervgentions as $key => $value) {

			//  var_dump($value);
			  echo '<div class="container">';
			    echo $divType;
			      echo form_label($value['date']);
			    echo "</div>";
			    echo $divType;
						echo form_label($value['place']['descr']);
					echo "</div>";
					if($this->session->userdata['groupId']==500){
					echo $divType;
						echo form_label($value['intervenant']['username']);
			    echo "</div>";
				}
					echo $divType;
						echo anchor(
							'demarche/edit/' . $value["id_intrevention"],
							'éditer - completer',
							"class='btn btn-default'");
					echo "</div>";
			  echo "</div>";
			}
		 }

		?>
	</div>
</body>
