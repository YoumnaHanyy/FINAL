<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DoneDeal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../Public/css/Home.css">
    
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

    <main class="main-content">
        <h1>What will you <br> <span class="highlight">achieve</span> today?</h1>
        <p>Remember everything and tackle any project with your notes, tasks,<br> and schedule all in one place.</p>
        <a href="plan.php">
        <button class="cta-btn">Get DoneDeal free</button>
</a>
        <p><a href="login.php" class="login-link">Already have an account? Log in</a></p>

        <div class="carousel-container">
    <div class="carousel-wrapper">
        <div class="options">
    <div class="option">
        Wiki
        <img src="../../Public/Images/wikii.png" alt="Wiki Image" />
    </div>
    <div class="option">
        Planner
        <img src="../../Public/Images/planner.png" alt="Planner Image" />
    </div>

    <div class="option">
        Class notes
        <img src="../../Public/Images/class note.png" alt="Class Notes Image" />
    </div>
    <div class="option">
        Research
        <img src="../../Public/Images/research.png" alt="Research Image" />
    </div>
    <div class="option">
        Task List
        <img src="../../Public/Images/tasklist.png" alt="Task List Image" />
    </div>
    <div class="option">
        Thought
        <img src="../../Public/Images/thoughts.png" alt="Thought Image" />
    </div>
    <div class="option">
        Meeting notes
        <img src="../../Public/Images/meetingnotes.png" alt="Meeting Notes Image" />
    </div>
    <div class="option">
        Journal
        <img src="../../Public/Images/journal.png" alt="Journal Image" />
    </div>
</div>
</div>
<button class="arrow left-arrow">&#9664;</button>
    <button class="arrow right-arrow">&#9654;</button>
</div>

        <section class="features-section">
        <div class="feature">
            <img src="../../Public/Images/work.png" alt="Work Anywhere Icon" class="feature-icon">
            <h3>Work anywhere</h3>
            <p>Keep important info handy—your notes sync automatically to all your devices.</p>
        </div>
        <div class="feature">
            <img src="../../Public/Images/pin.png" alt="Remember Everything Icon" class="feature-icon">
            <h3>Remember everything</h3>
            <p>Make notes more useful by adding text, images, audio, scans, PDFs, and documents.</p>
        </div>
        <div class="feature">
            <img src="../../Public/Images/right.png" alt="Turn to-do into done Icon" class="feature-icon">
            <h3>Turn to-do into done</h3>
            <p>Bring your notes, tasks, and schedules together to get things done more easily.</p>
        </div>
        <div class="feature">
            <img src="../../Public/Images/search.png" alt="Find things fast Icon" class="feature-icon">
            <h3>Find things fast</h3>
            <p>Get what you need, when you need it with powerful and flexible search capabilities.</p>
        </div>
        
    </section>
    <section class="collaboration-section">
    <div class="collaboration-content">
        <h2>Effortless collaboration</h2>
        <p>Evernote makes it easy to collaborate on projects. Real-Time Editing immediately syncs changes to keep all contributors up to date. The Tasks feature helps you outline the next steps and assign responsibilities. And with unlimited sharing permissions, everyone is in the loop and on the same page.</p>
        <a href="#" class="learn-more-link">Learn more</a>
    </div>
    <div class="collaboration-images">
    <div class="collaboration-option">
        <img src="../../Public/Images/collab.png" alt="collab" class="profile-pic">
    </div>
</div>

</section>
<section class="whats-new">
    <div class="Exciting improvements">
        <h2>Thirty more <br> exciting <br> improvements <br> in DoneDeal</h2>
        <p>Product lead Federico Simionato shares how<br> the team introduced drastic improvements to<br> DoneDeal's Editor, Calendar, Tasks, Mobile experience,<br> and more between April and <br>June 2024.</p>
        <a href="#" class="read-more-link">Read more</a>
    </div>
    <div class="new-content">
        <img src="../../Public/Images/30more.png" alt="Exciting improvements" />
    </div>
</section>
<footer class="footer">
    <div class="footer-left">
        <img src="../../Public/Images/logoo.jpg" alt="DoneDeal Logo" class="footer-logo">
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
            <a href="#"><img src="../Images/face.png" alt="Facebook"></a>
            <a href="#"><img src="../Images/twitter2.png" alt="Twitter"></a>
            <a href="#"><img src="../Images/instgram.png" alt="Instagram"></a>
        </div>
    </div>
</footer>
    </main>
</div>


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

const carouselWrapper = document.querySelector('.carousel-wrapper');
const options = document.querySelectorAll('.option');
const arrowLeft = document.querySelector('.left-arrow');
const arrowRight = document.querySelector('.right-arrow');

let currentPosition = 0;
const optionWidth = options[0].clientWidth + 20; // Get the width of an option including margins
const visibleOptions = 4; // Number of visible options at once

// Function to move the carousel to the left
arrowLeft.addEventListener('click', () => {
    if (currentPosition < 0) {
        currentPosition += optionWidth;
        carouselWrapper.style.transform = `translateX(${currentPosition}px)`;
    }
});

// Function to move the carousel to the right
arrowRight.addEventListener('click', () => {
    const maxPosition = -(optionWidth * (options.length - visibleOptions));
    if (currentPosition > maxPosition) {
        currentPosition -= optionWidth;
        carouselWrapper.style.transform = `translateX(${currentPosition}px)`;
    }
});

</script>
</body>
</html>