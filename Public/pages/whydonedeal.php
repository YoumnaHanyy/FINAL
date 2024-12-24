<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Why DoneDeal?</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../STYLE/whyDD.css"> <!-- Assuming you're using the same stylesheet -->
</head>
<body>
<div class="container">
<img src="../Images/shape2.png" alt="shape2" class="shape2">
<header class="header">
        <div class="logo">
            <img src="../Images/logoo.jpg" alt="DoneDeal Logo">
            <a href="Home.php" >
                <span class="ll">DoneDeal</span>
    </a>
        </div>
        <nav>
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
            <a href="#">Plans</a>
        </nav>
        <div class="left-buttons">
            <button class="login-btn">Log in</button>
            <button class="signup-btn">Sign up</button>
        </div>
    </header>

    <div class="container">
        <h1>Why choose DoneDeal?</h1>
        <p>With DoneDeal, you have everything you need to keep life organized.<br>
        Use it for note-taking, project planning, and to find what you need,<br>
        when you need it.</p>
        <a href="#" class="btn">Get DoneDeal free</a>
        <p class="login">Already have an account? <a href="#">Log in now</a></p>
        <img src="../Images/shape1.png" alt="shape1" class="shape1">
      
    </div>
    <div class="testimonial-container">
    <div class="testimonial-image">
        <img src="../Images/person.png" alt="Person's name" class="profile-pic">
    </div>
    <div class="testimonial-text">
        <p>
            "Every day and in every way, DoneDeal is there for <br>my work and my life. It's my most used app, both at my desk <br>and in my pocket."
        </p>
        <div class="author-container">
        <p class="author">John Doe, Your Product Certified Expert</p>

    </div>
    </div>
    <div class="deadline-container">
    <div class="deadline-content">
        <h2>Hit every <br>Deadline</h2>
        <p>Link notes containing important action<br> items to your calendar events, and<br> DoneDeal will surface the info you need<br> — right when you need it.</p>
    
    </div>
    <div class="deadline-image">
        <img src="../Images/hit.png" alt="hit">
    </div>
</div>
<div class="findfast-container">
    <div class="findfast-content">
        <h2>Find it Fast</h2>
        <p>Keep all your project materials in one <br>place—including checklists, emails, and PDFs. Smart search puts it all at your fingertips.<br> — right when you need it.</p>
    
    </div>
    <div class="findfast-image">
        <img src="../Images/find.png" alt="find">
    </div>
</div>

</div>
<footer class="footer">
    <div class="footer-left">
        <img src="../Images/logoo.jpg" alt="DoneDeal Logo" class="footer-logo">
        <span>DoneDeal</span>
    </div>
    <div class="footer-right">
        <div class="language-selection">
            <span>Choose a language:</span>
            <select>
                <option value="english">English</option>
                <option value="spanish">Español</option>
                <option value="french">Français</option>
                <!-- Add more language options as needed -->
            </select>
        </div>
        <div class="social-icons">
            <a href="#"><img src="../Images/face.jpg" alt="Facebook"></a>
            <a href="#"><img src="../Images/twitter2.png" alt="Twitter"></a>
            <a href="#"><img src="../Images/instgram.png" alt="Instagram"></a>
        </div>
    </div>
</footer>


<script>
    const header = document.querySelector('.header');

// Add an event listener to the window for the scroll event
window.addEventListener('scroll', function() {
    if (window.scrollY > 0) {
        // If the user has scrolled down, add the 'header-blur' class
        header.classList.add('header-blur');
    } else {
        // If the user scrolls back to the top, remove the 'header-blur' class
        header.classList.remove('header-blur');
    }
});
</script>
</body>
</html>