
<?php

class LoginClass {
    private $conn;
    private $adminUsername = "admin";
    private $adminPassword = "admin123"; // Change this to a more secure password

    public $message = '';
    public $messageClass = '';

    
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
    public function signUp($username, $email, $password) {
        if (empty($username) || empty($email) || empty($password)) {
            $this->setMessage("All fields are required!", "error");
            return;
        }

        if ($this->isUsernameTaken($username)) {
            $this->setMessage("Username is already taken!", "error");
            return;
        }

        if ($this->isEmailTaken($email)) {
            $this->setMessage("Email is already registered!", "error");
            return;
        }

        if (!$this->isPasswordValid($password)) {
            $this->setMessage("Password must be at least 8 characters long, contain at least one uppercase letter, and one special character.", "error");
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            $this->setMessage("Signup successful! Welcome, " . htmlspecialchars($username) . ".", "success");
            header('Location: user_dashboard.php'); // Redirect to another page
            exit;
        } else {
            $this->setMessage("Error: " . $stmt->error, "error");
        }

        $stmt->close();
    }

    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            $this->setMessage("All fields are required!", "error");
            return;
        }

        if ($username === $this->adminUsername && $password === $this->adminPassword) {
            $this->setMessage("Admin Login successful! Welcome, " . htmlspecialchars($username) . ".", "success");
            // Redirect to admin dashboard or another page here
            return;
        }

        $stmt = $this->conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $this->setMessage("Login successful! Welcome back, " . htmlspecialchars($username) . ".", "success");
                // Redirect to user dashboard or another page here
            } else {
                $this->setMessage("Invalid password!", "error");
            }
        } else {
            $this->setMessage("Username not found!", "error");
        }

        $stmt->close();
    }

    private function isUsernameTaken($username) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $isTaken = $stmt->num_rows > 0;
        $stmt->close();
        return $isTaken;
    }

    private function isEmailTaken($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $isTaken = $stmt->num_rows > 0;
        $stmt->close();
        return $isTaken;
    }

    private function isPasswordValid($password) {
        return preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $password);
    }

    private function setMessage($message, $messageClass) {
        $this->message = $message;
        $this->messageClass = $messageClass;
    }

    public function getMessage() {
        return ["message" => $this->message, "messageClass" => $this->messageClass];
    }
}
?>