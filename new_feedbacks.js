function changeColor(id) {
	var customer = document.getElementById('customers-tab');
	var visitor = document.getElementById('visitors-tab');
	var choosed = document.getElementById(id);

	customer.style.backgroundColor="transparent";
	customer.style.color="#007bff";

	visitor.style.backgroundColor="transparent";
	visitor.style.color="#007bff";

	choosed.style.backgroundColor="#007bff";
	choosed.style.color="white";
}