<?php
 
/* Connect to mySQL database */  
mysql_connect("quinterestdb.db.11269592.hostedresource.com","quinterestdb","Quinterest!@#4");
mysql_select_db("quinterestdb");

/* Get input data */
$amount = $_GET['amount'];
mysql_real_escape_string($amount);
$tossupAmount = $amount;
$bonusAmount = $amount;
$sub = $_GET['sub'];
mysql_real_escape_string($sub);
$qtype = $_GET['qtype'];
mysql_real_escape_string($qtype);
$cat = $_GET ['categ'];
mysql_real_escape_string($cat);
$dif = $_GET['difficulty'];
mysql_real_escape_string($dif);
$tournamentyear = $_GET ['tournamentyear'];
mysql_real_escape_string($tournamentyear);

/* Check question type */
$tossup = false;
$bonus = false;
$qtype = $_GET ['qtype']; // Get Question Type
if ($qtype == "TossupBonus") {
    $tossup = true;
    $bonus = true;
} else if ($qtype == "Tossups") {
    $tossup = true;
} else {
    $bonus = true;
}

/* Check category */
if($cat=="All") {
	$newvar = "";
} else {
	$newvar = "AND Category = '$cat'";
}

if ($sub == "None" || $sub == "All") {
	$subvar = "";
} else {
	$subvar = "AND Subcategory = '$sub'";
}

/* Check difficulty */
if($dif=="All") {
	$difvar = "";
} else {
	$difvar = "AND Difficulty = '$dif'";
}

/* Check Tournament and Year */
if ($tournamentyear == "All") {
	$tournamentvar = "";
} else {
	$explode = explode(',', $tournamentyear);
	$tvalue = $explode[0];
	$yvalue = $explode[1];
	$tournamentvar = "AND (Tournament = '$tvalue' AND Year = '$yvalue')";
}


/************************/
/* TOSSUP QUESTION TYPE */
/************************/
if ($tossup == true) {

    /* Open results div */
    echo "
        <div class='row'>
            <div class='col-md-12'>
                <center>
    ";

	/* Run Query */
	$query ="SELECT * FROM tossupsdbnew WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar";
	$getQuery = mysql_query($query);
	$resultsSize = mysql_num_rows($getQuery);

    /* Displaying the number of results */
    if ($resultsSize == 0) {
        echo "<p>Sorry, there are no matching tossups.</p>";
    } else if ($resultsSize > $tossupAmount) {
        echo "<p>$tossupAmount Random Tossups Were Found That Match Your Search Settings</p>";
    } else {
        echo "<p>$resultsSize Random Tossups Were Found That Match Your Search Settings</p>";
        $tossupAmount = $resultsSize; // If resultsSize is smaller, change amount.
    }

    /* Close results div */
    echo "
                </center>
            </div>
        </div>
        <hr>
    ";

    /* Looping through and returning results */
    $resultsCounter = 1;
    $offsets = array();
    while ($resultsCounter <= $tossupAmount) {

        /* Getting an unused offset */
        $offset = rand(0, $resultsSize);
        while (in_array($offset, $offsets)) {
            $offset = rand(0, $resultsSize);
        }
        $offsets[$resultsCounter - 1] = $offset;


        $singleResult = $query . " LIMIT $offset, 1";
        $getQuery = mysql_query($singleResult);
        $row = mysql_fetch_array($getQuery);

        $id = $row['ID'];
        $answer = stripslashes($row['Answer']);
        $category = $row['Category'];
        $subcategory = $row['Subcategory'];
        $num = $row['Question #'];
        $difficulty = $row['Difficulty'];
        $question = stripslashes($row['Question']);
        $round = $row['Round'];
        $tournament = $row['Tournament'];
        $year = $row['Year'];

        // What will be displayed on the results page 
        echo "
            <div class='row'>
                <div class='col-md-12'>
                    <p><b>Result: $resultsCounter | $tournament | $year | $round | $num | $category | $subcategory</b><span style='float: right'>ID: $id</span></p>
                    <p><em>Question:</em> $question</p>
                    <p><em><strong>ANSWER:</strong></em> $answer</p>
                </div> 
            </div>
            <hr>
        ";
        $resultsCounter++;
    }
}

/***********************/
/* BONUS QUESTION TYPE */
/***********************/
if ($bonus == true) {

    /* Open results div */
    echo "
        <div class='row'>
            <div class='col-md-12'>
                <center>
    ";

	$query ="SELECT * FROM bonusesdb WHERE ID LIKE '%%%%' $newvar $subvar $difvar $tournamentvar"; //completed search query
    $getQuery = mysql_query($query);
    $resultsSize = mysql_num_rows($getQuery);
    

    /* Displaying the number of results */
    if ($resultsSize == 0) {
        echo "<p>Sorry, there are no matching bonuses.</p>";
    } else if ($resultsSize > $bonusAmount) {
        echo "<p>$bonusAmount Random Bonuses Were Found That Match Your Search Settings</p>";
    } else {
        echo "<p>$resultsSize Random Bonuses Were Found That Match Your Search Settings</p>";
        $bonusAmount = $resultsSize; // If resultsSize is smaller, change amount.
    }


    /* Close results div */
    echo "
                </center>
            </div>
        </div>
        <hr>
    ";

    /* Looping through and returning results */
    $resultsCounter = 1;
    $offsets = array();
    while ($resultsCounter <= $bonusAmount) {

        /* Getting an unused offset */
        $offset = rand(0, $resultsSize);
        while (in_array($offset, $offsets)) {
            $offset = rand(0, $resultsSize);
        }
        $offsets[$resultsCounter - 1] = $offset;

        $singleResult = $query . " LIMIT $offset, 1";
        $getQuery = mysql_query($singleResult);
        $row = mysql_fetch_array($getQuery);


        $a1 = stripslashes($row['Answer1']);
        $a2 = stripslashes($row['Answer2']);
        $a3 = stripslashes($row['Answer3']);
        $category = $row['Category'];
        $subcategory = $row['Subcategory'];
        $num = $row['Question #'];
        $difficulty = $row['Difficulty'];
        $q1 = stripslashes($row['Question1']);
        $q2 = stripslashes($row['Question2']);
        $q3 = stripslashes($row['Question3']);
        $intro = stripslashes($row['Intro']);
        $round = $row['Round'];
        $tournament = $row['Tournament'];
        $year = $row['Year'];
        $id = $row['ID'];

        echo "<div class='row'>
                <div class='col-md-12'>
                    <p><b>Result: $resultsCounter | $tournament |$year | $round | $num | $category | $subcategory | $difficulty</b><span style='float: right'>ID: $id</span>
                    <p><em>Question:</em> $intro </p>
                    <p><strong>[10]</strong> $q1</p>
                    <p><em><strong>ANSWER:</strong></em> $a1</p>
                    <p><strong>[10]</strong> $q2</p>
                    <p><em><strong>ANSWER:</strong></em> $a2</p>
                    <p><strong>[10]</strong> $q3</p>
                    <p><em><strong>ANSWER:</strong></em> $a3</p>
                </div>
            </div><hr>
        ";   
        $resultsCounter++;
    }
}

?>
