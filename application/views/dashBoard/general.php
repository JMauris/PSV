	<div class="container G-DB">
<?php
  $divType = '<div class="col-sm-3 col-xs-6 element">'."\n";
	if($this->session->userdata['groupId']==500)
    $divType='<div class="col-md-2 col-sm-4 col-xs-6 element">'."\n";
	$divClass = "col-sm-4 col-xs-6 element";
	if($this->session->userdata['groupId']==500)
    $divClass="col-sm-3 col-xs-6 element";

	$allInterventions = array(
		'Les éléments à venir' => $futur,
		'Les éléments passés' => $past
	 );
	 ?>
	 <?php foreach ($allInterventions as $title => $interventions): ?>
	 	<h2><?php echo $title;?></h2>
		<?php foreach ($interventions as $key => $intervention): ?>
			<div class="container dashboardRow<?php if ($intervention['subClass']=='meeting'): echo' individualContener'; endif;?><?php if ($intervention['subClass']=='demarche'): echo' collectiveContener'; endif;?>">
				<div class="<?php echo $divClass; ?>">
					<?php echo form_label($intervention['date']); ?>
				</div>
				<?php if ($this->session->userdata['groupId']==500): ?>
					<div class="<?php echo $divClass; ?>">
						<?php echo form_label($intervention['username']); ?>
					</div>
				<?php endif; ?>
				<div class="<?php echo $divClass; ?>">
					<?php echo form_label($intervention['descr']); ?>
				</div>
				<div class="<?php echo $divClass; ?>">
				</div>
				<div class="<?php echo $divClass; ?>">
					<?php
						echo anchor(
							$intervention['subClass']."/edit/" . $intervention["id_intrevention"],
							'éditer - completer',
							"class='btn btn-default'");
					?>
				</div>
			</div>
		<?php endforeach; ?>

	 <?php endforeach; ?>
	<div>
