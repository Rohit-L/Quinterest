<?php session_start(); 
$dbc = mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4") OR die ('Could not connect to MySQL: ' . mysql_error() ); 
mysql_select_db("quinterestdb") OR die ('Could not select the database: ' . mysql_error() );
$qtype = $_GET['qtype'];
if ($qtype == "Bonuses"){	
$query = "SELECT `Difficulty`, `Tournament`, `Year` FROM `bonusesdb` GROUP BY `Tournament`, `Year`";
}
else{
$query = "SELECT `Difficulty`, `Tournament`, `Year` FROM `tossupsdbnew` GROUP BY `Tournament`, `Year`";
}
$result = mysql_query($query);
$difficulty = $_GET['difficulty'];
$difficulties = array();
$tournaments = array();
$years = array();
$names = array();
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){ 
	$name = $row[2] . " " . $row[1];
	array_push($names, $name);
	array_push($difficulties, $row[0]);
	array_push($tournaments, $row[1]);
	array_push($years, $row[2]); 
}
array_multisort($names, $difficulties, $tournaments, $years);
if ($difficulty == "All"){
	echo "<select name='tournament' id='optionTournament'><option value='All'>All</option>";
	foreach ($names as $key=>$value){
		echo "<option value='$tournaments[$key],$years[$key]'>$value</option>";
	}
	echo "</select>";
}
else{
echo "<select name='tournament' id='optionTournament'><option value='All'>All</option>";
foreach ($names as $key=>$value){
	if ($difficulties[$key] == $difficulty){
		echo "<option value='$tournaments[$key],$years[$key]'>$value</option>";
	}
}
}
echo "</select>";
?>