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
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php"); 
    exit(); // Ensure no further code is executed
}

$plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : 'No Plan Selected';
?>
<div class="payment-container">
    <div class="visa-logo">Visa</div>
    <div class="chip"></div>
    
    <h1 style="text-align: center;">You’re almost there!</h1>
    <h2 style="text-align: center;">Payment</h2>
    <p style="text-align: center;">Plan: <?php echo $plan; ?></p>

    <form action="user.php" method="POST" id="payment-form">
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

        <button type="submit" id="submit-button">Continue</button>
    </form>
</div>

<script>
    document.getElementById('payment-form').addEventListener('submit', function(event) {
        let isValid = true;

        // Select form fields
        const cardNumber = document.getElementById('card_number');
        const expiryDate = document.getElementById('expiry_date');
        const cvv = document.getElementById('cvv');
        const cardholderName = document.getElementById('cardholder_name');

        // Clear any previous validation messages
        clearValidationErrors([cardNumber, expiryDate, cvv, cardholderName]);

        // Validate card number (16 digits)
        if (!/^\d{16}$/.test(cardNumber.value.replace(/\s/g, ''))) {
            setValidationError(cardNumber, "Card number must be 16 digits.");
            isValid = false;
        }

        // Validate expiry date (MM/YY and future date)
        const expiryParts = expiryDate.value.split('/');
        if (!/^\d{2}\/\d{2}$/.test(expiryDate.value)) {
            setValidationError(expiryDate, "Expiry date must be in MM/YY format.");
            isValid = false;
        } else if (!isValidExpiryDate(expiryParts[0], expiryParts[1])) {
            setValidationError(expiryDate, "This card has expired. Please use a valid card.");
            isValid = false;
        }

        // Validate CVV (3 digits)
        if (!/^\d{3}$/.test(cvv.value)) {
            setValidationError(cvv, "CVV must be exactly 3 digits.");
            isValid = false;
        }

        // Validate cardholder name (alphabetic characters only)
        if (!/^[a-zA-Z\s]+$/.test(cardholderName.value.trim())) {
            setValidationError(cardholderName, "Cardholder name should contain only letters and spaces.");
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Helper function: Validate expiry date
    function isValidExpiryDate(month, year) {
        const currentDate = new Date();
        const inputMonth = parseInt(month, 10);
        const inputYear = parseInt(`20${year}`, 10); // Convert YY to YYYY

        if (isNaN(inputMonth) || isNaN(inputYear)) return false;
        if (inputMonth < 1 || inputMonth > 12) return false;

        const expiryDate = new Date(inputYear, inputMonth - 1); // Month is 0-indexed
        return expiryDate >= new Date(currentDate.getFullYear(), currentDate.getMonth());
    }

    // Helper function: Clear validation errors
    function clearValidationErrors(fields) {
        fields.forEach(field => {
            field.classList.remove('invalid');
            const errorMessage = field.nextElementSibling;
            if (errorMessage && errorMessage.classList.contains('error-message')) {
                errorMessage.remove();
            }
        });
    }

    // Helper function: Set validation error
    function setValidationError(field, message) {
        field.classList.add('invalid');
        const errorMessage = document.createElement('div');
        errorMessage.classList.add('error-message');
        errorMessage.innerText = message;
        field.parentNode.insertBefore(errorMessage, field.nextSibling);
    }

    // Real-time formatting for card number
    document.getElementById('card_number').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '').slice(0, 16);
        this.value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    });

    // Real-time formatting for expiry date
    document.getElementById('expiry_date').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '').slice(0, 4);
        if (value.length > 2) {
            value = `${value.slice(0, 2)}/${value.slice(2)}`;
        }
        this.value = value;
    });

    // CVV formatting
    document.getElementById('cvv').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 3);
    });

    // Prevent numbers in cardholder name
    document.getElementById('cardholder_name').addEventListener('input', function() {
        this.value = this.value.replace(/[0-9]/g, '');
    });
</script>
</body>
</html>
