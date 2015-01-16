<?php session_start(); ?>
<html>
<head>
<title>Quinterest: Input Questions</title>
<script type="text/javascript">
function showStuff(str){
	if (str.length==0){ 
		document.getElementById("display").innerHTML="";
		return;
	}
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function(){
  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		document.getElementById("display").innerHTML=xmlhttp.responseText;
  		}
  	}
	xmlhttp.open("GET","show.php?p="+str,true);
	xmlhttp.send();
}
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
<form> 
Password: <input type="password" onkeyup="showStuff(this.value)" size="20" />
</form>
<span id="display"></span>
</body>
</html>