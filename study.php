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


<script>
if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile/i.test(navigator.userAgent) ) {

if(window.location.hash == "#desktop"){
    // Stay on desktop website
} else {
    window.location = "http://quinterest.org/interface.php";
}

}
</script>


    <!-- styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->

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
 var categ = document.getElementById('optionCategory').value;
 var difficulty = document.getElementById('optionDifficulty').value;
 var amount = document.getElementById('optionamount').value;
 var subcateg = document.getElementById('optionSubcategory').value;
 var tournamentyear = document.getElementById('optionTournament').value;
 var qtype = document.getElementById('optionqtype').value;
 
 var queryString = "?amount=" + amount ;
 queryString +=  "&qtype=" + qtype+ "&categ=" + categ + "&sub=" + subcateg + "&difficulty=" + difficulty + "&tournamentyear=" + tournamentyear;
 ajaxRequest.open("GET", "php/studyresults.php" + 
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
      

  <body class="preview" onload="listTournaments('All', '');">
  
 

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/" style="font-family: Georgia"><strong>Quinterest</strong></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <li><a href="/study.php">Study</a></li>
                <li><a href="http://hsquizbowl.org/forums/viewtopic.php?f=123&t=14574">Discussion</a></li>
              <li><a href="#aboutModal" data-toggle="modal">About</a></li>
              <li><a href="#contactModal" data-toggle="modal">Contact</a></li>
              <li><a href="#contributorsModal" data-toggle="modal">Contributors</a></li></ul>
              
            
                      
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
        
 
<!-- Modal -->
<div id="aboutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">About Quinterest</h3><h5>Version 2.0</h5>
  </div>
  <div class="modal-body">
    <p>Quinterest is a quiz bowl search engine, to help players play and write better. The name derives from the combination of “quiz bowl” and “interest.” The website has no affiliation with Pinterest.</p><hr>
    <p>Quinterest is simply a very elegant, streamlined database search engine. Certain aspects were taken into consideration when the search engine was created that would inprove upon user experience.</p>
    <ul><strong>For example:</strong>
        <li>The search engine is designed to be clean and easy-on-the-eyes, allowing users to focus more overall and have a better experience, all thanks to Twitter Bootstrap.
        <li>When viewing results, there is no pagination (unlimited results per page). This allows users to identify clues from individual questions more easily. In addition, when searching, the page does not refresh which saves your selected search parameters and reduces bandwidth usage.</li>
        <li>There is the ability to further specify search queries with the option to search by difficulty, category, and type. This allow users to focus on questions related to their level of quiz bowl and subject-choice.</li>
    </ul>
    
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>

<!-- Modal -->
<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Contact</h3>
  </div>
  <div class="modal-body">
    <p>If you have any questions, comments, concerns, suggestions, please send an email to Jacob Reed at <a href="mailto:jacob.alexander.reed@gmail.com">jacob.alexander.reed@gmail.com</a></p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<!-- Modal -->
<div id="contributorsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Contact</h3>
  </div>
  <div class="modal-body">
    <ul><strong>Contributors:</strong>
            <li>Brendan Byrne</li>        
            <li>Joshua Duncan</li>
            <li>Julian Fuchs</li>
            <li>Kenji Golimlim</li>
            <li>Matt Jackson</li>
            <li>Nicholas Karas</li>
            <li>Rohit Lalchandani</li>
            <li>Dan Pechi</li>
            <li>Jacob Reed</li>
            <li>Adam Silverman</li>
            <li>Nicholas Wawrykow</li>
            <li>Haohang Xu</li>
    </ul>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<!-- Modal -->
<div id="errorReportmodel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Report an Error</h3>
  </div>
  <div class="modal-body">
  
  
  </br><form action="" method="post" id="mycontactform" >
<span>Type: </span> <select name="Type" id="Type" />
            <option value="Tossup">Tossup</option>
            <option value="Bonus">Bonus</option>
            </select>

<br/>

<span>Question ID(s): </span> <input type="text" name="ID" id="ID" /><br/>
<span>Error Description: </span> <input type="text" name="ErrorDescription" id="ErrorDescription" /><br/></br>
<input type="button" value="Send Error Report" id="submiterror" class="btn btn-primary btn-large" /><br></br><div id="success"></div>
</form>
  
  
 
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-small" data-dismiss="modal" aria-hidden="true">Return to Search</button>
  </div>
</div>



    <div class="container">
      <br><center>
      </center>
      <div class='alert alert-block' style='border-radius: 0px'>
      <div>
      
    <center>
    <h1 style="font-family: Georgia; font-size: 70px; padding: 10px"><strong>Study</strong></h1>
    </div>
        
        <center>
        
        
        <hr>
          
     <form class="form-search">  
             <div class="row">

        <div class="span2">
        <h4 style="padding: 5px">Category</h4>
        <select name='category' id="optionCategory" onChange='subcategories(this.form.category.options[this.form.category.selectedIndex].value);'>
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
        </select></div>
        
        <div class="span2 offset1"><h4 style="padding: 5px">Amount</h4>
        <select name='stype' id="optionamount">
            <option value="5">5 Questions</option>
            <option value="10">10 Questions</option>
            <option value="25">25 Questions</option>
            <option value="50">50 Questions</option>
            <option value="100">100 Questions!</option>
        </select></div>
        
        <div class="span2 offset1">
        <h4  style="padding: 5px">Question Type</h4>
        <select name='qtype' id="optionqtype" onChange='listTournaments(this.form.difficulty.options[this.form.difficulty.selectedIndex].value, this.form.qtype.options[this.form.qtype.selectedIndex].value);'>
            <option value="TossupBonus">Tossups and Bonuses</option>
            <option value="Tossups">Tossups Only</option>
            <option value="Bonuses">Bonuses Only</option>
        </select></div>
        
        <div class="span2 offset1">
        <h4 style="padding: 5px">Difficulty</h4>
        <select name='difficulty' id="optionDifficulty" onChange='listTournaments(this.form.difficulty.options[this.form.difficulty.selectedIndex].value, this.form.qtype.options[this.form.qtype.selectedIndex].value);'>
            <option value="All">All</option>
            <option value="MS">Middle School</option>
            <option value="HS">High School</option>
            <option value="College">College</option>
            <option value="Open">Open</option>
        </select></div>
        
        <br />
        <div class="span2">
        <h4 style="padding: 5px">Subcategory</h4>
        <span id='subcategories'><select name='subcategory' id='optionSubcategory'>
            <option value="None">None</option>
        </select></span></div>
        
		<div class="span2 offset7">
        <h4 style="padding: 5px">Tournament</h4>
        <span id='tournament'>
        <select name='tournament' id='optionTournament'>
        <option value='All'>All</option>
        </select></span>
  		</div>

        </div><br />
        
        <input type='button' id="resultsbutton" class="btn btn-large btn-primary" value='Randomize' onclick='ajaxFunction()'></br>
        

        </center>
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
<div class="row">
        <div style="text-align: center" class="span2 offset1">
            <a href='#' class="btn btn-small btn-inverse" id="popovernotice" data-animation="true" data-placement="top" data-trigger="hover" data-content='If you see a question with an error in the database, please select the "Report an Error" button and fill in the required fields so it can be corrected. 
    We would like to keep the database as clean as possible. Two IDs are necessary to correct duplicate questions.'>NOTICE!</a>
        </div>
    </div>      
      
    </div>
    <center>
    <script type="text/javascript"><!--
google_ad_client = "ca-pub-5258405341760716";
/* Quinterest 2 */
google_ad_slot = "5531169545";
google_ad_width = 970;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>
    
    <div class="container">
    <div class='hero-unit' id='ajaxDiv'>

    </div>
    
    
      <hr>

      <div><center>
        <p style="font-size: 16px">Created by <strong>Rohit Lalchandani</strong> | Maintained by <strong>Jacob Reed</strong> | 2014</p>
      

    </div></div><br>

    </div> <!-- /container -->

    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
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