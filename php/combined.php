<?php
$qtype = $_GET ['qtype'];
if ($qtype == "TossupBonus"){    
$button = $_GET ['submit'];
$search = $_GET ['info'];
$stype = $_GET ['stype'];

//validating search term length and connecting to db

if(strlen($search)<=1) {
echo "<p>Search term too short!</p>";}
else{
$searcha = stripslashes($search);
echo "You searched for <b><em>$searcha</em></b>, and ";}

mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");



//validating search term for protection; if statement to avoid errors being displayed
if (strlen($search)>1){
mysql_real_escape_string($search);}


//exploding search with multiple words   
$search_exploded = explode (" ", $search); //creates array of all terms in search

foreach($search_exploded as $search_each) //loops through array
{
$x++;
if($x==1)
$construct .="(Answer COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; //if only one value in array
else
$construct .="AND (Answer COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; //for each multiple value in array
}
if($stype == "AnswerQuestion") {
$construct .="OR (Question COLLATE utf8_general_ci LIKE _utf8'%$search%' COLLATE utf8_general_ci)";
}

$cat = $_GET ['categ']; //preparing array (multiple choices)
$sub = $_GET ['sub'];
if (strlen($search)>1){
mysql_real_escape_string($cat);
mysql_real_escape_string($sub);}

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}

$dif = $_GET ['difficulty'];
if(strlen($search)>1) {
mysql_real_escape_string($dif);}

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}

if(strlen($search)>1) {
mysql_real_escape_string($tournamentyear);
}


$tournamentyear = $_GET ['tournamentyear'];
if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


$constructs ="SELECT * FROM tossupsdbnew WHERE ($construct) $newvar $subvar $difvar $tournamentvar"; //completed search query



//quering the database; if statement to avoid errors being displayed
if (strlen($search)>1){
$run = mysql_query($constructs);}
    




//number of results found; if statement to avoid errors being displayed
if (strlen($search)>1){
$foundnum = mysql_num_rows($run);}
    
if ($foundnum==0)
echo "Sorry, there are no matching tossups.</br>1. 
Try more general words. </br>2. Try different words with similar
 meaning</br>3. Please check your spelling </br>";
else
{   
echo "<span class='badge badge-warning'> $foundnum </span>  tossups were found:<hr size='5'>";
  
$per_page = 10000; //preparing for pagination; results that appear per page
$start = $_POST['start']; //where to start results on page
$max_pages = ceil($foundnum / $per_page); //number of pages there will be
if(!$start) //starting at 0
$start=0; 
$getquery = mysql_query("SELECT * FROM tossupsdbnew WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC LIMIT $start, $per_page");
  
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
<div class='row'><div class='span8'><em><strong>ANSWER:</strong></em> $answer </div></div></div><hr>
";
$a++;
}

  
//Pagination Starts
echo "<center>";
  
$prev = $start - $per_page;
$next = $start + $per_page;
                       
$adjacents = 3;
$last = $max_pages - 1;
  
if($max_pages > 1)
{   
//previous button
if (!($start<=0)) 
echo " <a class='btn btn-primary btn-large' href='search.php?search=$search&submit=Search+source+code&start=$prev'>Prev</a> ";    
          
//pages 
if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
{
$i = 0;   
for ($counter = 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
}  
$i = $i + $per_page;                 
}
}
elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
{
//close to beginning; only hide later pages
if(($start/$per_page) < 1 + ($adjacents * 2))        
{
$i = 0;
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
} 
$i = $i + $per_page;                                       
}
                          
}
//in middle; hide some front and some back
elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
{
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
 
$i = $start;                 
for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
}   
$i = $i + $per_page;                
}
                                  
}
//close to end; only hide early pages
else
{
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
 
$i = $start;                
for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";   
} 
$i = $i + $per_page;              
}
}
}
          
//next button
if (!($start >=$foundnum-$per_page))
echo " <a class='btn btn-primary btn-large' href='search.php?search=$search&submit=Search+source+code&start=$next'>Next</a> ";    
}   
echo "</center>";
}

