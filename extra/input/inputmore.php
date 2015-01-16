<?php session_start(); ?>
<html>
<head>
<title>Quinterest: Input Questions</title>
<script type="text/javascript">
function subcategories(str){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
 		xmlhttp=new XMLHttpRequest();
 	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 	}
	xmlhttp.onreadystatechange= function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("subcategories").innerHTML=xmlhttp.responseText;
			}
		}
	xmlhttp.open("GET","subs.php?category="+str,true);
	xmlhttp.send();
}
</script>
</head>
<body>
<?php
$_SESSION['i']++;
$i = $_SESSION['i'] + 1;
echo "<form action='./inputmore2.php' method='post'>";
echo "Tossup $i: <textarea name='tossup' rows='10' cols='75'></textarea><br />";
echo "Answer: <input type='text' name='answer' /><br />";
echo "Category: <select name='category' onChange='subcategories(this.form.category.options[this.form.category.selectedIndex].value);'><option value='Literature'>Literature</option><option value='History'>History</option><option value='Science'>Science</option><option value='Fine Arts'>Fine Arts</option><option value='Religion'>Religion</option><option value='Mythology'>Mythology</option><option value='Philosophy'>Philosophy</option><option value='Social Science'>Social Science</option><option value='Geography'>Geography</option><option value='Current Events'>Current Events</option><option value='Trash'>Trash</option></select><br />Subcategory: <span id='subcategories'><select name='subcategory'><option value='American'>American</option><option value='British'>British</option><option value='European'>European</option><option value='World'>World</option><option value='Classical'>Classical</option><option value='Other'>Other</option></select></span>";
echo "<input type='submit' value='Submit' />";
echo "<input type='reset' value='Reset' />";
echo "</form>";
?>
</body>
</html>