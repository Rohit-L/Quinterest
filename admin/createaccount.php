<?php session_start(); ?>
<html>
<head>
<title>Quinterest: Create Account</title>
</head>
<body>
<?php
$dbc = mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4") OR die ('Could not connect to MySQL: ' . mysql_error() ); 
mysql_select_db("quinterestdb") OR die ('Could not select the database: ' . mysql_error() );

$first = $_POST['first'];
$last = $_POST['last'];
$affiliation = $_POST['affiliation'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO `users` (`First Name`, `Last Name`, `Affiliation`, `Email`, `Username`, `Hash`, `Verified`) VALUES ('$first', '$last', '$affiliation', '$email', '$username', '$hash', 'N')";
$result = mysql_query($query);
?>
Account creation request sent! You should receive a follow-up email within the next few days.<br></body>
</html>