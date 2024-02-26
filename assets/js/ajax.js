$(document).ready(function () {
	$(".add-to-cart-btn").click(function (e) {
		e.preventDefault();

    var cartItems = localStorage.getItem("cartItems");
    var parsedCartItems = JSON.parse(cartItems);
    console.log("parsedCartItems" + parsedCartItems.length);
    var cartCount = parsedCartItems.length;

		$("#cart-count").text(cartCount || 0);

		// Get the product details
		var productId = $(this).data("product-id");
    console.log(JSON.stringify(productId));
    // var url = '/cart.php'

		// Perform Ajax request
		// $.ajax({
		// 	url: "addToCart.php",
		// 	method: "POST",
		// 	data: product,

		// 	success: function (response) {
				// Update cart icon count

      // Store product in local storage
      var cartItems = localStorage.getItem("cartItems");
      if (cartItems) {
        cartItems = JSON.parse(cartItems);
      } else {
        cartItems = [];
      }

      var item = {
				id: productId,
        quantity: 1
			};

      cartItems.push(item);
      localStorage.setItem("cartItems", JSON.stringify(cartItems));

				// Show success message or perform any other action
				alert("Product added to cart successfully!");
	// 		},
	// 		error: function (xhr, status, error) {
	// 			// Handle error
	// 			console.log(error);
	// 		},
	// 	});
	});
});
