<?php
session_start();
if (isset($_SESSION['reset_token'])) {
    echo "<h1>Your Reset Token</h1>";
    echo "<p>" . htmlspecialchars($_SESSION['reset_token']) . "</p>";
    echo "<a href='reset_password.php'>Go to Reset Password</a>";
} else {
    echo "No reset token available.";
}
?>
