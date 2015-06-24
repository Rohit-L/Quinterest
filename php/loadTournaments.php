<?php
/*
 * Loads Tournament Listings into Search Form
 */

session_start();
/* Connect to SQL Database */ 
$dbc = mysql_connect("****","****","****") OR die ('Could not connect to MySQL: ' . mysql_error() ); 
mysql_select_db("****") OR die ('Could not select the database: ' . mysql_error() );

/* Get the Question Type */
$qtype = $_GET['qtype'];
if ($qtype == "Bonuses") {	
	$query = "SELECT `Difficulty`, `Tournament`, `Year` FROM `bonusesdb` GROUP BY `Tournament`, `Year`";
} else {
	$query = "SELECT `Difficulty`, `Tournament`, `Year` FROM `tossupsdbnew` GROUP BY `Tournament`, `Year`";
}

$result = mysql_query($query); // Get results from database query

/* Get the input difficulty */
$difficulty = $_GET['difficulty'];

/* Initialize arrays to hold data */
$difficulties = array();
$tournaments = array();
$years = array();
$names = array();

/* Add data from results to arrays */
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){ 
	$name = $row[2] . " " . $row[1];
	array_push($names, $name);
	array_push($difficulties, $row[0]);
	array_push($tournaments, $row[1]);
	array_push($years, $row[2]); 
}

/* Sort Arrays */
array_multisort($names, $difficulties, $tournaments, $years);


if ($difficulty == "All") {
	echo "<select name='tournament' class='form-control input-sm' id='optionTournament'><option value='All'>All</option>";
	foreach ($names as $key=>$value){
		if ($years[$key] != 0) {
			echo "<option value='$tournaments[$key],$years[$key]'>$value</option>";
		}
	}
} else {
	echo "<select name='tournament' class='form-control input sm' id='optionTournament'><option value='All'>All</option>";
	foreach ($names as $key=>$value){
		if ($difficulties[$key] == $difficulty){
		echo "<option value='$tournaments[$key],$years[$key]'>$value</option>";
		}
	}
}

echo "</select>";
?>