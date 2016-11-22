<?php include_once('/../header.php'); ?>
<html>
<head>
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/bootstrap.min.css");?>" />
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/signin.css");?>" />
</head>
<body>
	<div class="container">
  </br>
    <div class="form-group row">

    	<div class="radio">
      	<label><h4>Age moyen : </h4> </label>
    		<label>
    			<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> &lt 18 ans</label>
    		<label>
    			<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">18 - 35 ans</label>
    		<label>
    			<input type="radio" name="optionsRadios" id="optionsRadios3" value="option2">35 - 45 ans</label>
    		<label>
    			<input type="radio" name="optionsRadios" id="optionsRadios4" value="option2">	&gt 45 ans</label>
    	</div>
</div>
<div class="form-signin">
<div class="form-group">
	<?php echo anchor('/formulaire/origine/', 'Suivant', "class='btn btn-lg btn-primary btn-block'"); ?>
</div>
</div>
</div>
<body>
