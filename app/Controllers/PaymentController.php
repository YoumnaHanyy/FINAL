<?php
class PaymentController {
    public function showPayment() {
        // Get the plan from the URL
        $plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : 'No Plan Selected';
        include_once "View/payment.php";
    }

    public function processPayment() {
        // Handle payment processing
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $plan = $_POST['plan'];
            $cardNumber = $_POST['card_number'];
            $expiryDate = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];
            $cardholderName = $_POST['cardholder_name'];
            $country = $_POST['country'];

            // Add your payment processing logic here

            echo "Payment successful for plan: $plan";
        }
    }
}
?>
