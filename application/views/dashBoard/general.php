	<div class="container G-DB">
<?php
  $divType = '<div class="col-sm-3 col-xs-6 element">'."\n";
	if($this->session->userdata['groupId']==500)
    $divType='<div class="col-md-2 col-sm-4 col-xs-6 element">'."\n";


	$allInterventions = array(
		'Les éléments à venir' => $futur,
		'Les éléments passés' => $past
	 );
	 foreach ($allInterventions as $title => $interventions) {
	 	echo " <h2>".$title."</h2>"."\n";
		foreach ($interventions as $key => $intervention) {
			echo '<div class="container '.$intervention['subClass'].'">'."\n";
			  echo $divType;
					echo form_label($intervention['date']);
				echo "</div>"."\n";
        if($this->session->userdata['groupId']==500){
					echo $divType;
						echo form_label("PROGRAMME");
			    echo "</div>"."\n";
          echo $divType;
            echo form_label($intervention['username']);
          echo "</div>"."\n";
				}
			  echo $divType;
					echo form_label($intervention['Name']);
				echo "</div>"."\n";

			  echo $divType;
					echo form_label($intervention['descr']);
				echo "</div>"."\n";
			  echo $divType;
					echo anchor(
						$intervention['subClass']."/edit/" . $intervention["id_intrevention"],
						'éditer - completer',
						"class='btn btn-default'");
				echo "</div>"."\n";
			echo "</div>"."\n";

		}
	 }
?>
<div>
