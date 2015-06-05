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
$intros = $_SESSION['intros'];
$questions1 = $_SESSION['questions1'];
$questions2 = $_SESSION['questions2'];
$questions3 = $_SESSION['questions3'];
$answers1 = $_SESSION['answers1'];
$answers2 = $_SESSION['answers2'];
$answers3 = $_SESSION['answers3'];
$categories = $_SESSION['categories'];
$subcategories = $_SESSION['subcategories'];
foreach ($intros as $key => $value){
	$intro = mysql_real_escape_string ($value);
	$question1 = mysql_real_escape_string ($questions1[$key]);
	$answer1 = mysql_real_escape_string ($answers1[$key]);
	$question2 = mysql_real_escape_string ($questions2[$key]);
	$answer2 = mysql_real_escape_string ($answers2[$key]);
	$question3 = mysql_real_escape_string ($questions3[$key]);
	$answer3 = mysql_real_escape_string ($answers3[$key]);
	$category = $categories[$key]; 
	$subcategory = $subcategories[$key];
	$number = $key + 1;
	$query = "INSERT INTO `bonusesdb` (`Tournament`, `Year`, `Round`, `Difficulty`, `Question #`, `Category`, `Subcategory`, `Intro`, `Question1`, `Answer1`, `Question2`, `Answer2`, `Question3`, `Answer3`) VALUES ('$tournament', '$year', '$round', '$difficulty', '$number', '$category', '$subcategory', '$intro', '$question1', '$answer1', '$question2', '$answer2', '$question3', '$answer3')";
	$result = mysql_query($query);
}
?>
Questions sent to database!<br>
<a href="./input.php">Input another round</a>
</body>
</html>
