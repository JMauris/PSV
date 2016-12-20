<?php var_dump($kind_place); ?>
<?php echo form_open($this->uri->uri_string()); ?>
<table class="table table-hover">
	<tr>
		<td><?php echo form_label('Nom'); ?></td>
		<td><?php echo form_password(); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Rue'); ?></td>
		<td><?php echo form_input(); ?></td>
	</tr>
  <tr>
		<td><?php echo form_label('NPA'); ?></td>
		<td><?php echo form_input(); ?></td>
	</tr>
  <tr>
    <td><?php echo form_label('Commune'); ?></td>
    <td><?php echo form_input(); ?></td>
  </tr>
  <tr>
    <td><?php echo form_label('Canton'); ?></td>
    <td><?php echo form_input(); ?></td>
  </tr>
  <tr>
    <td><?php echo form_label('Type'); ?></td>
    <td><?php echo form_dropdown('',$kind_place,''); ?></td>
  </tr>
</table>
<?php echo form_submit('change', 'Enregistrer'); ?>
<?php echo form_close(); ?>
