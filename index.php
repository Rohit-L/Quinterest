<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Quinterest: A Searchable Quiz Bowl Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            padding-top: 80px; /* 60px to make the container go all the way to the bottom of the topbar */
        }

        .title {
            font-family: Georgia, serif;
            font-size: 70px;
            font-weight: bold;
            padding: 40px 0 20px 0;
            color: white;
        }

        .main {
            border-radius: 0;
            background-color: #ff7518;
            color: white;
            padding-bottom: 20px;
        }

        .main label {
            padding-top: 15px;
        }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="/favicon">
</head>

<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="brand" href="/" style="font-family: Georgia, serif"><strong>Quinterest</strong></a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="/study.php">Study</a></li>
                    <li><a href="http://hsquizbowl.org/forums/viewtopic.php?f=123&t=14574">Discussion</a></li>
                    <li><a href="#aboutModal" data-toggle="modal">About</a></li>
                    <li><a href="#contactModal" data-toggle="modal">Contact</a></li>
                    <li><a href="#contributorsModal" data-toggle="modal">Contributors</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>


<!-- Modal -->
<div id="aboutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="aboutLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="aboutLabel">About Quinterest</h3><h5>Version 2.0</h5>
    </div>
    <div class="modal-body">
        <p>Quinterest is a quiz bowl search engine, to help players play and write better. The name derives from the
            combination of “quiz bowl” and “interest.” The website has no affiliation with Pinterest.</p>
        <hr>
        <p>Quinterest is simply a very elegant, streamlined database search engine. Certain aspects were taken into
            consideration when the search engine was created that would inprove upon user experience.</p>
        <strong>For example:</strong>
        <ul>
            <li>The search engine is designed to be clean and easy-on-the-eyes, allowing users to focus more overall and
                have a better experience, all thanks to Twitter Bootstrap.
            <li>When viewing results, there is no pagination (unlimited results per page). This allows users to identify
                clues from individual questions more easily. In addition, when searching, the page does not refresh
                which saves your selected search parameters and reduces bandwidth usage.
            </li>
            <li>There is the ability to further specify search queries with the option to search by difficulty,
                category, and type. This allow users to focus on questions related to their level of quiz bowl and
                subject-choice.
            </li>
        </ul>

    </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<!-- Modal -->
<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="contactLabel">Contact</h3>
    </div>
    <div class="modal-body">
        <p>
            If you have any questions, comments, concerns, suggestions, please send an email to Jacob Reed at <a href="mailto:jacob.alexander.reed@gmail.com">jacob.alexander.reed@gmail.com</a>
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<!-- Modal -->
<div id="contributorsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contributorsLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="contributorsLabel">Contributors</h3>
    </div>
    <div class="modal-body">
        <strong>Contributors:</strong>
        <ul>
            <li>Joshua Duncan</li>
            <li>Julian Fuchs</li>
            <li>Kenji Golimlim</li>
            <li>Matt Jackson</li>
            <li>Nicholas Karas</li>
            <li>Rohit Lalchandani</li>
            <li>Dan Pechi</li>
            <li>Jacob Reed</li>
            <li>Nicholas Wawrykow</li>
            <li>Haohang Xu</li>
        </ul>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<!-- Modal -->
<div id="errorReportmodel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="reportLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="reportLabel">Report an Error</h3>
    </div>
    <div class="modal-body">
        <form action="" method="post" class="form-horizontal" id="errorForm">
            <div class="control-group">
                <label class="control-label" for="errorType">Type:</label>

                <div class="controls">
                    <select name="Type" id="errorType">
                        <option value="Tossup">Tossup</option>
                        <option value="Bonus">Bonus</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="errorID">Question ID(s):</label>

                <div class="controls">
                    <input type="text" name="ID" id="errorID"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="errorDescription">Error Description: </label>

                <div class="controls">
                    <input type="text" name="ErrorDescription" id="errorDescription"/>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input type="button" value="Send Error Report" id="submitError" class="btn btn-default"/>
                </div>
            </div>

            <div id="success"></div>
        </form>
    </div>


    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Return to Search</button>
    </div>
</div>


