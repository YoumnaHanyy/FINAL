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

    <form action="users.php" method="POST">
        <input type="hidden" name="plan" value="<?php echo $plan; ?>">

        <label>Card Number</label>
        <input type="number" name="card_number" placeholder="1234 1234 1234 1234" required>

        <label>Expiry Date</label>
        <input type="text" name="expiry_date" placeholder="MM/YY" required>
        
        <label>CVV</label>
        <input type="number" name="cvv" placeholder="123" required>
        
        <label>Cardholder Name</label>
        <input type="text" name="cardholder_name" placeholder="Full name on card" required>
        
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

        // Card Number Validation (e.g., check if it's 16 digits)
        if (cardNumber.value.length !== 16 || isNaN(cardNumber.value)) {
            setValidationError(cardNumber, "Card number must be 16 digits.");
            isValid = false;
        }

        // Expiry Date Validation (e.g., check for valid MM/YY format)
        if (!/^\d{2}\/\d{2}$/.test(expiryDate.value)) {
            setValidationError(expiryDate, "Expiry date must be in MM/YY format.");
            isValid = false;
        }

        // CVV Validation (e.g., 3 digits)
        if (cvv.value.length !== 3 || isNaN(cvv.value)) {
            setValidationError(cvv, "CVV must be 3 digits.");
            isValid = false;
        }

        // Cardholder Name Validation (ensure it's not empty)
        if (cardholderName.value.trim() === '') {
            setValidationError(cardholderName, "Cardholder name is required.");
            isValid = false;
        }

        // If there are any invalid fields, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
    });

    function setValidationError(field, message) {
        field.classList.add('invalid');
        let errorMessage = document.createElement('div');
        errorMessage.classList.add('error-message', 'active');
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
</script>

</body>
</html>