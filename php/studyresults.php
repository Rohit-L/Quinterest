<?php

    
$button = $_GET ['Randomize'];

$amount = $_GET ['amount'];
$sub = $_GET ['sub'];
$qtype = $_GET ['qtype'];

if ($qtype == "Tossups"){

mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");


$cat = $_GET ['categ']; //preparing array (multiple choices)
mysql_real_escape_string($cat);

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}

$dif = $_GET ['difficulty'];
mysql_real_escape_string($dif);

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}


$tournamentyear = $_GET ['tournamentyear'];
mysql_real_escape_string($tournamentyear);

if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


$constructs ="SELECT * FROM tossupsdbnew WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount"; //completed search query

$run = mysql_query($constructs);
    

$foundnum = mysql_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching tossups to study.";
else
{   
echo " <span class='badge badge-warning'> $foundnum </span>  tossups to study:<hr size='5'>";
  

$getquery = mysql_query("SELECT * FROM tossupsdbnew WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount");
  
$a = 1;
  
while($runrows = mysql_fetch_array($getquery)) //fetching results
{
$id = $runrows ['ID'];
$answer = stripslashes($runrows ['Answer']); //obtaining individual data from database
$category = $runrows ['Category']; //obtaining individual data from database
$subcategory = $runrows ['Subcategory']; //obtaining individual data from database
$num = $runrows ['Question #'];  //obtaining individual data from database
$difficulty = $runrows ['Difficulty'];  //obtaining individual data from database
$question = stripslashes($runrows ['Question']);  //obtaining individual data from database
$round = $runrows ['Round'];  //obtaining individual data from database
$tournament = $runrows ['Tournament'];  //obtaining individual data from database
$year = $runrows ['Year'];  //obtaining individual data from database

 
//what will be displayed on the results page 

echo "
<div style='border-radius: 20px'>
<div style='padding: 10px; span5'>
<span class='badge badge-warning'><span style='font-size: 13px'>Result:</span> $a</span> <span class='label label-warning' font-size='30px'><em>Tournament | Year | Round | Question # | Category | Subcategory </em></span><span style='float: right'>ID: $id</span></div>
<b>$tournament |</b> <b>$year |</b> <b>$round |</b> <b>$num |</b> <b>$category |</b> <b>$subcategory</b>
<p><em>Question:</em> $question</p>
<div class='row'><div class='span8'><em><strong>ANSWER:</strong></em> $answer </div><div class='span2' style='float: right'>
<a href='#errorReportmodel' class='btn btn-mini btn-inverse' data-toggle='modal'>Report an Error</a></div></div></div><hr>
";$a++;
}
}        

}   

elseif ($qtype == "Bonuses"){

mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");


$cat = $_GET ['categ']; //preparing array (multiple choices)
mysql_real_escape_string($cat);

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}

$dif = $_GET ['difficulty'];
mysql_real_escape_string($dif);

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}


$tournamentyear = $_GET ['tournamentyear'];
mysql_real_escape_string($tournamentyear);

if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


$constructs ="SELECT * FROM bonusesdb WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount"; //completed search query




$run = mysql_query($constructs);
    

$foundnum = mysql_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching bonuses to study.";
else
{   
echo " <span class='badge badge-warning'> $foundnum </span> bonuses to study:<hr size='5'>";
  

$getquery = mysql_query("SELECT * FROM bonusesdb WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount");
  
$a = 1;
  
while($runrows = mysql_fetch_assoc($getquery))
{
$a1 = $runrows ['Answer1'];
$a2 = $runrows ['Answer2'];
$a3 = $runrows ['Answer3'];
$category = $runrows ['Category'];
$num = $runrows ['Question #'];
$difficulty = $runrows ['Difficulty'];
$q1 = $runrows ['Question1'];
$q2 = $runrows ['Question2'];
$q3 = $runrows ['Question3'];
$intro = $runrows ['Intro'];
$round = $runrows ['Round'];
$tournament = $runrows ['Tournament'];
$year = $runrows ['Year'];  //obtaining individual data from database
$id = $runrows ['ID'];
   
echo

"
<div style='border-radius: 20px'><div style='padding: 10px'>
<span class='badge badge-warning'><span style='font-size: 13px'>Result:</span> $a</span> <span class='label label-warning' style='font-size: 12px'><em>Tournament | Year | Round | Question # | Category | Subcategory | Difficulty</em></span><span style='float: right'>ID: $id</span></div>
<b>$tournament |</b> <b>$year |</b> <b>$round |</b> <b>$num |</b> <b>$category |</b> <b>$subcategory |</b> <b>$difficulty</b>
<div><em>Question:</em> $intro For 10 points each:<br><strong>[10]</strong> $q1 <br><em><strong>ANSWER:</strong></em> $a1 <br><strong>[10]</strong> $q2 <br><em><strong>ANSWER:</strong></em> $a2 <br><strong>[10]</strong> $q3 <br><em><strong>ANSWER:</strong></em> $a3
<span style='float: right'><a href='#errorReportmodel' class='btn btn-mini btn-inverse' data-toggle='modal'>Report an Error</a></span>
</div>
</div>
";

$a++;
}
}
}   
else{
	

mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");


$cat = $_GET ['categ']; //preparing array (multiple choices)
mysql_real_escape_string($cat);

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}

