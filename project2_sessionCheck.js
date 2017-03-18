// Checks for active session, if session active then calls param ssuccessFunction
function callFunctionWithSessionCheck(successFunction) {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response) { 
			successFunction(response)
		}
	});
}

function viewCartAux(response) {
	if (response.email != null && response.email != "") {
		$.post('viewCart.php', { email: response.email}, 
				function(returnedData){
					document.getElementById("contentDiv").innerHTML = returnedData;
		});
	}
	else {
		alert("Must log in to view cart");
	}
}

function checkLogIn(response) {
	if (response.admin) {
		document.getElementById("admin").style.visibility = "visible";
	}
	else {
		document.getElementById("admin").style.visibility = "hidden";	
	}
	if (response.email != null){
		document.getElementById("welcome").innerHTML = "Welcome, " + response.firstname;
	 	document.getElementById("create").style.visibility = "hidden";
	 	document.getElementById("logIn").style.visibility = "hidden";
	 	document.getElementById("logOut").style.visibility = "visible";
	 	document.getElementById("welcome").style.visibility = "visible";
	 	document.getElementById("viewCart").style.visibility = "visible";
	}
	else {
		document.getElementById("create").style.visibility = "visible";
	 	document.getElementById("logIn").style.visibility = "visible";
	 	document.getElementById("logOut").style.visibility = "hidden";
	 	document.getElementById("welcome").style.visibility = "hidden";
	 	document.getElementById("viewCart").style.visibility = "hidden";
	}
}

