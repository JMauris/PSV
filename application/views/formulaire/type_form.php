<?php include_once('/../header.php'); ?>
<html>
<head>
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/bootstrap.min.css");?>" />
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/signin.css");?>" />
</head>
<body>
	<div class="container">
    <div class="form-signin">
    <br>

    <div class="form-group row">
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
        Mail
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
      Entretiens
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option2">
      Téléphone
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios4" value="option2">
      Démarche
      </label>
    </div>
<div class="form-group">
	<?php echo anchor('/formulaire/categorie/', 'Suivant', "class='btn btn-lg btn-primary btn-block'"); ?>
</div>
</div>
</div>
<body>
