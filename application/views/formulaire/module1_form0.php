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
		<div class="col-xs-4">
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
</div>
<div class="form-group row">
		<div class="col-xs-7">
  <label for="example-number-input" class="col-xs-2 col-form-label">Nombre d'entretien donnés</label>
  <div class="col-xs-2">
    <input class="form-control" type="number" id="example-number-input">
  </div>
</div>
</div>

<div class="form-group row">
  <div class="col-xs-4">
    	<label for="example-text-input">HIV</label>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Brefs conseils
        </label>

  </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Conseils et aide aux presonnes suivies
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Conseils et aide aux proches
        </label>
    </div>

  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Préservatif homme</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-text-input">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Préservatif femme</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-text-input">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Préservatif Gel</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-text-input">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Cartes Antennes</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-text-input">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Brochures</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-text-input">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Flyers</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" id="example-text-input">
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-4">
    	<label for="example-text-input">HIV</label>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Safer Sex
        </label>

  </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Risque
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Dépistage
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Traitement
        </label>
    </div>
  </div>

  <div class="col-xs-4">
      <label for="example-text-input">IST</label>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Safer Sex
        </label>
  </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Risque
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Dépistage
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Traitement
        </label>
    </div>
  </div>

  <div class="col-xs-4">
      <label for="example-text-input">Vie</label>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Social
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
          Professionnelle
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Affective
        </label>
    </div>
    <div class="checkbox">
        <label>
          <input type="checkbox" value="">
        Famillale
        </label>
    </div>
  </div>

  <div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="col-xs-6">
        <div class="checkbox">
            <label>
              <input type="checkbox" value="">
              Pr. juridiques
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" value="">
              Pr.financiers
            </label>
        </div>
      </div>
    <div class="col-xs-6">
        <div class="checkbox">
            <label>
              <input type="checkbox" value="">
            Santé Physique
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" value="">
            Santé Psychiques
            </label>
        </div>

        <div class="checkbox">
            <label>
              <input type="checkbox" value="">
            Addictions
            </label>
        </div>
      </div>
    </div>
  </div>
	<h1>Lieu</h1>
	<div class="form-group row">
	<div class="col-xs-12">
		<div class="radio">
	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
	    Salon
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
	  Association
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option2">
	  Cabaret/Bar
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios4" value="option2">
	  Centre RA
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2">
	  Loisir/Coiffeur
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios6" value="option2">
	  Concert/Fête
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios7" value="option2">
	  LRE
	  </label>

	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios8" value="option2">
	    Lieu neutre ( restaurant, salle de cours...)
	  </label>
		</div>
	</div>



</div>
<body>
