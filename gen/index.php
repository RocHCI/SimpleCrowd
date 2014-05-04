<?php session_start(); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>Help simplify sentences</title>

	<!-- Libraries -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<!--script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script-->
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="scripts/gup.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="css/turk.css"></link>

	<link rel="stylesheet" href="//roc.cs.rochester.edu/LegionJS/LegionTools/LegionJS_Libraries/legion.css" />
	<script src="scripts/vars.js"></script>
	<script src="//roc.cs.rochester.edu/LegionJS/LegionTools/LegionJS_Libraries/legion.js"></script>


	<!-- Scripts -->
	<script src="scripts/sc-harness.js" type="text/javascript"></script>

	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="css/style.css"></link>

</head>

<body>


<div id="main-interface">


    <div id="outer-container">
	<div id="header">
		<p>Thanks for taking our task!</p>
		<p>Below, you'll find a complex sentence. Please help us create a simpler version that as many people as possible can understand.</p>
	</div>


	<!-- Main -->
	<div id="container">
		Loading...
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
