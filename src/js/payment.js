// Function to validate credit card using the Luhn algorithm
function isValidCreditCard(cardNumber) {
    // Remove any non-digit characters
    cardNumber = cardNumber.replace(/\D/g, '');

    if (cardNumber.length < 13 || cardNumber.length > 19) {
        // Credit card numbers typically have 13 to 19 digits
        return false;
    }

    // Reverse the card number and convert it to an array of digits
    var digits = cardNumber.split('').reverse().map(Number);

    // Use the Luhn algorithm to validate
    var sum = 0;
    for (var i = 0; i < digits.length; i++) {
        var digit = digits[i];
        if (i % 2 === 1) {
            // Double every other digit
            digit *= 2;
            if (digit > 9) {
                digit -= 9;
            }
        }
        sum += digit;
    }

    return sum % 10 === 0;
}

// Function to validate CSV (CVV)
function isValidCVV(cvv) {
    return /^\d{3,4}$/.test(cvv);
}

// Function to validate expiration date in MM/YYYY format
function isValidExpirationDate(expiration) {
    return /^(0[1-9]|1[0-2])\/\d{4}$/.test(expiration);
}

// Event handler for card number input
$('#card-number').on('input', function () {
    var cardNumber = $(this).val();
    var isValid = isValidCreditCard(cardNumber);

    if (isValid) {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).next('.invalid-feedback').hide();
    } else {
        $(this).removeClass('is-valid').addClass('is-invalid');
        $(this).next('.invalid-feedback').show();
    }
});

// Event handler for CVV input
$('#card-cvv').on('input', function () {
    var cvv = $(this).val();
    var isValid = isValidCVV(cvv);

    if (isValid) {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).next('.invalid-feedback').hide();
    } else {
        $(this).removeClass('is-valid').addClass('is-invalid');
        $(this).next('.invalid-feedback').show();
    }
});

// Event handler for expiration date input
$('#card-expiration').on('input', function () {
    var expiration = $(this).val();
    var isValid = isValidExpirationDate(expiration);

    if (isValid) {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).next('.invalid-feedback').hide();
    } else {
        $(this).removeClass('is-valid').addClass('is-invalid');
        $(this).next('.invalid-feedback').show();
    }
});