$dif = $_GET ['difficulty'];
mysql_real_escape_string($dif);

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}


$tournamentyear = $_GET ['tournamentyear'];
mysql_real_escape_string($tournamentyear);

if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


$constructs ="SELECT * FROM tossupsdbnew WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount"; //completed search query




$run = mysql_query($constructs);
    

$foundnum = mysql_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching tossups to study.";
else
{   
echo " <span class='badge badge-warning'> $foundnum </span> tossups to study:<hr size='5'>";
  

$getquery = mysql_query("SELECT * FROM tossupsdbnew WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount");
  
$a = 1;
  
while($runrows = mysql_fetch_array($getquery)) //fetching results
{
$id = $runrows ['ID'];
$answer = $runrows ['Answer']; //obtaining individual data from database
$category = $runrows ['Category']; //obtaining individual data from database
$subcategory = $runrows ['Subcategory']; //obtaining individual data from database
$num = $runrows ['Question #'];  //obtaining individual data from database
$difficulty = $runrows ['Difficulty'];  //obtaining individual data from database
$question = $runrows ['Question'];  //obtaining individual data from database
$round = $runrows ['Round'];  //obtaining individual data from database
$tournament = $runrows ['Tournament'];  //obtaining individual data from database
$year = $runrows ['Year'];  //obtaining individual data from database

 
//what will be displayed on the results page 

$chrmap = array(
   "\'" => "'",
   '\"' => '"' 
);
$chr = array_keys  ($chrmap);
$rpl = array_values($chrmap); 
$question = str_replace($chr, $rpl, $question);

echo "
<div style='border-radius: 20px'>
<div style='padding: 10px; span5'>
<span class='badge badge-warning'><span style='font-size: 13px'>Result:</span> $a</span> <span class='label label-warning' font-size='30px'><em>Tournament | Year | Round | Question # | Category | Subcategory </em></span><span style='float: right'>ID: $id</span></div>
<b>$tournament |</b> <b>$year |</b> <b>$round |</b> <b>$num |</b> <b>$category |</b> <b>$subcategory</b>
<p><em>Question:</em> $question</p>
<div class='row'><div class='span8'><em><strong>ANSWER:</strong></em> $answer </div><div class='span2' style='float: right'>
<a href='#errorReportmodel' class='btn btn-mini btn-inverse' data-toggle='modal'>Report an Error</a></div></div></div><hr>
";
$a++;
}
}

         $cat = $_GET ['categ']; //preparing array (multiple choices)
mysql_real_escape_string($cat);

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}

$dif = $_GET ['difficulty'];
mysql_real_escape_string($dif);

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}


$tournamentyear = $_GET ['tournamentyear'];
mysql_real_escape_string($tournamentyear);

if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


$constructs ="SELECT * FROM bonusesdb WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount"; //completed search query




$run = mysql_query($constructs);
    

$foundnum = mysql_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching bonuses to study.";
else
{   
echo " <span class='badge badge-warning'> $foundnum </span>  bonuses to study:<hr size='5'>";
  

$getquery = mysql_query("SELECT * FROM bonusesdb WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar ORDER BY RAND() LIMIT $amount");
  
$a = 1;
  
while($runrows = mysql_fetch_assoc($getquery))
{
$a1 = stripslashes($runrows ['Answer1']);
$a2 = stripslashes($runrows ['Answer2']);
$a3 = stripslashes($runrows ['Answer3']);
$category = $runrows ['Category'];
$subcategory = $runrows ['Subcategory'];
$num = $runrows ['Question #'];
$difficulty = $runrows ['Difficulty'];
$q1 = stripslashes($runrows ['Question1']);
$q2 = stripslashes($runrows ['Question2']);
$q3 = stripslashes($runrows ['Question3']);
$intro = stripslashes($runrows ['Intro']);
$round = $runrows ['Round'];
$tournament = $runrows ['Tournament'];
$year = $runrows ['Year'];
$id = $runrows ['ID'];
   
echo

"
<div style='border-radius: 20px'><div style='padding: 10px'>
<span class='badge badge-warning'><span style='font-size: 13px'>Result:</span> $a</span> <span class='label label-warning' style='font-size: 12px'><em>Tournament | Year | Round | Question # | Category | Subcategory | Difficulty</em></span><span style='float: right'>ID: $id</span></div>
<b>$tournament |</b> <b>$year |</b> <b>$round |</b> <b>$num |</b> <b>$category |</b> <b>$subcategory |</b> <b>$difficulty</b>
<div><em>Question:</em> $intro For 10 points each:<br><strong>[10]</strong> $q1 <br><em><strong>ANSWER:</strong></em> $a1 <br><strong>[10]</strong> $q2 <br><em><strong>ANSWER:</strong></em> $a2 <br><strong>[10]</strong> $q3 <br><em><strong>ANSWER:</strong></em> $a3
<span style='float: right'><a href='#errorReportmodel' class='btn btn-mini btn-inverse' data-toggle='modal'>Report an Error</a></span>
</div>
</div>
";

$a++;
} 
}
}   
echo "</center>";

?>