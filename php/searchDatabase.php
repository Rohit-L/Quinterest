<?php

/* Connecting to mySQL database */
mysql_connect("****","****","****");
mysql_select_db("****");

$tossup = false;
$bonus = false;

/* Get Inputs */
$qtype = $_GET ['qtype'];
mysql_real_escape_string($qtype);

$cat = $_GET['categ'];
mysql_real_escape_string($cat);

$sub = $_GET['sub'];
mysql_real_escape_string($sub);

$dif = $_GET['difficulty'];
mysql_real_escape_string($dif);

$tournamentyear = $_GET['tournamentyear'];
mysql_real_escape_string($tournamentyear);

$search = stripslashes($_GET['info']);
mysql_real_escape_string($search);
$search_exploded = explode(" ", $search);

$stype = $_GET['stype'];
mysql_real_escape_string($stype);

if ($_GET['limit'] == "yes") {
    $limit = true;
} else {
    $limit = false;
}

/* Get Question Type */
$qtype = $_GET ['qtype'];
if ($qtype == "TossupBonus") {
    $tossup = true;
    $bonus = true;
} else if ($qtype == "Tossups") {
    $tossup = true;
} else {
    $bonus = true;
}

/* Check Category */
if ($cat == "All") {
    $newvar = "";
} else {
    $newvar = "AND Category = '$cat'";
}

/* Check Subcategory */
if( $sub=="None" || $sub=="All") {
    $subvar = "";
} else {
    $subvar = "AND Subcategory = '$sub'";
}

/* Check Difficulty */
if( $dif == "All") {
    $difvar = "";
} else {
    $difvar = "AND Difficulty = '$dif'";
}

/* Check Tournament and Year */
if($tournamentyear == "All") {
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

    /* Constructing Query */
    $construct = "";
    foreach ($search_exploded as $search_each) { //loops through array
        $x++;
        if($x == 1) {
            $construct .='(Answer COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)'; //if only one value in array
        } else {
            $construct .='AND (Answer COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)'; //for each multiple value in array
        }
    }
    if($stype == "AnswerQuestion") {
        $construct .='OR (Question COLLATE utf8_general_ci LIKE _utf8"%' . $search . '%" COLLATE utf8_general_ci)';
    }
    $constructs = "SELECT * FROM tossupsdbnew WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC";

    if ($limit == true) {
        /* Querying the database */
        $getquery = mysql_query($constructs);
        $foundnum = mysql_num_rows($getquery);
        $getquery = mysql_query($constructs . " LIMIT 10");
    
        /* Display Number of Results */
        echo "
            <div id='tossupResults'>
                <div class='row'>
                    <div class='col-md-12'>
                        <center>
        ";

        if ($foundnum == 0) {
            echo "<p>Sorry, there are no matching tossups.</p>";
        } else {
            echo "<p>$foundnum Tossups Were Found</p>";
        }

        echo "
            </center></div></div><hr>
        ";
    } else {
        $getquery = mysql_query($constructs . " LIMIT 10, 18446744073709551615"); // Skips First 10 Rows
    }
    
    /* Displaying Results */ 
    if ($limit == true) {     
        $a = 1;
    } else {
        $a = 11;
    }

    while ($runrows = mysql_fetch_array($getquery)) { // Fetching results
        $id = $runrows['ID'];
        $answer = stripslashes($runrows['Answer']);
        $category = $runrows['Category'];
        $subcategory = $runrows['Subcategory'];
        $num = $runrows['Question #'];
        $difficulty = $runrows['Difficulty'];
        $question = stripslashes($runrows['Question']);
        $round = $runrows['Round'];
        $tournament = $runrows['Tournament'];
        $year = $runrows['Year'];

        // What will be displayed on the results page 
        echo "
            <div class='row'>
                <div class='col-md-12'>
                    <p><b>Result: $a | $tournament | $year | Round: $round | Question: $num | $category | $subcategory</b><span style='float: right'>ID: $id</span></p>
                    <p><em>Question:</em> $question</p>
                    <p><em><strong>ANSWER:</strong></em> $answer</p>
                </div> 
            </div>
            <hr>
        ";
        $a++;
    }

    if ($limit == true) {
        if ($foundnum > 10) {
            echo "
            <div id='loadAllTossups'>
                <div class='row'>
                    <div class='col-md-12'>
                        <center>
                        <button type='button' id='loadAllTossupsButton' class='btn btn-lg btn-primary'>Load All Tossups</button>
                        </center>
                    </div>
                </div>
                <hr>
            </div>
            ";
        }
        echo "</div> <!-- Closing tossupResults -->";
    }
}

