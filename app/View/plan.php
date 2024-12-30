<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to your login page
    exit(); // Stop further execution of the script
}

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

$plans_query = "
    SELECT 
        planss.id AS plan_id,
        planss.plan_name,
        attributes.attribute_name,
        eav_values.value
    FROM 
        planss
    JOIN 
        eav_values ON planss.id = eav_values.plan_id
    JOIN 
        attributes ON eav_values.attribute_id = attributes.id
    ORDER BY 
        planss.id, attributes.id
";

$result = $conn->query($plans_query);

// Process the data into a structured array
$plans = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plan_id = $row['plan_id'];
        $attribute_name = $row['attribute_name'];
        $value = $row['value'];

        // Organize data by plan_id
        if (!isset($plans[$plan_id])) {
            $plans[$plan_id] = [
                'plan_name' => $row['plan_name'],
                'attributes' => []
            ];
        }
        $plans[$plan_id]['attributes'][$attribute_name] = $value;
    }
}


// If user is logged in and plan is selected
if (isset($_SESSION['username'])) {
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
:root {
    --primary: #28a745;
    --secondary: #28a745;
    --success: #059669;
    --background: #f9f6f2;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --border: 
rgb(65, 65, 65);
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --radius-md: 1rem;
    --radius-lg: 1.5rem;
}

/* Core styles */
body {
    font-family: 'poppins', system-ui, -apple-system, sans-serif;
    background: linear-gradient(150deg, var(--background), #f1f5f9);
    color: var(--text-primary);
    min-height: 100vh;
    margin: 0;
    padding: 2rem;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Enhanced heading */
h1 {
    font-size: clamp(2rem, 5vw, 3rem);
    text-align: center;
    margin-bottom: 4rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    padding-bottom: 1rem;
}

h1::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, var(--primary), var(--secondary));
    border-radius: 2px;
}

/* Pricing grid */
.pricing-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
    gap: 2rem;
    max-width: 1400px;
    margin: 0 auto;
    padding: 1rem;
    perspective: 1000px;
}

/* Plan card */
.plan {
    background: 
    #f9f6f2;
    border-radius: var(--radius-lg);
    padding: 2.5rem 2rem;
    position: relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    isolation: isolate;
}

.plan::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, 
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.4) 100%
    );
    border-radius: inherit;
    z-index: -1;
    transition: opacity 0.4s ease;
    opacity: 0;
}

.plan:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary);
}

.plan:hover::before {
    opacity: 1;
}

/* Plan header */
.plan h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    color: var(--text-primary);
}

/* Pricing */
.plan .old-price {
    color: var(--text-secondary);
    text-decoration: line-through;
    font-size: 1rem;
}

.plan .price {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary);
    margin: 0.5rem 0;
    display: flex;
    align-items: baseline;
    gap: 0.25rem;
}

.plan .price span {
    font-size: 1rem;
    color: var(--text-secondary);
    font-weight: normal;
}

/* Features list */
.plan ul {
    margin: 1.5rem 0;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.plan ul li {
    padding: 0.75rem 0;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: transform 0.3s ease;
}

.plan ul li::before {
    content: '✓';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    background: var(--success);
    color: white;
    border-radius: 50%;
    font-size: 0.75rem;
}

/* Action button */
.plan button {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border: none;
    border-radius: var(--radius-md);
    padding: 1rem 2rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    margin-top: auto;
}

.plan button::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        45deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.plan button:hover::before {
    transform: translateX(100%);
}

.plan button:hover {
    box-shadow: 0 8px 16px -4px rgb(37 99 235 / 0.25);
}

/* Popular plan highlight */
.plan.popular {
    background: linear-gradient(
        135deg,
        rgba(37, 99, 235, 0.05),
        rgba(59, 130, 246, 0.05)
    );
    border: 2px solid var(--primary);
    transform: scale(1.05);
}

.plan.popular::after {
    content: 'MOST POPULAR';
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--primary);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.05em;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    body {
        padding: 1rem;
    }

    .plan.popular {
        transform: scale(1);
    }

    .pricing-container {
        gap: 1.5rem;
    }
}

/* Loading state */
.plan.loading {
    pointer-events: none;
}

.plan.loading > * {
    opacity: 0.7;
    animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 0.4; }
}

/* Focus states for accessibility */
button:focus-visible,
a:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation: none !important;
        transition: none !important;
    }
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