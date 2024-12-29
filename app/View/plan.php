<?php
session_start();

// Database connection details
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "donedeal";

// Create connection to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch available plans from the database
$plans_query = "SELECT id, plan_name FROM plans";
$result = $conn->query($plans_query);

// If user is logged in and plan is selected
if (isset($_SESSION['username'])) {
    // Handle form submission for selecting a plan
    if (isset($_POST['select_plan'])) {
        $plan_id = $_POST['plan_id']; // Get the selected plan ID

        // Get the user's ID
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        // Update the user with the selected plan
        $update_stmt = $conn->prepare("UPDATE users SET plan_id = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $plan_id, $user_id);

        if ($update_stmt->execute()) {
            echo "Plan selected successfully!";
            header("Location: payment.php");

        } else {
            echo "Error updating plan: " . $update_stmt->error;
        }
        $update_stmt->close();
    }
} else {
    echo "You must be logged in to choose a plan.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans</title>
    <style>
       /* Modern reset and base styles */
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f9f9f7 0%, #f5f5f3 100%);
    color: #2c3e50;
    min-height: 100vh;
    margin: 0;
    padding: 50px 20px;
    box-sizing: border-box;
}

/* Animated heading */
h1 {
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 3rem;
    background: linear-gradient(45deg, #2c3e50, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientText 3s ease infinite;
    position: relative;
}

h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #3498db, transparent);
}

@keyframes gradientText {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Pricing container with 3D perspective */
.pricing-container {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
    perspective: 1000px;
    padding: 20px;
}

/* Advanced plan card styling */
.plan {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 40px 30px;
    flex: 1;
    max-width: 350px;
    position: relative;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
}

/* Hover effects */
.plan:hover {
    transform: translateY(-15px) rotateX(5deg);
    box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.2);
    border-color: rgba(52, 152, 219, 0.3);
}

/* Glowing effect on hover */
.plan::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(52, 152, 219, 0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.5s ease;
}

.plan:hover::before {
    opacity: 1;
}

/* Plan header styling */
.plan h3 {
    font-size: 2rem;
    margin: 0 0 20px;
    position: relative;
    padding-bottom: 15px;
}

.plan h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: #3498db;
    transition: width 0.3s ease;
}

.plan:hover h3::after {
    width: 80px;
}

/* Price styling */
.plan .old-price {
    color: #95a5a6;
    font-size: 1.1rem;
    position: relative;
    display: inline-block;
}

.plan .price {
    font-size: 2.2rem;
    color: #2ecc71;
    font-weight: 700;
    margin: 15px 0;
    transition: transform 0.3s ease;
}

.plan:hover .price {
    transform: scale(1.1);
}

/* Feature list styling */
.plan ul {
    margin: 30px 0;
    padding: 0;
    list-style: none;
}

.plan ul li {
    padding: 12px 0;
    border-bottom: 1px solid rgba(189, 195, 199, 0.2);
    transition: transform 0.3s ease;
    position: relative;
}

.plan ul li::before {
    content: '✓';
    color: #2ecc71;
    margin-right: 10px;
    opacity: 0;
    transform: translateX(-20px);
    transition: all 0.3s ease;
}

.plan:hover ul li::before {
    opacity: 1;
    transform: translateX(0);
}

.plan ul li:hover {
    transform: translateX(5px);
    color: #3498db;
}

/* Button styling */
.plan button {
    background: linear-gradient(45deg, #2ecc71, #27ae60);
    color: white;
    border: none;
    border-radius: 30px;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.plan button::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.2));
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.plan button:hover::before {
    transform: translateX(100%);
}

.plan button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(46, 204, 113, 0.3);
}

/* Popular plan highlight */
.plan:nth-child(2) {
    transform: scale(1.05);
    border: 2px solid rgba(52, 152, 219, 0.3);
    z-index: 1;
}

.plan:nth-child(2)::after {
    content: 'MOST POPULAR';
    position: absolute;
    top: 15px;
    right: -35px;
    background: #3498db;
    color: white;
    padding: 5px 40px;
    font-size: 0.8rem;
    transform: rotate(45deg);
}

/* Responsive design */
@media (max-width: 1200px) {
    .pricing-container {
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .plan {
        min-width: calc(50% - 20px);
    }

    .plan:nth-child(2) {
        transform: none;
    }
}

@media (max-width: 768px) {
    .pricing-container {
        flex-direction: column;
        align-items: center;
    }
    
    .plan {
        width: 100%;
        max-width: 400px;
        margin-bottom: 20px;
    }
    
    h1 {
        font-size: 2rem;
    }
}

/* Loading animation */
@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

.plan.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}
    </style>
</head>
<body>
<h1>Which Plan is Right for You?</h1>
    <div class="pricing-container">
        <!-- Personal Plan -->
        <div class="plan">
            <h3>Personal</h3>
            <p class="old-price">$14.99</p>
            <p class="price">$10.83/month</p>
            <p>Pay $129.99/year</p>
            <ul>
                <li>Create up to 150,000 notes</li>
                <li>Create up to 2,000 notebooks</li>
                <li>Unlimited connected devices</li>
                <li>10 GB monthly uploads</li>
            </ul>
            <form action="plan.php" method="POST">
                <input type="hidden" name="plan_id" value="1">
                <button type="submit" name="select_plan">Select Plan</button>
            </form>
        </div>

        <!-- Professional Plan -->
        <div class="plan">
            <h3>Professional</h3>
            <p class="old-price">$17.99</p>
            <p class="price">$14.16/month</p>
            <p>Pay $169.99/year</p>
            <ul>
                <li>Everything in Personal, plus:</li>
                <li>Adobe Acrobat Standard</li>
                <li>20 GB monthly uploads</li>
                <li>AI-Powered Search</li>
            </ul>
            <form action="plan.php" method="POST">
                <input type="hidden" name="plan_id" value="2">
                <button type="submit" name="select_plan">Select Plan</button>
            </form>
        </div>

        <!-- Team Plan -->
        <div class="plan">
            <h3>Teams</h3>
            <p class="old-price">$24.99/user</p>
            <p class="price">$20.83/user/month</p>
            <p>Pay $249.99/year</p>
            <ul>
                <li>Everything in Professional, plus:</li>
                <li>Shared team spaces</li>
                <li>Centralized user management</li>
                <li>20 GB monthly uploads + 2 GB per user</li>
            </ul>
            <form action="plan.php" method="POST">
                <input type="hidden" name="plan_id" value="3">
                <button type="submit" name="select_plan">Select Plan</button>
            </form>
        </div>

        <!-- Free Plan -->
        <div class="plan">
            <h3>Free</h3>
            <p class="price">$0</p>
            <ul>
                <li>Create up to 50 notes</li>
                <li>Create 1 notebook</li>
                <li>Connect to 1 device</li>
                <li>250 MB monthly uploads</li>
            </ul>
            <form action="user.php" method="get">
            <input type="hidden" name="plan_id" value="4">
                <button type="submit">Start For Free</button>
            </form>
        </div>
    </div>
    </div>


</body>
</html>