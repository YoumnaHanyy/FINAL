<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans</title>
    <link rel="stylesheet" href="../../Public/css/plan.css">
</head>
<body>
<div class="container">
    <header class="header">
            <div class="logo">
                <img src="../../Public/Images/logoo.jpg" alt="DoneDeal Logo">
                <a href="Home.php" >
                <span class="ll">DoneDeal</span>
    </a>
            </div>
            <nav>
            <a href="whydonedeal.php">Why DoneDeal</a>
                <!-- Adding the dropdown for Explore -->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle">Explore &#9662;</a> <!-- Explore with arrow down -->
                    <div class="dropdown-menu">
                        <div class="dropdown-column">
                            <span>SOLUTIONS</span>
                            <a href="#">Note Taking</a>
                            <a href="#">Self organizing</a>
                            <a href="#">Productivity</a>
                            <a href="#">Teams</a>
                        </div>
                        <div class="dropdown-column">
                            <span>FEATURES</span>
                            <a href="#">AI features</a>
                            <a href="#">Collaboration</a>
                            <a href="#">Web Clipper</a>
                            <a href="#">Advanced search</a>
                            <a href="#">Document scanning</a>
                            <a href="#">Personalization</a>
                            <a href="#">Tasks</a>
                            <a href="#">Calendar</a>
                        </div>
                    </div>
                </div>
                <a href="plan.php">Plans</a>
            </nav>
            <div class="left-buttons">
                <a href="login.php">
                <button class="login-btn" >Log in</button>
    </a>
                <button class="signup-btn">Sign up</button>
            </div>
        </header>
    



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
            <form action="payment.php" method="get">
                <input type="hidden" name="plan" value="Personal">
                <button type="submit">Choose Personal</button>
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
            <form action="payment.php" method="get">
                <input type="hidden" name="plan" value="Professional">
                <button type="submit">Choose Professional</button>
            </form>
        </div>

        <!-- Teams Plan -->
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
            <form action="payment.php" method="get">
                <input type="hidden" name="plan" value="Teams">
                <button type="submit">Choose Teams</button>
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
            <form action="users.php" method="get">
                <input type="hidden" name="plan" value="Free">
                <button type="submit">Start For Free</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>