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

<div class="modal" id="newYearModal">
    <div class="modal-content">
        <button class="close-button">&times;</button>
        <div class="modal-left">
            <span class="exclusive-tag">EXCLUSIVE DEAL</span>
            <h2 class="modal-title">Special New<br>Years Offer</h2>
            <p class="modal-description">Start the New Year with a productivity<br>boost thanks to DoneDeal's best features.</p>
            
            <div class="countdown-container">
                <div class="countdown-box">
                    <div class="countdown-value" id="days">09</div>
                    <div class="countdown-label">Days</div>
                </div>
                <span class="countdown-separator">:</span>
                <div class="countdown-box">
                    <div class="countdown-value" id="hours">09</div>
                    <div class="countdown-label">Hours</div>
                </div>
                <span class="countdown-separator">:</span>
                <div class="countdown-box">
                    <div class="countdown-value" id="minutes">10</div>
                    <div class="countdown-label">Min</div>
                </div>
                <span class="countdown-separator">:</span>
                <div class="countdown-box">
                    <div class="countdown-value" id="seconds">09</div>
                    <div class="countdown-label">Sec</div>
                </div>
            </div>
            
            <button class="save-button">Save 40% now</button>
        </div>
        <div class="modal-right">
            <div class="discount-text">-40<span class="percent">%</span></div>
            <div class="decoration-star star-top"></div>
            <div class="decoration-star star-bottom"></div>
            <div class="decoration-ornament"></div>
        </div>
    </div>
</div>

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: #0A2521;
    border-radius: 24px;
    display: flex;
    max-width: 800px;
    width: 90%;
    position: relative;
    color: white;
    overflow: hidden;
}

.close-button {
    position: absolute;
    right: 20px;
    top: 20px;
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    z-index: 2;
}

.modal-left {
    padding: 48px;
    flex: 1;
}

.exclusive-tag {
    background-color: rgba(0, 0, 0, 0.2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 14px;
    display: inline-block;
    margin-bottom: 16px;
}

.modal-title {
    font-size: 48px;
    margin-bottom: 24px;
    font-family: serif;
}

.modal-description {
    color: #ccc;
    margin-bottom: 32px;
    line-height: 1.5;
}

.countdown-container {
    display: flex;
    gap: 16px;
    align-items: center;
    margin-bottom: 32px;
}

.countdown-box {
    text-align: center;
}

.countdown-value {
    background-color: rgba(0, 0, 0, 0.2);
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 24px;
    min-width: 40px;
}

.countdown-label {
    font-size: 12px;
    margin-top: 4px;
    color: #ccc;
}

.countdown-separator {
    font-size: 24px;
    font-weight: bold;
}

.save-button {
    background-color: #00A82D;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.save-button:hover {
    background-color: #008f26;
}

.modal-right {
    width: 50%;
    position: relative;
    background-color: #0A2521;
    display: flex;
    justify-content: center;
    align-items: center;
}

.discount-text {
    font-size: 180px;
    font-weight: bold;
    color: #CFB87C;
    opacity: 0.9;
    position: relative;
}

.percent {
    font-size: 100px;
}

.decoration-star {
    position: absolute;
    width: 16px;
    height: 16px;
    background-color: #CFB87C;
    transform: rotate(45deg);
}

.star-top {
    top: 32px;
    right: 32px;
}

.star-bottom {
    bottom: 48px;
    left: 48px;
    width: 24px;
    height: 24px;
}

.decoration-ornament {
    position: absolute;
    top: 24px;
    right: 24px;
    width: 40px;
    height: 40px;
    background-image: url('/api/placeholder/40/40');
    background-size: contain;
}

@media (max-width: 768px) {
    .modal-right {
        display: none;
    }
    
    .modal-content {
        width: 95%;
    }
    
    .modal-left {
        padding: 32px;
    }
    
    .modal-title {
        font-size: 36px;
    }
}
</style>

<script>
// Add this to your existing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize countdown
    const endDate = new Date();
    endDate.setDate(endDate.getDate() + 9);
    endDate.setHours(endDate.getHours() + 9);
    endDate.setMinutes(endDate.getMinutes() + 10);
    endDate.setSeconds(endDate.getSeconds() + 9);

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').textContent = days.toString().padStart(2, '0');
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');

        if (distance < 0) {
            clearInterval(countdownInterval);
        }
    }

    const countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();

    // Close button functionality
    const modal = document.getElementById('newYearModal');
    const closeButton = modal.querySelector('.close-button');
    
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});
</script>
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