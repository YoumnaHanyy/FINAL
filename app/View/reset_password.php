<?php
session_start();
include '../DB/db.php'; // Include your database connection file

if (isset($_POST['reset_password'])) {
    $reset_token = sanitizeInput($_POST['reset_token']);
    $new_password = sanitizeInput($_POST['new_password']);

    // Validate the reset token
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expires_at > NOW()");
    $stmt->bind_param("s", $reset_token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Token is valid; update the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires_at = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashed_password, $reset_token);

        if ($stmt->execute()) {
            echo "Password has been reset successfully!";
        } else {
            echo "Failed to reset password.";
        }
    } else {
        echo "Invalid or expired reset token.";
    }
    $stmt->close();
}
?>
<form method="POST">
    <h1>Reset Password</h1>
    <label>Enter Reset Token:</label>
    <input type="text" name="reset_token" required />
    <label>Enter New Password:</label>
    <input type="password" name="new_password" required />
    <button type="submit" name="reset_password">Reset Password</button>
</form>
