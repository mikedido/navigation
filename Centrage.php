<?php

$masse_max=780;
$masse_total = 547;

$moment_avion = number_format(547.00 * 0.300, 3);
$moment_passagers = 0;
$moment_bagages = 0;
$moment_carburant = 0;
$bras_levier_total = 0;
$moment_total = 164.185;
$bras_levier_total = 164.185 / 547;

/*$_POST['pilote'] = 0;
$_POST['pax'] = 0;
$_POST['bagages'] = 0;
$_POST['carburant'] = 0;*/


//calcul de la masse
$masse_total = $masse_total + $_POST['pilote'] + $_POST['pax']+ $_POST['bagages'] +($_POST['carburant'] * 0.72);

$moment_passagers = ($_POST['pilote'] + $_POST['pax']) * 0.45;
$moment_bagages = $_POST['bagages'] * 1.2;
$moment_carburant = ($_POST['carburant'] * 0.72) * 1.1; 

$moment_total = $moment_passagers + $moment_bagages + $moment_carburant + $moment_avion;

$bras_levier_total = round($moment_total/$masse_total, 2);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Masse et Centrage</title>
		<!-- load the d3.js library -->    
		<script src="http://d3js.org/d3.v3.min.js"></script>
	</head>
	<style> /* set the CSS */

body { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}

.area {
    fill: lightsteelblue;
    stroke-width: 0;
}

.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}

</style>
	<body>	
		<h2>Masse et centrage</h2>
		<form method="post" action="Centrage.php">
			<fieldset class="form-group">
    			<legend>Avion F-GNNO</legend>
    				<div class="form-group">
  			  			<label for="formGroupExampleInput">Pilote</label>
  			  			<input type="number" value="<?php echo $_POST['pilote']; ?>" min="0" class="form-control" id="pilote" name="pilote" placeholder="Kg">
  					</div>
  					<div class="form-group">
  			  			<label for="formGroupExampleInput">Pax avant droit</label>
  			  			<input type="number" value="<?php echo $_POST['pax']; ?>" min="0" class="form-control" id="pax" name="pax" placeholder="Kg">
  					</div>
  					<div class="form-group">
  			  			<label for="formGroupExampleInput">Bagages</label>
  			  			<input type="number" value="<?php echo $_POST['bagages']; ?>" min="0" class="form-control" id="bagages" name="bagages" placeholder="Kg">
  					</div>
  					<div class="form-group">
  			  			<label for="formGroupExampleInput">Carburant</label>
  			  			<input type="number" value="<?php echo $_POST['carburant']; ?>" min="0" max="112" class="form-control" id="carburant" name="carburant" placeholder="Litres">
  					</div>
  			</fieldset>
  			<button type="submit" class="btn btn-primary">Calculer</button>
		</form>
		<table border="1px">
			<tr>
				<td></td>
				<td>Masse</td>
				<td>Levier</td>
				<td>Moment</td>
			</tr>
			<tr>
				<td>Avion</td>
				<td>547,00</td>
				<td>0,300</td>
				<td><?php echo $moment_avion; ?></td>
			</tr>
			<tr>
				<td>Pilote et passager avant</td>
				<td><?php echo ($_POST['pilote'] + $_POST['pax']); ?></td>
				<td>0,450</td>
				<td><?php echo $moment_passagers; ?></td>
			</tr>
			<tr>
				<td>Bagages</td>
				<td><?php echo $_POST['bagages']; ?></td>
				<td>1,200</td>
				<td><?php echo $moment_bagages; ?></td>
			</tr>
			<tr>
				<td>Essance</td>
				<td><?php echo $_POST['carburant']*0.72; ?></td>
				<td>1,100</td>
				<td><?php echo $moment_carburant; ?></td>
			</tr>
			<tr>
				<td>Huile</td>
				<td colspan=3>Compris dans masse à vide</td>
			</tr>
			<tr>
				<td>Total</td>
				<td><?php echo $masse_total; ?></td>
				<td><?php echo $bras_levier_total; ?></td>
				<td><?php echo $moment_total;?></td>
			</tr>
		</table>

<script>

dataJson = [{
	masse: "580", 
	levier: "0.30"
}, {
	masse: "780", 
	levier: "0.32"
}];

// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 600 - margin.left - margin.right,
    height = 370 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%d-%b-%y").parse;

// Set the ranges
var x = d3.scale.linear().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(15);

var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(20);

// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.levier); })
    .y(function(d) { return y(d.masse); });
    
// Adds the svg canvas
var svg = d3.select("body")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", 
              "translate(" + margin.left + "," + margin.top + ")");

// Get the data
d3.csv("data.csv", function(error, data) {
    data.forEach(function(d) {
        d.masse = d.masse;
        d.levier = +d.levier;
    });

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.levier; }));
    y.domain([0, d3.max(data, function(d) { return d.masse; })]);

    // Add the valueline path.
    svg.append("path")
        .attr("class", "line")
        .attr("d", valueline(data));

    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

});


</script>
	</body>
</html>