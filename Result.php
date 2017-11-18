<?php

/*autoloader*/
function __autoload($class_name) {
    include 'class/'.$class_name . '.php';
}

//récupération des variables
$avion = new Avion($_POST['vp']);
echo '<br />Facteur de base de l\'avion : '.$avion->getFB();

$vent = new Vent($_POST['forceVent'], $_POST['directionVent']);

$branches = array();

foreach ($_POST as $key => $value){
	
	if (preg_match('#^brancheDistance#', $key)) {
		//echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		$distance = $value;
		continue;
	}
	if (preg_match('#^brancheDirection#', $key)) {
		$direction = $value;
	}

	if (isset($distance) && isset($direction)) {
		echo '<h2> branche </h2>';
		$branche = new Branche($avion, $vent, $distance, $direction);
		array_push($branches, $branche);
		echo '<br /> Temps sans vent : '.$branche->getTempsSansVent().' minute(s)';
		echo '<br /> Xmax : '.$branche->getXmax();
		echo '<br /> X : '.$branche->getX();
		echo '<br /> Vent effectif : '.$branche->getVentEffectif();
		echo '<br /> Angle : '.$branche->getAngle();
		echo '<br /> VS : '.$branche->getVS();
		echo '<br /> Nouveau facteur de base : '.$branche->getNewFB();
		echo '<br /> Temps avec vent : '.$branche->getTempsAvecVent().' minute(s)';
	}
	
}

echo '<h2> log de nav : </h2>'
?>

<table border="1px">
	<tr>
		<td>RM</td>
		<td>CM</td>
		<td>Dist.(Nm)</td>
		<td>TsV (minutes)</td>
		<td>TaV (minutes)</td>
		<td>Branches</td>
	</tr>
<?php 
foreach ($branches as $branche)  {
	echo '<tr>';
		echo '<td>'.$branche->getCap().'</td>';
		echo '<td>'.$branche->getCapCorrected().'</td>';
		echo '<td>'.$branche->getDistance().'</td>';
		echo '<td>'.$branche->getTempsSansVent().'</td>';
		echo '<td>'.$branche->getTempsAvecVent().'</td>';
		echo '<td>branche</td>';
	echo '</tr>';

	//
	$totalSansVent+=$branche->getTempsSansVent();
	$totalAvecVent+=$branche->getTempsAvecVent();
	$totalDist+=$branche->getDistance();
}



//la derniere ligne
	echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>'.$totalDist.'</td>';
		echo '<td>'.$totalSansVent.'</td>';
		echo '<td>'.$totalAvecVent.'</td>';
		echo '<td></td>';
	echo '</tr>';
?>

</table>

<h2>Bilan carburant</h2>