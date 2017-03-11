function validateName(name) {
	var namePattern = /^[A-Za-z\s]+$/;
	if(!namePattern.test(name)) {
		alert("Invalid first or last name");
		return false;
	}
	return true;
}

function validateEmail(email) {
	 var pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	 if (!pattern.test(email)) {
	 	alert("Invalid email");
	 	return false;
	 }
	 return true;
}