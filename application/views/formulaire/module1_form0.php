<?php include_once('/../header.php'); ?>
<html>
<head>
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/bootstrap.min.css");?>" />
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/signin.css");?>" />
</head>
<body>
	<div class="container">

<br>

<div class="form-group row">
	<div class="col-xs-4">
		<label for="example-text-input">Nom</label>
		<input class="form-control" type="text" id="example-text-input">
	</div>
	<div class="col-xs-4">
		<label for="example-text-input">Date</label>
		<input class="form-control" type="date" id="example-date-input">
	</div>
	<div class="col-xs-4">
		<label for="example-text-input">Lieu</label>
		<input class="form-control" type="text" id="example-text-input">
	</div>
	<div class="col-xs-4">
		<label for="example-text-input">Durée</label>
		<input class="form-control" type="time" value="13:45:00" id="example-time-input">
	</div>
	<div class="col-xs-4">
		<label for="example-text-input">KM</label>
		<input class="form-control" type="number"  id="example-number-input">
	</div>
	<div class="col-xs-4">
		<label for="example-text-input">note de frais</label>
		<input class="form-control" type="number" id="example-number-input">
	</div>
</div>
<div class="form-group row">
	<div class="radio">
		<label>
			<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Mail</label>
		<label>
			<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Entretiens</label>
		<label>
			<input type="radio" name="optionsRadios" id="optionsRadios3" value="option2">Téléphone</label>
		<label>
			<input type="radio" name="optionsRadios" id="optionsRadios4" value="option2">Démarche</label>
	</div>

<div class="form-group row">
  <label for="example-number-input" class="col-xs-2 col-form-label">Nombre d'entretien donnés</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-number-input">
  </div>
</div>
<div class="form-signin">
<div class="form-group">
	<?php echo anchor('/formulaire/type/', 'Suivant', "class='btn btn-lg btn-primary btn-block'"); ?>
</div>
</div>
</div>
<body>
