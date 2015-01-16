<?php
    
$button = $_GET ['submit'];
$search = $_GET ['info'];
$stype = $_GET ['stype'];
$sub = $_GET ['sub'];
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
if (strlen($search)>1){
mysql_real_escape_string($cat);}




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
	$explode = explode(' ', $tournamentyear);
	$yvalue = $explode[0];
	$tvalue = $explode[1];
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
echo "sorry, there are no matching results for <b>$search</b>.</br></br>1. 
Try more general words. </br>2. Try different words with similar
 meaning</br>3. Please check your spelling";
else
{   
echo " <span class='badge badge-info'> $foundnum </span>  results were found:<hr size='5'>";
  
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

echo "<div><span style='font-size: 13px'>Result:</span> $a</span>
<b>$tournament | $year | $round | $num | $category | $subcategory</b>
<p><em>Question:</em> $question</p>
<em><strong>ANSWER:</strong></em> $answer</br></br></br></br>
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
 
?>