/***********************/
/* BONUS QUESTION TYPE */
/***********************/
if ($bonus == true) {

    /* Constructing Bonus Query */
    $construct = "";   
    $x = 1;
    foreach ($search_exploded as $search_each) {
        if ($x == 1) {
            $construct .='((Answer1 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
        } else {
            $construct .=' AND (Answer1 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
        }
        $x++;
    }
    $construct .=")";

    $x = 1;
    foreach($search_exploded as $search_each) {
        if($x==1) {
            $construct .='OR ((Answer2 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
        } else {
            $construct .=' AND (Answer2 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
        }
        $x++;
    }
    $construct .=")";

    $x = 1;
    foreach($search_exploded as $search_each) {
        if($x==1) {
            $construct .='OR ((Answer3 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
        } else {
            $construct .=' AND (Answer3 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
        }
        $x++;
    }
    $construct .=")";

    if($stype == "AnswerQuestion") {

        $x = 1;
        foreach($search_exploded as $search_each) {
            if($x==1) {
                $construct .='OR ((Question1 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
            } else {
                $construct .='AND (Question1 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
            }
            $x++;
        }
        $construct .=")";

        $x = 1;
        foreach($search_exploded as $search_each) {
            if($x==1) {
                $construct .='OR ((Question2 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
            } else {
                $construct .='AND (Question2 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)'; 
            }
            $x++;
        }
        $construct .=")";

        $x = 1;
        foreach($search_exploded as $search_each) {
            if($x==1) {
                $construct .='OR ((Question3 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)';
            } else {
                $construct .='AND (Question3 COLLATE utf8_general_ci LIKE _utf8"%' . $search_each . '%" COLLATE utf8_general_ci)'; 
            }
            $x++;
        }
        $construct .=")";

        $construct .='OR Intro COLLATE utf8_general_ci LIKE _utf8"%' . $search . '%" COLLATE utf8_general_ci';
    }

    $constructs = "SELECT * FROM bonusesdb WHERE ($construct) $newvar $subvar $difvar $tournamentvar ORDER BY `Year` DESC,`Tournament` ASC,`Round` ASC,`Question #` ASC";
    
    if ($limit == true) {
        /* Query the Database */
        $getquery = mysql_query($constructs);
        $foundnum = mysql_num_rows($getquery);
        $getquery = mysql_query($constructs . " LIMIT 10");
    
        /* Display Number of Results */
        echo "
            <div id='bonusResults'>
                <div class='row'>
                    <div class='col-md-12'>
                        <center>
        ";

        if ($foundnum == 0) {
            echo "<p>Sorry, there are no matching bonuses.</p>";
        } else {
            echo "<p>$foundnum bonuses Were Found</p>";
        }

        echo "
            </center></div></div><hr>
        ";
    } else {
        $getquery = mysql_query($constructs . " LIMIT 10, 18446744073709551615"); // Skips First 10 Rows
    }
  
    /* Displaying Results */ 
    if ($limit == true) {     
        $a = 1;
    } else {
        $a = 11;
    }
    while ($runrows = mysql_fetch_array($getquery)) {
        $a1 = stripslashes($runrows['Answer1']);
        $a2 = stripslashes($runrows['Answer2']);
        $a3 = stripslashes($runrows['Answer3']);
        $category = $runrows['Category'];
        $subcategory = $runrows['Subcategory'];
        $num = $runrows['Question #'];
        $difficulty = $runrows['Difficulty'];
        $q1 = stripslashes($runrows['Question1']);
        $q2 = stripslashes($runrows['Question2']);
        $q3 = stripslashes($runrows['Question3']);
        $intro = stripslashes($runrows ['Intro']);
        $round = $runrows ['Round'];
        $tournament = $runrows ['Tournament'];
        $year = $runrows ['Year'];
        $id = $runrows ['ID'];

        echo "<div class='row'>
                <div class='col-md-12'>
                    <p><b>Result: $a | $tournament |$year | $round | $num | $category | $subcategory | $difficulty</b><span style='float: right'>ID: $id</span>
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
        $a++;
    }

    if ($limit == true) {
        if ($foundnum > 10) {
            echo "
                <div id='loadAllBonuses'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <center>
                            <button type='button' id='loadAllBonusesButton' class='btn btn-lg btn-primary'>Load All Bonuses</button>
                            </center>
                        </div>
                    </div>
                    <hr>
                </div>
            ";
        }
        echo "</div> <!-- Closing bonusResults -->";
    }
}
?>