$construct = "";   
$search_exploded = explode (" ", $search);
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="((Answer1 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
else
$construct .=" AND (Answer1 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
$x++;
}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR ((Answer2 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
else
$construct .=" AND (Answer2 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; 
$x++;}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR ((Answer3 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
else
$construct .=" AND (Answer3 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; 
$x++;
}
$construct .=")";
if($stype == "AnswerQuestion") {
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR ((Question1 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
else
$construct .="AND (Question1 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; 
$x++;
}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR ((Question2 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
else
$construct .="AND (Question2 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; 
$x++;
}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR ((Question3 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)";
else
$construct .="AND (Question3 COLLATE utf8_general_ci LIKE _utf8'%$search_each%' COLLATE utf8_general_ci)"; 
$x++;
}
$construct .=")";
$in ="OR Intro COLLATE utf8_general_ci LIKE _utf8'%$search%' COLLATE utf8_general_ci";
$construct .= $in; 
}
$cat = $_GET ['categ']; //preparing array (multiple choices)
$sub = $_GET ['sub'];
if (strlen($search)>1){
mysql_real_escape_string($cat);
mysql_real_escape_string($sub);}

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}


$dif = $_GET ['difficulty'];
if(strlen($search)>1) {
mysql_real_escape_string($dif);}

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}

if(strlen($search)>1) {
mysql_real_escape_string($tournamentyear);
}


$tournamentyear = $_GET ['tournamentyear'];
if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}
  
$constructs ="SELECT * FROM bonusesdb WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC";

if(strlen($search)<=1) {
echo " ";}
else{
$searcha = stripslashes($search);
echo "You searched for <b><em>$searcha</em></b>, and ";
$run = mysql_query($constructs);
$foundnum = mysql_num_rows($run);}
    
if ($foundnum==0)
echo "<br>Sorry, there are no matching bonuses.</br>1. 
Try more general words </br>2. Try different words with similar
 meaning</br>3. Please check your spelling";
else
{ 
  
echo " <span class='badge badge-warning'> $foundnum </span>  bonuses were found:<hr size='5'>";
  
$per_page = 10000; //preparing for pagination; results that appear per page
$start = $_POST['start']; //where to start results on page
$max_pages = ceil($foundnum / $per_page); //number of pages there will be
if(!$start) //starting at 0
$start=0; 
$getquery = mysql_query("SELECT * FROM bonusesdb WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC LIMIT $start, $per_page");
  
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
</div>
</div>
";
$a++;
}

  
}
}
elseif ($qtype == "Tossups"){

$button = $_GET ['submit'];
$search = $_GET ['info'];
$stype = $_GET ['stype'];

//validating search term length and connecting to db

if(strlen($search)<=1) {
echo "<p>Search term too short</p>";}
else{
$searcha = stripslashes($search);
echo "You searched for <b><em>$searcha</em></b>, and ";
mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");}



//validating search term for protection; if statement to avoid errors being displayed
if (strlen($search)>1){
mysql_real_escape_string($search);}


//exploding search with multiple words   
$search_exploded = explode (" ", $search); //creates array of all terms in search

foreach($search_exploded as $search_each) //loops through array
{
$x++;
if($x==1)
$construct .="Answer LIKE '%$search_each%'"; //if only one value in array
else
$construct .="AND Answer LIKE '%$search_each%'"; //for each multiple value in array

}


if($stype == "AnswerQuestion") {
$construct .="OR Question LIKE '%$search%'";
}



$cat = $_GET ['categ']; //preparing array (multiple choices)
$sub = $_GET ['sub'];
if (strlen($search)>1){
mysql_real_escape_string($cat);
mysql_real_escape_string($sub);}

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}

$dif = $_GET ['difficulty'];
if(strlen($search)>1) {
mysql_real_escape_string($dif);}

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}

if(strlen($search)>1) {
mysql_real_escape_string($tournamentyear);
}


$tournamentyear = $_GET ['tournamentyear'];
if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


$constructs ="SELECT * FROM tossupsdbnew WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC"; //completed search query



//quering the database; if statement to avoid errors being displayed
if (strlen($search)>1){
$run = mysql_query($constructs);}
    




//number of results found; if statement to avoid errors being displayed
if (strlen($search)>1){
$foundnum = mysql_num_rows($run);}
    
if ($foundnum==0)
echo "sorry, there are no matching results for <b>$search</b>.</br></br>1. 
Try more general words. </br>2. Try different words with similar
 meaning</br>3. Please check your spelling";
else
{   
echo "<span class='badge badge-warning'> $foundnum </span>  tossups were found:<hr size='5'>";
  
$per_page = 10000; //preparing for pagination; results that appear per page
$start = $_POST['start']; //where to start results on page
$max_pages = ceil($foundnum / $per_page); //number of pages there will be
if(!$start) //starting at 0
$start=0; 
$getquery = mysql_query("SELECT * FROM tossupsdbnew WHERE ($construct) $newvar $subvar $difvar $tournamentvar LIMIT $start, $per_page");
  
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
<div class='row'><div class='span8'><em><strong>ANSWER:</strong></em> $answer </div></div></div><hr>
";
$a++;
}

  
//Pagination Starts
echo "<center>";
  
