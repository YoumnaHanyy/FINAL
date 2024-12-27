<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/add-user.css">
    </head>
<body>
    <div class="back">
        <a href="http://localhost/PROJECTFF/app/view/dashboard.php"><img src="..//assets/images/back-button.png" alt="" srcset=""> </a>

    </div>

    <div class="container">
        <header>Enter User Details</header>

        <form id="user-form" action="add-user.php" method="POST">
            <label for="username" id="username-label">Name:</label>
            <input id="username" name="username" type="text" required>
            <p class="error-message" id="name-error">Name must contain only letters and be 3-15 characters long.</p>

            <label for="email">Email:</label>
            <input name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" required><br>

            <p id="email-error" style="color: red; display: none;">Please enter a valid Gmail address (e.g., name@gmail.com).</p>

            <label for="password">Password:</label>
            <input id="password" name="password" type="password" 
                title="Password must include uppercase, lowercase, a number, a symbol, and be at least 8 characters long" 
                required><br>

                <div class="password-strength">
                    <div class="strength-bar" id="strength-bar"></div>
                    <span class="strength-level" id="strength-level">Password strength</span>
                </div>

            <button type="submit">Add User</button>
            <p id="error-message">A user with the same email already exists.</p>
            <p id="success-message">User added successfully!</p>
        </form>
    </div>

   
   

    <script src="..//assets/js/main.js">
  
    </script>
</body>
</html>
