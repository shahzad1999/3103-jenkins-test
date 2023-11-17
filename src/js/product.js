function addToCart(mooncakeId) {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open('POST', 'cart.php', true);

    // Set the request header to send data in JSON format
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Define the data to send in JSON format
    var data = JSON.stringify({
        'action': 'add_to_cart',
        'mooncake_id': mooncakeId
    });

    // Set up the callback function when the request is complete
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response if needed
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Product added to cart successfully');
            } else {
                alert('Failed to add the product to the cart');
            }
        }
    };

    // Send the request
    xhr.send(data);
}