$prev = $start - $per_page;
$next = $start + $per_page;
                       
$adjacents = 3;
$last = $max_pages - 1;
  
if($max_pages > 1)
{   
//previous button
if (!($start<=0)) 
echo " <a class='btn btn-primary btn-large' href='search.php?search=$search&submit=Search+source+code&start=$prev'>Prev</a> ";    
          
//pages 
if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
{
$i = 0;   
for ($counter = 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
}  
$i = $i + $per_page;                 
}
}
elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
{
//close to beginning; only hide later pages
if(($start/$per_page) < 1 + ($adjacents * 2))        
{
$i = 0;
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
} 
$i = $i + $per_page;                                       
}
                          
}
//in middle; hide some front and some back
elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
{
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
 
$i = $start;                 
for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
}   
$i = $i + $per_page;                
}
                                  
}
//close to end; only hide early pages
else
{
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
 
$i = $start;                
for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a class='btn' href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";   
} 
$i = $i + $per_page;              
}
}
}
          
//next button
if (!($start >=$foundnum-$per_page))
echo " <a class='btn btn-primary btn-large' href='search.php?search=$search&submit=Search+source+code&start=$next'>Next</a> ";    
}   
echo "</center>";
} 
}
else{
	$button = $_GET ['submit'];
$search = $_GET ['info'];
$stype = $_GET ['stype'];

//validating search term length and connecting to db

if(strlen($search)<=1) {
echo "<p>Search term too short</p>";}
else{
echo "You searched for <b><em>$search</em></b>, and ";
mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");}



//validating search term for protection; if statement to avoid errors being displayed
if (strlen($search)>1){
mysql_real_escape_string($search);}


//exploding search with multiple words   
$search_exploded = explode (" ", $search);
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="Answer1 LIKE '%$search_each%'";
else
$construct .=" AND Answer1 LIKE '%$search_each%'";
$x++;
}
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR (Answer2 LIKE '%$search_each%'";
else
$construct .=" AND Answer2 LIKE '%$search_each%'"; 
$x++;}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR (Answer3 LIKE '%$search_each%'";
else
$construct .=" AND Answer3 LIKE '%$search_each%'"; 
$x++;
}
$construct .=")";
if($stype == "AnswerQuestion") {
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR (Question1 LIKE '%$search_each%'";
else
$construct .="AND Question1 LIKE '%$search_each%'"; 
$x++;
}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR (Question2 LIKE '%$search_each%'";
else
$construct .="AND Question2 LIKE '%$search_each%'"; 
$x++;
}
$construct .=")";
$x = 1;
foreach($search_exploded as $search_each)
{
if($x==1)
$construct .="OR (Question3 LIKE '%$search_each%'";
else
$construct .="AND Question3 LIKE '%$search_each%'"; 
$x++;
}
$construct .=")";
$in ="OR Intro LIKE '%$search%'";
$construct .= $in; 
}
$cat = $_GET ['categ']; //preparing array (multiple choices)
$sub = $_GET ['sub'];
if (strlen($search)>1){
mysql_real_escape_string($cat);
mysql_real_escape_string($sub);}

if($cat=="All") {
$newvar = "";}
else
{$newvar = "AND Category = '$cat'";} //if category is chosen

if($sub=="None" || $sub=="All") {
$subvar = "";}
else
{$subvar = "AND Subcategory = '$sub'";}


$dif = $_GET ['difficulty'];
if(strlen($search)>1) {
mysql_real_escape_string($dif);}

if($dif=="All") {
$difvar = "";}
else{
    $difvar = "AND Difficulty = '$dif'";}

if(strlen($search)>1) {
mysql_real_escape_string($tournamentyear);
}


$tournamentyear = $_GET ['tournamentyear'];
if($tournamentyear=="All") {
	$tournamentvar = "";}
else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}
  
$constructs ="SELECT * FROM bonusesdb WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC";


$run = mysql_query($constructs);

$foundnum = mysql_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
Try more general words. for example: If you want to search 'how to create a website'
then use general keyword like 'create' 'website'</br>2. Try different words with similar
 meaning</br>3. Please check your spelling";
else
{ 
  
echo " <span class='badge badge-warning'> $foundnum </span>  bonuses were found:<hr size='5'>";
  
$per_page = 10000; //preparing for pagination; results that appear per page
$start = $_POST['start']; //where to start results on page
$max_pages = ceil($foundnum / $per_page); //number of pages there will be
if(!$start) //starting at 0
$start=0; 
$getquery = mysql_query("SELECT * FROM bonusesdb WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC LIMIT $start, $per_page");
  
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
</div>
</div>";



$a++;
}

  
}
}	
?>