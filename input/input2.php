<?php session_start(); ?>
<html>
<head>
<title>Quinterest: Input Questions</title>
</head>
<body>
<?php
$dbc = mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4") OR die ('Could not connect to MySQL: ' . mysql_error() ); 
mysql_select_db("quinterestdb") OR die ('Could not select the database: ' . mysql_error() );
$tournament = $_SESSION['tournament'];
$year = $_SESSION['year'];
$difficulty = $_SESSION['difficulty'];
$round = $_SESSION['round'];
$tossups = $_SESSION['tossups'];
$answers = $_SESSION['answers'];
$categories = $_SESSION['categories'];
$subcategories = $_SESSION['subcategories'];

foreach ($tossups as $key => $value){
	$tossup = mysql_real_escape_string ($value);
	$answer = mysql_real_escape_string ($answers[$key]);
	$category = $categories[$key]; 
	$subcategory = $subcategories[$key];
	$number = $key + 1;
	$query = "INSERT INTO `tossupsdbnew` (`Answer`, `Category`, `Subcategory`, `Difficulty`, `Question #`, `Question`, `Round`, `Tournament`, `Year`) VALUES ('$answer', '$category', '$subcategory', '$difficulty', '$number', '$tossup', '$round', '$tournament', '$year')";
	$result = mysql_query($query);
}
?>
Questions sent to database!<br>
<a href="./input.php">Input another round</a>
</body>
</html>
