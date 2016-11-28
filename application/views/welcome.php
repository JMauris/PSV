<?php include_once('header.php'); ?>
<html>
<head>
  <link rel= "stylesheet" href="<?php echo base_url("dist/css/bootstrap.min.css");?>" />
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/signin.css");?>" />
</head>
<body>
  <div class="container">
     <div class="form-signin">
      <div class="form-group">
      	<?php echo anchor('/profil/profil/', 'Profil', "class='btn btn-lg btn-primary btn-block'"); ?>
      	<?php echo anchor('/formulaire/prospret/', 'Prospret', "class='btn btn-lg btn-primary btn-block'"); ?>
        <?php echo anchor('/formulaire/aideConseil/', 'Aides et Conseils', "class='btn btn-lg btn-primary btn-block'"); ?>
      </div>
    </div>
  </div>
</body>
</html>
