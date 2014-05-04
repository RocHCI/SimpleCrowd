// VARS
var img = new Image();
var imgW;
var imgH;

var imageName = null;
var imagePath = null;
var question = null;
var ansType = null;

var imgResponse = null;
var qResponse = null;

var qidSet = new Array();

var flagVal = false;

var session = gup("session") ? gup("session") : null;
var worker = gup("workerId") ? gup("workerId") : "default";

var answerMap = {};


// Dynamically set the question being asked
function addResponseHooks() {

	// Reveal the submit button
	$('#legion-submit').show();
	$('#legion-submit').removeAttr("disabled");
	$('#legion-submit').off('click');


	// Handle submission
	$('#legion-submit').click( function() {
		var flagData = null;

		// WSL-TODO: add check of answers / alert if missing some.
		$('#questions li').each( function() {
			// TODO: If there is a null option, then confirm none are still left to be selected (AKA, that all questions have been answered).
			
		});

		//// WSL-TODO: put div loop here!
		respList = new Array();
		$('#questions li').each( function() {
			// Log the response
			console.log("Writing answer for session " + session);
			//console.log("ANS: " +  resp + ", time: " + response_time + ", flag: " + flagVal + ", flagDATA: " + flagData);
			curQID = $(this).attr('data-question');
			curVal = answerMap[curQID];
			respList.push(curVal + ";" + curQID);
		});
		console.log(respList)

		// Log all of the responses
		$.ajax({
			url: "php/logRating.php",
			type: "POST",
			data: { session: session, worker: worker, ratings: respList },
			dataType: "text",
			success: function(d) {
				alert("Answer submitted. Thanks!");

				// Submit the HIT
				submitToTurk(undefined, {"useAlert": false});
			}
		});
	});

};

$(document).ready( function() {
	$('#legion-submit').hide();

	// Let everyone know the image is coming
	console.log("Loading image...");
	$('#question-wrapper').html('<div style="color:#f83; font-size: 24px"><center><b><i>Loading image...</i></b></center></div>');

    if( gup("assignmentId") != "ASSIGNMENT_ID_NOT_AVAILABLE" ) {
	// If we're in the real task, prepare the question presentation div
	$('#questions-wrapper').html('<ol id="questions"></ol>');

	// Get the image + question information
	$.ajax({
                url: "php/getQuestions.php",
                type: "POST",
                data: { session: session, worker: worker },
                dataType: "json",
                success: function(jsonResponses) {  // array of json entries -- [questionid, question]
			console.log(jsonResponses)

			for( var i = 0; i < jsonResponses.length; i++ ) {
				jsonResp = jsonResponses[i];
				question = jsonResp['question'];
				qID = jsonResp['id'];
				qidSet.push(qID);
				var answerStartingValue = 0;

				// Load question
				console.log("Setting question to: ", question);
				$('#questions').append('<li id="entry-' + qID + '" data-question="' + qID + '"><div id="q-' + qID + '" class="questiontext">' + question
					+ '</div> <div class="instrtext">Indicate your agreement with the following: <i>Sentence #' + (i+1) + ' (shown above) is simple to read.</i></div>'
					+ ' <div id="a-' + qID + '" class="answerbar">' + '</div></li> <br/>');
				$('#a-'+qID).html(
					'<div class="slider"></div>'
				);

				answerMap[qID] = answerStartingValue;				
			}
			$('.slider').labeledslider({ 
				max: 6,
				tickInterval: 1,
				value: 3,
				tickLabels: {
					0: 'Strongly Disagree',
					1: 'Disagree',
					2: 'Somewhat Disagree',
					3: 'Neither Agree/Disagree',
					4: 'Somewhat Agree',
					5: 'Agree',
					6: 'Strongly Agree'
				},
				change: function(event, ui) {
					var sliderQuestion = $(event.srcElement).closest('li').attr('data-question');
					answerMap[sliderQuestion] = ui.value;
				} 
			});

			// Add the submit button for mturk
			addResponseHooks();
		}
	});

    }
    else {
 	$('#questions-wrapper').html("<div style='text-align: center;'>Please accept the HIT to continue.</div>");
    }


});

