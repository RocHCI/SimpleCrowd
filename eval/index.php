<?php session_start(); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>Label sentence simplicity</title>

	<!-- Libraries -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<!--script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script-->
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="scripts/labeledslider.js" type="text/javascript"></script>
	<script src="scripts/gup.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="css/turk.css"></link>
	<link rel="stylesheet" type="text/css" href="css/labeledslider.css"></link>

	<link rel="stylesheet" href="//roc.cs.rochester.edu/LegionJS/LegionTools/LegionJS_Libraries/legion.css" />
	<script src="scripts/vars.js"></script>
	<script src="//roc.cs.rochester.edu/LegionJS/LegionTools/LegionJS_Libraries/legion.js"></script>


	<!-- Scripts -->
	<script src="scripts/page.js" type="text/javascript"></script>


	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="css/style.css"></link>

</head>

<body>


<div id="main-interface">


    <div id="outer-container">
	<div id="header">
		<p>Thanks for taking our task!</p>
		<p>Below, you'll find 10 sentences of different levels of simplicity. Please rate each one from 1 (complex) to 7 (simple) to indicate how simple the sentence wording and structure is.</p>
	</div>


	<!-- Main -->
	<div id="container">
		<div id="instr-area">
		</div>

		<br/>

		<div id="questions-container">
			<ol id="questions">
			</ol>
		</div>
	</div>


	<div id="submit-div">
		<form id="submit-form">
  			<input type="hidden" name="money" id="money_field">
			<input type="hidden" name="assignmentId" id="submit-assignmentId">
		</form>
	</div>
    </div>

</div>



<div id="sidebar"></div>
<div id="instructions"></div>
<p id='legion-money' style="display:none;">.15</p>

</body>
</html>
