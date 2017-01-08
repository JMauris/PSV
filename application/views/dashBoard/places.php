<?php //setUp
	//$this->output->enable_profiler(true);
?>
<div class="container">
	<h3>Lieux</h3>
	<?php
		echo anchor(
			'places/create/',
			'Ajouter un nouveau lieu',
			"class='btn btn-primary btn-block'");
	?>
	<div class="container">
		<?php echo form_open('/places/updatePlaces/');?>
			<div id="placeTable">
				<div class="row">
				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Nom</th>
				        <th>Type</th>
				        <th>Adresse</th>
				        <th>Actif</th>
				        <th>Action</th>
				      </tr>
				    </thead>
				    <tbody>
				      <?php
				      foreach ($places as $key => $value) {
				        ?>
				          <tr class="<?php if($value['actived']==0):?>active<?php else:?>info<?php endif?>">
				            <td>
				              <?php echo form_label($value['Name']);?>
				            </td>
				            <td>
				              <?php echo form_label($value['descr']);?>
				            </td>
				            <td>
				              <?php
				                $stingedAdress="Aucune adresse";
				                if(false == ($value['adresse']==NULL)){
				                  $adresse = $value['adresse'];
				                  $stingedAdress = $adresse['line_1']."<br/>";
				                  if(false == ($adresse['line_2']==NULL))
				                    $stingedAdress = $stingedAdress . $adresse['line_2']."<br/>";
				                  $stingedAdress = $stingedAdress . $adresse['npa']." - ".$adresse['name'];
				                }
				                echo form_label($stingedAdress);
				              ?>
				            </td>
				            <td>
				              <?php
												echo form_hidden('places['.$value['id_lieu'].'][id_lieu]',$value['id_lieu']);
												echo form_hidden('places['.$value['id_lieu'].'][actived_old]',$value['actived']);
												echo form_checkbox('places['.$value['id_lieu'].'][actived]',1,$value['actived']);
		 									?>
				            </td>
				            <td>
				              <?php
				                echo anchor(
				                  'places/edit/' . $value["id_lieu"],
				                  'éditer',
				                  "class='btn btn-default'");
				              ?>
				            </td>
				          </tr>
				        <?php
				      }
				      ?>
				    </tbody>
				  </table>
				</div>
				<?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
		 	</div>
	 	<?php echo form_close(); ?>
	</div>

</div>
<div class="container">
	<h3>Type de lieu</h3>
	<div id="place_kindInserter">
		<?php echo form_open('/places/insertKind');?>
			<div class="row">
				<div  class="col-xs-8">
					<?php
						$input= array(
							'id' 		=> 'newKindName',
							'name'	=> 'newKindName',
							'class'	=> 'form-control');
							echo form_input($input);
					?>
				</div>
				<div class="col-xs-4">
					<?php	echo form_submit('submit_Profil', 'Ajouter un nouveau type',"class='btn btn-lg btn-primary btn-block'"); ?>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
	<div id="kindEditor">
		<?php echo form_open('/admin/citiesGroupEdit/');?>
			<div class="row">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Actif</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($kinds as $key => $value) {
							?>
								<tr class="<?php if($value['kind_actived']==0):?>active<?php else:?>info<?php endif?>">
									<td>
										<?php
											$input= array(
												'id' 		=> 'kinds['.$value['id_kind'].'][descr]',
												'name'	=> 'kinds['.$value['id_kind'].'][descr]',
												'class'	=> 'form-control',
												'value'	=>	$value['descr']
											);
												echo form_input($input);
										?>
									</td>
									<td>
										<?php	echo form_checkbox('kinds['.$value['id_kind'].'][kind_actived]',1,$value['kind_actived']);?>
									</td>
								</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
		<?php echo form_close(); ?>
	</div>
</div>
