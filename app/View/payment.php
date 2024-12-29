<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/css/payement.css">
    <title>Payment</title>
</head>
<body>

<?php
    $plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : 'No Plan Selected';
?>

<div class="payment-container">
    <div class="visa-logo">Visa</div>
    <div class="chip"></div>
    
    <h1 style="text-align: center;">You’re almost there!</h1>
    <h2 style="text-align: center;">Payment</h2>
    <p style="text-align: center;">Plan: <?php echo $plan; ?></p>

    <form action="user.php" method="POST">
        <input type="hidden" name="plan" value="<?php echo $plan; ?>">

        <label>Card Number</label>
        <input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" required>

        <label>Expiry Date</label>
        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" required>
        
        <label>CVV</label>
        <input type="text" name="cvv" id="cvv" placeholder="123" required>
        
        <label>Cardholder Name</label>
        <input type="text" name="cardholder_name" id="cardholder_name" placeholder="Full name on card" required>
        
        <label>Country or Region</label>
        <select name="country" required>
            <option value="Egypt">Egypt</option>
            <option value="United States">United States</option>
        </select>

        <button type="submit">Continue</button>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
    let isValid = true;
    const cardNumber = document.querySelector('input[name="card_number"]');
    const expiryDate = document.querySelector('input[name="expiry_date"]');
    const cvv = document.querySelector('input[name="cvv"]');
    const cardholderName = document.querySelector('input[name="cardholder_name"]');
    const country = document.querySelector('select[name="country"]');

    // Clear previous error styles and messages
    clearValidationErrors([cardNumber, expiryDate, cvv, cardholderName, country]);

    // Card Number Validation (16 digits and starts with '4')
    if (!/^\d{16}$/.test(cardNumber.value.replace(/\s/g, ''))) {
        setValidationError(cardNumber, "Card number must be 16 digits.");
        isValid = false;
    }

    // Expiry Date Validation (must be MM/YY format and valid future date)
    const expiryDateParts = expiryDate.value.split('/');
    if (!/^\d{2}\/\d{2}$/.test(expiryDate.value) || !isValidExpiryDate(expiryDateParts[0], expiryDateParts[1])) {
        setValidationError(expiryDate, "Expiry date must be in MM/YY format and must be a future date.");
        isValid = false;
    }

    // CVV Validation (must be 3 digits)
    if (!/^\d{3}$/.test(cvv.value)) {
        setValidationError(cvv, "CVV must be 3 digits.");
        isValid = false;
    }

    // Cardholder Name Validation (only alphabetic characters and spaces allowed)
    if (!/^[a-zA-Z\s]+$/.test(cardholderName.value.trim())) {
        setValidationError(cardholderName, "Cardholder name is required and should only contain letters and spaces.");
        isValid = false;
    }

    // If there are any invalid fields, prevent form submission
    if (!isValid) {
        event.preventDefault();
    }
});

// Prevent numerical input for the cardholder name
document.getElementById('cardholder_name').addEventListener('input', function(event) {
    this.value = this.value.replace(/[0-9]/g, ''); // Replace any numbers with empty string
});

function setValidationError(field, message) {
    field.classList.add('invalid');
    let errorMessage = document.createElement('div');
    errorMessage.classList.add('error-message');
    errorMessage.innerText = message;
    field.parentNode.insertBefore(errorMessage, field.nextSibling);
}

function clearValidationErrors(fields) {
    fields.forEach(field => {
        field.classList.remove('invalid');
        if (field.nextSibling && field.nextSibling.classList.contains('error-message')) {
            field.nextSibling.remove();
        }
    });
}

// Format the card number input with spaces every 4 digits and limit to 16 digits
const cardNumberInput = document.getElementById('card_number');
cardNumberInput.addEventListener('input', function(event) {
    let value = cardNumberInput.value.replace(/\D/g, ''); // Remove non-digit characters
    if (value.length > 16) {
        value = value.slice(0, 16); // Limit to 16 digits
    }
    if (value.length > 4) {
        value = value.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
    }
    cardNumberInput.value = value; // Update the input field
});

// Expiry Date format (MM/YY), limit to exactly 5 characters (2 digits + '/' + 2 digits)
const expiryDateInput = document.getElementById('expiry_date');
expiryDateInput.addEventListener('input', function(event) {
    let value = expiryDateInput.value.replace(/\D/g, ''); // Remove non-digit characters
    if (value.length > 4) {
        value = value.slice(0, 4); // Limit to 4 digits
    }
    if (value.length > 2) {
        value = value.slice(0, 2) + '/' + value.slice(2); // Add slash after first 2 digits
    }
    expiryDateInput.value = value; // Update the input field
});

// CVV format (exactly 3 digits)
const cvvInput = document.getElementById('cvv');
cvvInput.addEventListener('input', function(event) {
    let value = cvvInput.value.replace(/\D/g, ''); // Remove non-digit characters
    if (value.length > 3) {
        value = value.slice(0, 3); // Limit to 3 digits
    }
    cvvInput.value = value; // Update the input field
});

</script>

</body>
</html>