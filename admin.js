// admin.js
var pricePattern = /^\d+(\.\d{2})?$/;
// update price function
function updatePrice(id){
	var newPrice = prompt("Enter new price");
	if (pricePattern.test(newPrice)) {
		$.post('adminFunctions.php', {f: "uShoe", id: id, price: newPrice}, 
   			function(returnedData){
   				alert(returnedData);
   				// adminPage();
			}
		);
	}
	else {
		alert("New price invald");
	}
}
// delete item function
function deleteProduct(id) {
	$.post('adminFunctions.php', {f: "dShoe", id: id}, 
   		function(returnedData){
   			alert(returnedData);
   			// adminPage();
		}
	);
}
// add item function
function addProduct(theForm){
	// alert("add product request received");
	// var pricePattern = /^\d+(\.\d{2})?$/;
	var shoe_name = theForm.form.shoe_name.value;
	var shoe_desc = theForm.form.shoe_desc.value;
	var price = theForm.form.price.value;
	var quantity = theForm.form.quantity.value;
	var pic_link = theForm.form.pic_link.value;
	var category_id = theForm.form.category_id.value;
	if (quantity > 0 && pricePattern.test(price)) {
		// call the .php file
		$.post('adminFunctions.php', {f: "aShoe", name: shoe_name, desc: shoe_desc, price: price, quantity: quantity, link: pic_link, category: category_id}, 
   			function(returnedData){
   				alert(returnedData);
   				// adminPage();
   			}
   		);
	}
	else {
		alert("Invalid input");
	}
}
// add special function
function addSpecial(thisForm) {
	// alert("Add special call receieved");
	var shoe_id = thisForm.form.shoe_id.value;
	var special_price = thisForm.form.special_price.value;
	var end_date = thisForm.form.end_date.value;
	if (pricePattern.test(special_price)) {
		$.post('adminFunctions.php', {f: "aSpecial", shoe_id: shoe_id, special_price: special_price, end_date: end_date}, 
   			function(returnedData){
   				alert(returnedData);
   				// adminPage();
   			}
   		);
	}
	else {
		alert("Invalid price");
	}

}