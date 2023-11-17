document.addEventListener("DOMContentLoaded", function () {
    // Get references to the radio buttons and the containers
    const selfPickupRadio = document.getElementById('selfPickup');
    const deliveryRadio = document.getElementById('delivery');
    const selfPickupDetails = document.querySelector('.self-pickup-options');
    const deliveryDetails = document.querySelector('.delivery-options-details');

    // Function to toggle the visibility of pickup or delivery details
    function toggleDetails() {
        if (selfPickupRadio.checked) {
            selfPickupDetails.style.display = 'block';
            deliveryDetails.style.display = 'none';
        } else if (deliveryRadio.checked) {
            deliveryDetails.style.display = 'block';
            selfPickupDetails.style.display = 'none';
        }
    }

    // Add event listeners for the radio buttons
    selfPickupRadio.addEventListener('change', toggleDetails);
    deliveryRadio.addEventListener('change', toggleDetails);

    // Initial toggle when the page loads
    toggleDetails();
});



// Check if localStorage is available
if (typeof localStorage !== 'undefined') {
// Retrieve stored values and set them to the respective input fields
document.getElementById('delivery').checked = localStorage.getItem('deliveryOption') === 'delivery';
document.getElementById('selfPickup').checked = localStorage.getItem('deliveryOption') === 'selfPickup';
document.getElementById('pickupDate').value = localStorage.getItem('pickupDate');
document.getElementById('pickupTime').value = localStorage.getItem('pickupTime');
document.getElementById('deliveryAddress').value = localStorage.getItem('deliveryAddress');
document.getElementById('deliveryAddress2').value = localStorage.getItem('deliveryAddress2');
document.getElementById('deliveryCity').value = localStorage.getItem('deliveryCity');
document.getElementById('deliveryState').value = localStorage.getItem('deliveryState');
document.getElementById('deliveryPostalCode').value = localStorage.getItem('deliveryPostalCode');
document.getElementById('deliveryCountry').value = localStorage.getItem('deliveryCountry');
document.getElementById('deliveryDate').value = localStorage.getItem('deliveryDate');
document.getElementById('deliveryTime').value = localStorage.getItem('deliveryTime');
}

// Event listeners to store the values when they change
document.getElementById('delivery').addEventListener('change', function () {
localStorage.setItem('deliveryOption', this.checked ? 'delivery' : 'selfPickup');
});
document.getElementById('selfPickup').addEventListener('change', function () {
localStorage.setItem('deliveryOption', this.checked ? 'selfPickup' : 'delivery');
});
document.getElementById('pickupDate').addEventListener('input', function () {
localStorage.setItem('pickupDate', this.value);
});
document.getElementById('pickupTime').addEventListener('input', function () {
localStorage.setItem('pickupTime', this.value);
});
document.getElementById('deliveryAddress').addEventListener('input', function () {
localStorage.setItem('deliveryAddress', this.value);
});
document.getElementById('deliveryAddress2').addEventListener('input', function () {
localStorage.setItem('deliveryAddress2', this.value);
});
document.getElementById('deliveryCity').addEventListener('input', function () {
localStorage.setItem('deliveryCity', this.value);
});
document.getElementById('deliveryState').addEventListener('input', function () {
localStorage.setItem('deliveryState', this.value);
});
document.getElementById('deliveryPostalCode').addEventListener('input', function () {
localStorage.setItem('deliveryPostalCode', this.value);
});
document.getElementById('deliveryCountry').addEventListener('input', function () {
localStorage.setItem('deliveryCountry', this.value);
});
document.getElementById('deliveryDate').addEventListener('input', function () {
localStorage.setItem('deliveryDate', this.value);
});
document.getElementById('deliveryTime').addEventListener('input', function () {
localStorage.setItem('deliveryTime', this.value);
});

