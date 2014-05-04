// VARS
var session = gup("session") ? gup("session") : null;
var worker = gup("workerId") ? gup("workerId") : "default";
var ver = gup("ver") ? gup("ver") : null;


// Add answer and submission hooks
function addResponseHooks() {

	// Reveal the submit button
	$('#legion-submit').show();
	$('#legion-submit').removeAttr("disabled");
	$('#legion-submit').off('click');


	// Handle submission
	$('#legion-submit').click( function() {
		var ans = eval(ver);

		// Log all of the responses
		$.ajax({
			url: "php/logAnswer.php",
			type: "POST",
			data: { session: session, worker: worker, answer: ans },
			dataType: "text",
			success: function(d) {
				alert("Answer submitted. Thanks!");

				// Submit the HIT
				submitToTurk(undefined, {"useAlert": false});
			}
		});
	});

};


function loadContent() {
	console.log("Loading content...");

	//
	$('head').append('<link rel="stylesheet" type="text/css" href="pages/' + ver + '.css"></link>');
	$('head').append('<script src="pages/' + ver + '.js" type="text/javascript"></script>');
//console.log('<script src="pages/' + ver + '.js" type="text/javascript"></script>')

	$('#container').load('pages/' + ver + '.html');
}


$(document).ready( function() {
	console.log("Here.");

	// Hide the submit button until something is entered
	$('#legion-submit').hide();

	// Load the correct input div
	loadContent();
});


