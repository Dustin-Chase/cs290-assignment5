/*
This is the file assignment3p2.js
It accompanies assignment2p2.html
Author: Dustin Chase
E-mail: chased@onid.oregonstate.edu
Assignment: 3 part 2 Javascript and AJAX
Due Date: 2/1/15

This program searches the git website for git gists. It displays these
gists on a page and allows the user to save some of them for later viewing. 
*/


//create the http request used to query the gist webpage
function createHttpRequestObject() {
	var xmlHttp;

	/*Code Source: Mozilla.org - Getting Started with Ajax*/	
	if(window.ActiveXObject) {
		try {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e) {
			xmlHttp = false;
		}			
	} 
	else {
		try {
			xmlHttp = new XMLHttpRequest(); 
		} catch(e) {
			xmlHttp = false; 
		}
	}
	
	if(!xmlHttp)
		alert("Could not create XML Request");
	else {
		return xmlHttp; 
	}
}

var httpRequest; //holds gist requests
var JSONObj; //holds httpRequest text parsed to JSON objects

//Create the AJAX request and send to server once ready
function search() {
	event.preventDefault();
	var title = document.getElementById("title");
	var URL = "http://www.omdbapi.com/?s=" + title.value;
	httpRequest = createHttpRequestObject(); 
	httpRequest.open("GET", URL, true);
	httpRequest.send();
	httpRequest.onreadystatechange = display; 
}

function display() {
	if(httpRequest.readyState === 4) {
		if (httpRequest.status === 200) {
			JSONObj = JSON.parse(httpRequest.responseText);
		} else {
			alert('There was a problem with the request.'); 
		}
	}
	
	console.log(JSON.stringify(JSONObj));
}