<div class="container">
    <div class='main'>
        <div class="h1 text-center title">Quinterest</div>

        <hr>

        <div class="container form-horizontal" align="center" style="width: 100%">
            <div class="row-fluid" style="">
                <div class="span3 offset1">
                    <label for="optionCategory">Category</label>

                    <select id="optionCategory">
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

                    <label for="optionSubcategory">Subcategory</label>

                    <select id="optionSubcategory">
                        <option value="None">None</option>
                    </select>

                </div>

                <div class="span4">
                    <label for="optionSType">Search Type</label>

                    <select id="optionSType">
                        <option value="Answer">Answer</option>
                        <option value="AnswerQuestion">Question & Answer</option>
                    </select>

                    <label for="optionQType">Question Type</label>
                    <select id="optionQType">
                        <option value="TossupBonus">Tossups and Bonuses</option>
                        <option value="Tossups">Tossups Only</option>
                        <option value="Bonuses">Bonuses Only</option>
                    </select>

                </div>

                <div class="span3">
                    <label for="optionDifficulty">Difficulty</label>
                    <select id="optionDifficulty">
                        <option value="All">All</option>
                        <option value="MS">Middle School</option>
                        <option value="HS">High School</option>
                        <option value="College">College</option>
                        <option value="Open">Open</option>
                    </select>

                    <label for="optionTournament">Tournament</label>
                    <select id='optionTournament'>
                        <option value='All'>All</option>
                    </select>
                </div>
            </div>

            <div>
                <input type='text' autofocus placeholder="What would you like to learn about?" class="input-xxlarge search-query" id="searchInput" style="margin-top: 25px">
                <br/>
                <input type='button' id="searchButton" class="btn btn-large btn-primary" value='Search' style="margin: 25px 25px">
            </div>
        </div>

        <div class="row">
            <div style="text-align: center" class="span2 offset1">
                <a href='#' class="btn btn-small btn-inverse" id="popovernotice" data-animation="true"
                   data-placement="top" data-trigger="hover" data-content='If you see a question with an error in the database, please select the "Report an Error" button and fill in the required fields so it can be corrected.
We would like to keep the database as clean as possible. Two IDs are necessary to correct duplicate questions.'>NOTICE!</a>
            </div>

            <div style="text-align: center" class="span2 offset5">
                <a class="btn btn-mini" id="interfacenotice" data-animation="true" data-placement="top"
                   data-trigger="hover"
                   data-content='The interface friendly version of Quinterest is great for when you want to copy and paste or print search results. In addition, the interface friendly version is recommended for users who are using Quinterest on a portable device such as a tablet or smartphone.'
                   href='interface.php'>Interface Friendly Version</a>
            </div>
        </div>
    </div>
<br>
<center>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Quinterest 2 -->
    <ins class="adsbygoogle"
         style="display:inline-block;width:970px;height:90px"
         data-ad-client="ca-pub-5258405341760716"
         data-ad-slot="5531169545"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script></center><br>


    <div class="container">
        <div class='hero-unit' id='ajaxDiv'>

        </div>

        <hr>

        <div>
            <p class="text-center" style="font-size: 16px">
                Created by <strong>Rohit Lalchandani</strong> | Maintained by <strong>Jacob Reed</strong> | 2014
            </p>
        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    function getParams() {
        return {
            "info": $("#searchInput").val(),
            "categ": $("#optionCategory").val(),
            "sub": $("#optionSubcategory").val(),
            "stype": $("#optionSType").val(),
            "qtype": $("#optionQType").val(),
            "difficulty": $("#optionDifficulty").val(),
            "tournamentyear": $("#optionTournament").val()
        };
    }
    
    function loadList() {
        var params = getParams();
        $.get("list.php", {qtype: params.qtype, difficulty: params.difficulty}, function (data) {
           $("#optionTournament").replaceWith(data);
        });
    }

    $(function () {
        if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile/i.test(navigator.userAgent)) {
            if (window.location.hash != "#desktop") {
                window.location = "http://quinterest.org/interface.php";
            }
        }
       
        $('#popovernotice').popover();
        $('#interfacenotice').popover();

        // load subcategories
        $("#optionCategory").change(function () {
            $.get("subs.php", {category: $("#optionCategory").val()}, function (data) {
                $("#optionSubcategory").replaceWith(data);
            });
        });

        // load tournament list
        $("#optionQType,#optionDifficulty").change(loadList);

        // do search
        $("#searchButton").click(function (event) {
            $.get("php/combined.php", getParams(), function (data) {
                $("#ajaxDiv").html(data);
            });
        });

        $("#searchInput").keydown(function (event) {
            if (event.keyCode == 13) {
                $("#searchButton").click();
            }
        });

        // submit error reports
        $("#submitError").click(function () {
            $.post("php/error.php", $("#errorForm").serialize(), function (response) {
                $('#success').html(response);
                $("#errorForm")[0].reset();
            });
        });
        
        loadList();
    });
</script>

</body>
</html>
