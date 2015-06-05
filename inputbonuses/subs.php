<?php
$category = $_GET['category'];
if ($category == "Literature"){
	echo "<select name='subcategory'><option value='American'>American</option><option value='British'>British</option><option value='European'>European</option><option value='World'>World</option><option value='Classical'>Classical</option><option value='Other'>Other</option></select>";
}
elseif ($category == "History"){
	echo "<select name='subcategory'><option value='American'>American</option><option value='British'>British</option><option value='European'>European</option><option value='World'>World</option><option value='Classical'>Classical</option><option value='Other'>Other</option></select>";
}
elseif ($category == "Science"){
	echo "<select name='subcategory'><option value='Biology'>Biology</option><option value='Chemistry'>Chemistry</option><option value='Physics'>Physics</option><option value='Math'>Math</option><option value='Computer Science'>Computer Science</option><option value='Other'>Other</option></select>";
}
elseif ($category == "Fine Arts"){
	echo "<select name='subcategory'><option value='Auditory'>Auditory</option><option value='Visual'>Visual</option><option value='Audiovisual'>Audiovisual</option><option value='Other'>Other</option></select>";
}
else{
	echo "<select name='subcategory'><option>None</option></select>";
}
?>