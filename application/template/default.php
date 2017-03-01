<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PSV</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>js/script.js" ></script>

	</head>
    <body role="document">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">PSV</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php
            $class = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            ?>
            <?php if ($is_logged): ?>
              <li class="dropdown<?php if ($class == 'demarche' || $class == 'meeting'): ?> active<?php endif; ?>">
                <a class="dropdown-toggle" data-toggle="dropdown">Direct
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(). index_page(). '/' . 'demarche/';?>">Collectif</a></li>
                    <li><a href="<?php echo base_url(). index_page(). '/' . 'meeting/';?>">Individuel</a></li>
                  </ul>
              <li <?php if ($class == 'indirect'): ?>class="active"<?php endif; ?>>
                <a href=<?php echo base_url(). index_page(). '/' . 'indirect/';?>>Indirect</a>
              </li>

            <?php else: ?>
              <li <?php if ($class == 'auth' && $method == 'login'): ?>class="active"<?php endif; ?>>
                <a href=<?php echo base_url() .index_page(). '/'. 'auth'; ?>>Se connecter</a>
              </li>
            <?php endif; ?>
          </ul>
          <?php  if($is_logged): ?>
              <ul class="nav navbar-nav navbar-right">
                <?php if ($groupId==500): ?>
                  <li <?php if ($class == 'reports'): ?>class="active"<?php endif; ?>>
                    <a href=<?php echo base_url(). index_page(). '/' . 'reports/';?>>Rapports</a>
                  </li>
                  <li <?php if ($class == 'admin'): ?>class="active"<?php endif; ?>>
                    <a href=<?php echo base_url(). index_page(). '/' . 'admin/';?>>Administration</a>
                  </li>
                <?php endif; ?>
                <li>
                  <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?>&nbsp<span class="glyphicon glyphicon-cog"/></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url() . index_page(). '/' . 'auth/logout'; ?>">Deconnection</a></li>
                    </ul>
                </li>
            </ul>
          <?php endif; ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main" style="padding-top: 70px">
      <?php /* load page view */ $this->load->basic_view($content_view); ?>
    </div>
  </body>
</html>
