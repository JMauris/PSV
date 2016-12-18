<?php ?>
<html>
<head>
  <link rel= "stylesheet" href="<?php echo base_url("dist/css/bootstrap.min.css");?>" />
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/signin.css");?>" />

</head>
<body>
  <div class="container">
     <div class="form-signin">
      <div class="form-group">
      	<?php
        if($user['group_id']==500)
          echo anchor('/admin/', 'Administration', "class='btn btn-lg btn-primary btn-block'"); ?>
        <?php echo anchor('/intervention/', 'Intervention', "class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
    </div>
  </div>
</body>
</html>
