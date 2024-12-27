<?php
class PlanController {
    public function showPlans() {
        // Load the plans view
        include_once "View/plan.php";
    }

    public function redirectToPayment() {
        // Get the selected plan
        if (isset($_POST['plan'])) {
            $plan = htmlspecialchars($_POST['plan']);
            header("Location: index.php?controller=Payment&action=showPayment&plan=" . urlencode($plan));
            exit();
        }
    }
}
?>
