//project2.js
$(document).ready(function() {
	echoGetCategories();
	displaySpecials();
	checkLogIn();
});
function echoGetCategories() {
	$.get('echoGetCategories.php', function(returnedData){
		var categories = JSON.parse(returnedData);
		var listItems = '<option selected="selected" value="">-</option>';
		for(var i = 0; i < categories.length; i++) {
			listItems += "<option value='" + categories[i].id + "'>" + categories[i].category_name + "</option>";
		}
		$(".search").html(listItems);
		// console.log("categories set");
	});
}
function adminPage() {
	$.post('admin.php',
		function(returnedData){
			document.getElementById("contentDiv").innerHTML = returnedData;
			eval(document.getElementById("adminJs").innerHTML);
		}
	);
}
function checkLogIn() {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response){
			if (response.admin) {
				document.getElementById("admin").style.visibility = "visible";
			}
			else {
				document.getElementById("admin").style.visibility = "hidden";	
			}
			if (response.email != null){
				// User has an active session and is logged in
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
	});
}
function logOut() {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		data: {
			action: "destroy"
		},
		xhrFields: {
			withCredentials: true
		},
		success: function(response) {
			if(response.loggedOut) {
				alert("Logged out");
			}
				checkLogIn();
				displaySpecials();
		}
	});
}
function logInForm() {
	$.get('loginForm.php', 
		function(returnedData){
			document.getElementById("contentDiv").innerHTML = returnedData;
	});
}
function validateLogin(theForm) {
	var email = theForm.form.email.value;
	var pass = theForm.form.pass.value;
	if (validateEmail(email)) {
		$.ajax({
			type: "POST",
			url: "http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/LoginServlet",
			data: {email: email, password: pass}, 
			xhrFields: {
				withCredentials: true
			},
				success: function(returnedData){
					// console.log(returnedData);
					if (returnedData.valid == true) {
						alert("Log in successful");
						displaySpecials();
						checkLogIn();
					}
					else {
						alert("Email or password were incorrect");
					}
			}
		});
	}
}
function searchByCategory(brand) {
	if (brand != "") {
		loadContent('GET','home.php?c='+brand);
	}
	else {
		loadContent('GET','home.php');
	}
}
function displaySpecials() {
	$.post('specials.php', 
			function(returnedData){
				if (returnedData.indexOf("noSpecials") > -1) {
					loadContent('GET','home.php');
				}
				else {
					document.getElementById("contentDiv").innerHTML = returnedData;
				}
		}
	);
}
function createAccountForm() {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("contentDiv").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","createAccountForm.php",true);
	xmlhttp.send();
}
function createAccount(theForm){
	var firstName = theForm.form.firstName.value;
	var lastName = theForm.form.lastName.value;
	var email = theForm.form.email.value;
	var pass1 = theForm.form.pass1.value;
	var pass2 = theForm.form.pass2.value;
	if (pass1 == pass2) {
		if (pass1.length < 8) {
			alert("Password is too short. Must be at least 8 characters long");
		}
		else {
			if (validateName(firstName) && validateName(lastName) && validateEmail(email)) {
				$.ajax({
					type: 'POST',
					url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/CreateAccountServlet',
					xhrFields: {
						withCredentials: true
					},
					data: {
						firstname: firstName,
						lastname: lastName,
						email: email,
						password: pass1
					},
					success: function(response) {
						if (response.success) {
							alert("Thanks for signing up! Please log in.");
							displaySpecials();
							checkLogIn();
						}
						else {
							alert("There was an error processing your request. Please contact the administrator.");
						}
					},
					error: function(response) {
						alert("There was an error processing your request. Please contact the administrator.");
						console.log(response);
					}
				});
			}
		}
	}
	else {
		alert("Passwords do not match");
	}
}
function removeItemFromCart(cartNum) {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response) {
			if(response.email != null && response.email != "") {

				$.post('deleteFromCart.php', { cart_id: cartNum}, 
	   				function(returnedData){
	   					alert(returnedData);
	   					viewCart();
					}
				);

			}
			else {
				alert("Please log in to continue");
			}

		}
	});
}
function removeMultipleFromCart() {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response) {
			if(response.email != null && response.email != "") {
				var checkedCartItems = [];
				$('.cartItems:checked').each(function(i){
					checkedCartItems[i] = $(this).val();

				});
				if (checkedCartItems.length > 0) {
					$.post('deleteFromCart.php', { cart_ids: JSON.stringify(checkedCartItems)}, 
		   				function(returnedData){
		   					if (returnedData == 1) {
		   						alert("Item(s) successfully removed from cart");
		   					}
		   					else {
		   						alert("Something went wrong. Please contact administrator.");
		   					}
		   					viewCart();
						}
					);
				}
				else {
					alert("Please select at least one item to remove");
				}

			}
			else {
				alert("Please log in to continue");
			}

		}
	});
}

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

function viewCart() {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response){
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
	});
}
function selectAllCartItems() {
	$('.cartItems').each(function(){
		this.checked = true;

	});
}
function addToCart(productID, specials) {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response){
			if (response.email != null && response.email != "") {
				$.post('addToCart.php', { email: response.email, shoe_id: productID }, 
						function(returnedData){
							alert(returnedData);
				});
				if (specials == 0) {
					loadContent('GET','home.php');
				}
				else {
					displaySpecials();
				}
			}
			else {
				alert("Must be logged in to buy");
			} 

		}
	});
}
function loadContent(method,url) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("contentDiv").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open(method,url,true);
	xmlhttp.send();
}