<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/add_fieldset.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<title>Navigation</title>
</head>

<body>

<?php

/*autoloader*/
function __autoload($class_name) {
    include 'class/'.$class_name . '.php';
}

/*printf("Bienvenue sur l'application de calcul <br />");

$avion = new Avion(90);

echo '<br />Facteur de base de l\'avion est :'.$avion->getFB();

$vent = new Vent(10, 180);

$branche1 = new Branche($avion, $vent, 20, 270);

echo '<br /> Temps sans vent : '.$branche1->getTempsSansVent();

echo '<br /> Xmax : '.$branche1->getXmax();

echo '<br /> X : '.$branche1->getX();

echo '<br /> Vent effectif : '.$branche1->getVentEffectif();

echo '<br /> Angle : '.$branche1->getAngle();

echo '<br /> VS : '.$branche1->getVS();

echo '<br /> New Facteur de base : '.$branche1->getNewFB();

echo '<br /> Temps avec vent : '.$branche1->getTempsAvecVent();*/
?>

<div class="container">
 <h2>Préparation navigation</h2>
<form method="post" action="Result.php" id="formNav">
	<fieldset class="form-group">
    	<legend>Avion</legend>
    		<div class="form-group">
  	  			<label for="formGroupExampleInput">VP avion</label>
  	  			<input type="number" min="0" class="form-control" id="vp" name="vp" placeholder="VP">
  			</div>
  	</fieldset>
  	<fieldset>
  		<legend>Vent</legend>
  		<div class="form-group">
  	  		<label for="formGroupExampleInput2">Force du vent (kt)</label>
  	  		<input type="number" min="0" class="form-control" id="forceVent" name="forceVent" placeholder="Force du vent">
  		</div>
  		<div class="form-group">
  	  		<label for="formGroupExampleInput2">Direction du vent (degrès)</label>
  	  		<input type="number" min="0" max="359" class="form-control" id="directionVent" name="directionVent" placeholder="Direction du vent">
  		</div>
  	</fieldset>
  	<fieldset>
  		<legend>Les branches</legend>
  			<button class="btn btn-success btn-add" type="button" onclick="Add();"><span class="glyphicon glyphicon-plus">ajouter</span></button>
  			<button class="btn btn-danger btn-minus" type="button" onclick="Delete();"><span class="glyphicon glyphicon-minus">Supprimer</span></button>
  			<div id="placeholder">
  				<div id="template">	
  				<fieldset>
  					<legend id="legend">Branche</legend>
  						<div class="form-group">
  	  						<label for="formGroupExampleInput2">Distance (NM)</label>
  	  						<input type="number" min="0" class="inputDistance form-control" name="brancheDistance" placeholder="Distance">
  						</div>
  						<div class="form-group">
  	  						<label for="formGroupExampleInput2">Direction (CAP)</label>
  	  						<input type="number" min="0" max="359" class="inputDirection form-control" name="brancheDirection" placeholder="Direction">
  						</div>
  				</fieldset>	
  				</div>
  			</div>
  		</fieldset>
  	</fieldset>
  	<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>