<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Quinterest: A Searchable Quiz Bowl Database</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="With Quinterest, users have searchable access to a library of Quiz Bowl style questions from toss ups to bonuses and more. The database is fast and efficient for easy use.">
        <meta name="author" content="Quinterest was created by Rohit Lalchandani of Bassett High School">

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">

  <style type="text/css"></style></head>

            <script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function ajaxFunction(){
 var ajaxRequest;  // The variable that makes Ajax possible!
    
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 // Create a function that will receive data 
 // sent from the server and will update
 // div section in the same page.
 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('ajaxDiv');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }
 // Now get the value from user and pass it to
 // server script.
 var info = document.getElementById('inputInfo').value;
 var categ = document.getElementById('optionCategory').value;
 var subcateg = document.getElementById('optionSubcategory').value;
 var difficulty = document.getElementById('optionDifficulty').value;
 var stype = document.getElementById('optionstype').value;
 var qtype = document.getElementById('optionqtype').value;
 var tournamentyear = document.getElementById('optionTournament').value
 
 var queryString = "?info=" + info ;
 queryString +=  "&categ=" + categ + "&sub=" + subcateg + "&difficulty=" + difficulty + "&stype=" + stype + "&qtype=" + qtype + "&tournamentyear=" + tournamentyear;
 ajaxRequest.open("GET", "php/combined.php" + 
                              queryString, true);
 ajaxRequest.send(null); 
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
	xmlhttp.open("GET","./subs.php?category="+str,true);
	xmlhttp.send();
}
function listTournaments(difficulty, qtype){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
 		xmlhttp=new XMLHttpRequest();
 	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 	}
	xmlhttp.onreadystatechange= function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("tournament").innerHTML=xmlhttp.responseText;
			}
		}
	xmlhttp.open("GET","./list.php?qtype="+qtype+"&difficulty="+difficulty,true);
	xmlhttp.send();
}
//-->
</script>


<script src="http://code.jquery.com/jquery-1.10.1.min.js">
$("#inputInfo").keydown(function(event){
    if(event.keyCode == 13){
        $("#resultsbutton").click();
    }
});
</script>

<script>
$(document).ready(function(){
 
$('#submiterror').click(function(){
 
$.post("php/error.php", $("#Mycenaeanform").serialize(),  function(response) {
$('#success').html(response);
//$('#success').hide('slow');
});
return false;
 
});
 
});
</script>


<link rel="icon" 
      type="image/png" 
      href="/favicon">
      

  <body class="preview">
  </br>
<center>
<a href="/#desktop" style="font-family: Garamond"><strong>Return to Desktop Quinterest</strong></a>
</center>

<center>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Quinterest Mobile -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px"
     data-ad-client="ca-pub-5258405341760716"
     data-ad-slot="2877129540"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      </center>

    <div class="container">
      <br>
      
      <div class='alert alert-block' style='border-radius: 00px'>
      <div>
      
    <center>
    <h1 style="font-family: Georgia; font-size: 35px"><strong>Quinterest</strong></h1>
    <h5>Interface Friendly</h5>
    <div class="label label-inverse">
        <strong>BETA</strong>
    </div></div><br>
        
        <center>
        
        
        
     <center>     
     <form class="form-search" method="GET" action="php/interfaceresults.php">  
             

        
        <h4 style="padding: 5px">Category</h4>
        <select name='categ' id="optionCategory" onChange='subcategories(this.form.categ.options[this.form.categ.selectedIndex].value);'>
            <option value="All">All</option>
            <option value="Literature">Literature</option>
            <option value="History">History</option>
            <option value="Science">Science</option>
            <option value="Fine Arts">Fine Arts</option>
            <option value="Religion">Religion</option>
            <option value="Mythology">Mythology</option>
            <option value="Philosophy">Philosophy</option>
            <option value="Social Socience">Social Science</option>
            <option value="Geography">Geography</option>
            <option value="Current Events">Current Events</option>
            <option value="Trash">Trash</option>
        </select>
        
        <h4 style="padding: 5px">Subcategory</h5>
        <span id='subcategories'><select name='subcategory' id='optionSubcategory'>
            <option value="None">None</option>
        </select></span>
        
        <h4 style="padding: 5px">Search Type</h4>
        <select name='stype' id="optionstype">
            <option value="Answer">Answer</option>
            <option value="AnswerQuestion">Question & Answer</option>
        </select>
        <h4  style="padding: 5px">Question Type</h4>
        <select name='qtype' id="optionqtype" onChange='listTournaments(this.form.difficulty.options[this.form.difficulty.selectedIndex].value, this.form.qtype.options[this.form.qtype.selectedIndex].value);'>
            <option value="TossupBonus">Tossups and Bonuses</option>
            <option value="Tossups">Tossups Only</option>
            <option value="Bonuses">Bonuses Only</option>
        </select>
        <h4 style="padding: 5px">Difficulty</h4>
        <select name='difficulty' id="optionDifficulty" onChange='tournaments(this.form.difficulty.options[this.form.difficulty.selectedIndex].value);'>
            <option value="All">All</option>
            <option value="MS">Middle School</option>
            <option value="HS">High School</option>
            <option value="College">College</option>
            <option value="Open">Open</option>
        </select>

          <h4 style="padding: 5px">Tournament</h4>
        <span id='tournament'>
        <select name='tournament' id='optionTournament'>
        <option value='All'>All</option>
        </select></span>
        </br></br></br>
        <input type='text' placeholder="Search the Quinterest Database" class="input-xxlarge search-query" id="inputInfo" name='info'><br></br>
        <input type='button' id="resultsbutton" class="btn btn-large btn-primary" value='Search' onclick='ajaxFunction()'></br></br>
        <input type='submit' value='Print Option' class="btn btn-mini btn-inverse">

        </center>
          		</div>

     <script>
     $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>

    </form>
      </center>
    </div>
    
     <center>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Quinterest Mobile -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px"
     data-ad-client="ca-pub-5258405341760716"
     data-ad-slot="2877129540"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      </center
    
    <div class="container">
    <div id='ajaxDiv'>

    </div>
    <center>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Quinterest Mobile -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px"
     data-ad-client="ca-pub-5258405341760716"
     data-ad-slot="2877129540"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      </center>

      <div><center>
        <p style="font-size: 16px">Created by <strong>Rohit Lalchandani</strong> | Maintained by <strong>Jacob Reed</strong> | 2014</p>
      
    </div></div><br>

    </div> <!-- /container -->

    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
     <script src="js/holder/holder.js"></script>
     
     <script>
     $(function () {
        $('#popovernotice').popover();
     
     });
     </script>
     
     <script>
     $(function () {
        $('#interfacenotice').popover();
     
     });
     </script>
     
       <script>
     $("#inputInfo").keydown(function(event){
    if(event.keyCode == 13){
        $("#resultsbutton").click();
    }
});
</script>   

</body></html>