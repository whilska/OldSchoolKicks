// adminFunctions.js
var pricePattern = /^\d+(\.\d{2})?$/;
// update price function
function updatePrice(id){
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response) {
			if (response.email != null && response.email != "" && response.admin) {
				var newPrice = prompt("Enter new price");
				if (pricePattern.test(newPrice)) {
					$.post('adminFunctions.php', {f: "uShoe", id: id, price: newPrice}, 
			   			function(returnedData){
			   				alert(returnedData);
			   				adminPage();
						}
					);
				}
				else {
					alert("New price invald");
					adminPage();
				}
			}
			else {
				alert("Cannot complete this request");
				displaySpecials();
			}
		}
	});
}
// delete item function
function deleteProduct(id) {
	$.ajax({
		type: 'GET',
		url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
		xhrFields: {
			withCredentials: true
		},
		success: function(response) {
			if (response.email != null && response.email != "" && response.admin) {
				$.post('adminFunctions.php', {f: "dShoe", id: id}, 
			   		function(returnedData){
			   			alert(returnedData);
			   			adminPage();
					}
				);
			}
			else {
				alert("Cannot complete this request");
				displaySpecials();
			}
		}
	});
}
// add item function
function addProduct(theForm){
	var shoe_name = theForm.form.shoe_name.value;
	var shoe_desc = theForm.form.shoe_desc.value;
	var price = theForm.form.price.value;
	var quantity = theForm.form.quantity.value;
	var pic_link = theForm.form.pic_link.value;
	var category_id = theForm.form.category_id.value;
	// console.log(category_id);
	if (quantity > 0 && pricePattern.test(price)) {
		$.ajax({
			type: 'GET',
			url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
			xhrFields: {
				withCredentials: true
			},
			success: function(response) {
				if(response.email != null && response.email != "" && response.admin) {
					$.post('adminFunctions.php', {f: "aShoe", name: shoe_name, desc: shoe_desc, price: price, quantity: quantity, link: pic_link, category: category_id}, 
			   			function(returnedData){
			   				alert(returnedData);
			   				adminPage();
			   			}
			   		);
				}
				else {
					alert("Cannot complete this request");
					displaySpecials();
				}
			}
		});
	}
	else {
		alert("Invalid input");
	}
}
// add special function
function addSpecial(thisForm) {
	var shoe_id = thisForm.form.shoe_id.value;
	var special_price = thisForm.form.special_price.value;
	var start_date = thisForm.form.start_date.value;
	var end_date = thisForm.form.end_date.value;
	var current_date;
	if (!pricePattern.test(special_price)) {
		alert("Invalid price");
	}
	else if (shoe_id == null || shoe_id == "") {
		alert("Please enter productID");
	}
	else if (end_date == null || end_date == "") {
		alert("Please enter end date");
	}
	else if (Date.parse(start_date) >= Date.parse(end_date)) {
		alert("End date must be greater than Start date");
	}
	else if (Date.parse(start_date) < Date.parse(current_date)) {
		alert("Start date cannot be in the past");
	}
	else {
		$.ajax({
			type: 'GET',
			url: 'http://ubuntu-hilska.local:8080/OldSchoolKicksAuth/SessionServlet',
			xhrFields: {
				withCredentials: true
			},
			success: function(response) {
				if(response.email != null && response.email != "" && response.admin) {
					$.post('adminFunctions.php', {f: "aSpecial", shoe_id: shoe_id, special_price: special_price, start_date: start_date, end_date: end_date}, 
			   			function(returnedData){
			   				alert(returnedData);
			   				adminPage();
			   			}
			   		);
				}
				else {
					alert("Cannot complete this request");
					displaySpecials();
				}
			}
		});
	}
}