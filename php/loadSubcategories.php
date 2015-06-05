<?php
/*
 * Loads Subcategories into Search Form Based on Given Category
 */

/* Get given category */
$category = $_GET['category'];

echo "<select name='subcategory' class='form-control input-sm' id='optionSubcategory'>";

if ($category == "Literature") {
	echo "<option value='All'>All</option><option value='American'>American</option><option value='British'>British</option><option value='European'>European</option><option value='World'>World</option><option value='Classical'>Classical</option><option value='Other'>Other</option>";
} else if ($category == "History") {
	echo "<option value='All'>All</option><option value='American'>American</option><option value='British'>British</option><option value='European'>European</option><option value='World'>World</option><option value='Classical'>Classical</option><option value='Other'>Other</option>";
} else if ($category == "Science") {
	echo "<option value='All'>All</option><option value='Biology'>Biology</option><option value='Chemistry'>Chemistry</option><option value='Physics'>Physics</option><option value='Math'>Math</option><option value='Computer Science'>Computer Science</option><option value='Other'>Other</option>";
} else if ($category == "Fine Arts") {
	echo "<option value='All'>All</option><option value='Auditory'>Auditory</option><option value='Visual'>Visual</option><option value='Audiovisual'>Audiovisual</option><option value='Other'>Other</option>";
} else {
	echo "<option>None</option>";
}

echo "</select>";

?>
