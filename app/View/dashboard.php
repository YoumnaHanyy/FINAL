<?php
require_once __DIR__ . '/../Controllers/UserController.php';
require_once('../Model/UserModel.php');
require_once __DIR__ . '/../Model/UserModel.php';

// dashboard.php
require_once '../Controllers/UserController.php';
// Database connection parameters
require_once __DIR__ . '/../DB/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="http://localhost/PROJECTFF/Public/css/dashboard.css">
    <link rel="stylesheet" href="http://localhost/PROJECTFF/Public/css/edit-user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <style>


    </style>
</head>
<body>
   
<div class="container">
        <div class="navigation" id="navigation">
            <ul>
                <li>
                    <a href="#">
                        <img class="logo" src="..//assets/images/icons8-to-do-list-250.png" alt="" width="5px">
                    </a>
                </li>

            <li>
                <a href="javascript:void(0)" onclick="toggleUsersSection2()">
                <span class="icon"><i class="fa-solid fa-house"></i></span>
                <span class="title">DashBoard</span>
                 </a>
            </li>
            <li>
    <a href="javascript:void(0)" onclick="toggleUsersSection3()">
        <span class="icon"><i class='bx bxs-report'></i></span>
        <span class="title">reporting</span>
    </a>
</li>
               
                
                <li>
    <a href="javascript:void(0)" onclick="toggleUsersSection()">
        <span class="icon"><i class="fa-solid fa-users"></i></span>
        <span class="title">Users</span>
    </a>
</li>
<li>
                    <a href="javascript:void(0)" onclick="toggleUsersSection4()">
                        <span class="icon"><i class="fa-solid fa-question"></i> </span>
                        <span class="title">Settings</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-gear"></i></span>
                        <span class="title">help</span>
                    </a>
                </li>

                <li>
                    <a href="login.php">
                        <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class="title">Sign out</span>
                    </a>
                </li>
            </ul>
        </div>
          <!--//////main//////-->
          <div class="main">
            <div class="top">
                <div class="toggle" id="toggleBtn"><i class="fa-solid fa-bars"></i></div>
                <div class="search" id="SN" >
                    <label>
                        <input type="text" placeholder="search here">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </label>
                </div>
            </div>
            <!-- Main content goes here -->
        </div>



    </div>
            <div>
                    <!--//////cards//////-->
                    <div class="contain">
                        <div class="cardK">
                        <div class="card">
                        <div class="iconn" class="icon"><i class="fa-solid fa-comment"></i> </div> 
                        <div id="info">
                        <h4>Total Users</h4>
                        <p><?php echo htmlspecialchars($totalUsers ?? 0); ?></p>
                            
                            
                        </div>
                        </div>
                        <div class="card">
                            <div class="iconn" class="icon1"><i class="fa-solid fa-money-bill"></i> </div> 
                            <div id="info">
                            <h4>Total tasks$</h4>
                            <p><?php echo htmlspecialchars($totalTasks ?? 0); ?></p>
                            </div>
                        </div>
                
                
                        <div class="card">
                            <div class="iconn" class="icon1"><i class="fa-regular fa-eye"></i></div> 
                            <div id="info">
                            <h4>High priority tasks</h4>
                            <p><?php echo htmlspecialchars($highPriorityTasks ?? 0); ?></p>

                            </div>
                        </div>
                
                
                        
                    </div>
                </div>
            </div>
<!-- 
            <div class="containerAAAA" id="SNNS" >
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
        <
        </button>
        <ul class="image-list">
            <li class="image-item">
                <div class="image-text">Manage your profile details like name, email, and password.</div>
              <img src="http://localhost/PROJECTFF/public/images/research.png" alt="Profile Settings">
             
            </li>
            <li class="image-item">
                <div class="image-text">Set reminders and notifications for your tasks.</div>
              <img src="http://localhost/PROJECTFF/public/images/thoughts.png" alt="Notification Settings">
            
            </li>
            <li class="image-item">
                <div class="image-text">Customize the appearance of your to-do list interface.</div>
              <img src="http://localhost/PROJECTFF/public/images/planner.png" alt="Theme Customization">
            
            </li>
            <li class="image-item">
                <div class="image-text">Control who can view and edit your to-do lists.</div>
              <img src="http://localhost/PROJECTFF/public/images/meetingnotes.png" alt="Privacy Settings">
              
            </li>
            <li class="image-item">
                <div class="image-text">Organize tasks into categories for better management.</div>
              <img src="http://localhost/PROJECTFF/public/images/find.png" alt="Task Categories">
          
            </li>
            <li class="image-item">
                <div class="image-text">Enable cloud sync to access your to-do list across devices.</div>

              <img src="http://localhost/PROJECTFF/public/images/class note.png" alt="Backup and Sync">
            </li>
          </ul>
          
        <button id="next-slide" class="slide-button material-symbols-rounded">
          >
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
    </div>
     -->
       
     
     <div class="settings-container" id="SNNS">
        <div class="settings-header">
            <h2 id="headerTitle">Settings</h2>
            <button id="resetButton" onclick="resetSettings()">Reset to Default</button>
        </div>

        <div class="settings-section">
            <h3 id="generalTitle">General Settings</h3>
            <div class="settings-option">
                <label for="darkModeToggle" id="darkModeLabel">Dark Mode</label>
                <input type="checkbox" id="darkModeToggle" onclick="toggleDarkMode()">
            </div>
            <div class="settings-option">
                <label for="languageSelect" id="languageLabel">Language</label>
                <select id="languageSelect" onchange="updateLanguage()">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                </select>
            </div>
        </div>

        <div class="settings-section">
            <h3 id="privacyTitle">Privacy Settings</h3>
            <div class="settings-option">
                <label for="trackUsage" id="usageLabel">Allow Usage Tracking</label>
                <input type="checkbox" id="trackUsage" onclick="handleUsageTracking()">
            </div>
            <div class="settings-option">
                <label for="notificationToggle" id="notificationLabel">Enable Notifications</label>
                <input type="checkbox" id="notificationToggle" onclick="handleNotifications()">
            </div>
        </div>

        <div class="settings-section">
            <h3 id="accountTitle">Account Settings</h3>
            <div class="settings-option">
                <label for="usernameInput" id="usernameLabel">Username</label>
                <input type="text" id="usernameInput" value="JohnDoe">
                <button id="saveButton" onclick="updateUsername()">Save</button>
            </div>
            <div class="settings-option">
                <label for="passwordInput" id="passwordLabel">Password</label>
                <input type="text" id="passwordInput" placeholder="********">
                <button id="changeButton" onclick="updatePassword()">Change</button>
            </div>
        </div>
    </div>

    <!-- Animation elements -->
    <div class="animation" id="trackingAnimation">🎉 Tracking Enabled! 🎉</div>
    <div class="animation" id="notificationsAnimation">🔔 Notifications Enabled! 🔔</div>

<div>

    <div class="usersss"id="sh">
        <div class="recent">
            <div class="title">
                <h2><img width="100" height="100" src="https://img.icons8.com/clouds/100/group.png" alt="group"/></h2>
                <a href="#" id="view-all-btn" class="view" onclick="showAllUsers()" > <img width="48px" height="48px" src="https://img.icons8.com/ios-filled/50/show-all-views.png" alt="group"/></a>    
                <a href="#" class="view" onclick="openAddModal()"><img width="50px" height="50px" src="http://localhost/PROJECTFF/public/images/icons8-add-100.png" alt="add-administrator"/></a>
                 
               
            </div>
        
            <div id="addModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeAddModal()">&times;</span>
        <h2>Add User</h2>
        <form id="add-form" method="POST">
            <label for="add_username">Username:</label>
            <input id="add_username" name="username" type="text" required>
            <p id="add-name-error" class="error-message" style="display: none;"></p>

            <label for="add_email">Email:</label>
            <input id="add_email" name="email" type="email" required>
            <p id="add-email-error" class="error-message" style="display: none;"></p>

            <label for="add_password">Password:</label>
            <input id="add_password" name="password" type="password" required>
            <div class="password-strength">
                <div class="progress-bar-container">
                    <div class="progress-bar" id="add-strength-bar"></div>
                </div>
                <span class="strength-level" id="add-strength-level">Password strength</span>
            </div>
            <p id="add-strength-tip" style="display: none;"></p>

            <button type="submit">Add User</button>
            <p id="add-error-message" class="error-message" style="display: none;"></p>
            <p id="add-success-message" class="success-message" style="display: none;"></p>
        </form>
    </div>
</div>
        <div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeEditModal()">&times;</span>
        <h2>Edit User</h2>
        <form id="edit-form" method="POST" action="/edit-user.php">
            <label for="modal_old_username">Old Username:</label>
            <input type="text" id="modal_old_username" name="old_username" readonly>

            <label for="modal_new_username">New Username:</label>
            <input type="text" id="modal_new_username" name="new_username" required>

            <label for="modal_email">Email:</label>
            <input type="email" id="modal_email" name="email" required>

            <label for="modal_password">Password:</label>
            <input type="password" id="modal_password" name="password" required>

            <button type="submit">Update User</button>
            <p id="error-message">A user with the same email already exists.</p>
            <p id="success-message">User added successfully!</p>
        </form>
    </div>
</div>

<div id="deleteConfirmPopup" class="confirmation-modal">
    <div class="confirmation-content">
        <h4>Confirm Deletion</h4>
        <p>Type the username "<span id="usernameToDeleteDisplay"></span>" to confirm deletion:</p>
        <input type="text" id="confirmUsernameInput" placeholder="Enter username to confirm">
        <button id="confirmDeleteBtn" class="btn-confirm">Yes, Delete</button>
        <button id="cancelDeleteBtn" class="btn-cancel">Cancel</button>
        <p id="deletion-message" style="display:none; margin-top: 20px;"></p> <!-- Message display -->
    </div>
</div>





<div class="scrollable-div">
    
<div>
    <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterTable()" />
   
</div>
                <table id="users2">
                    <thead>
                        <tr>
                            <td>UserName</td>
                            <td>Email</td>
                            <td>Password</td>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                    <?php
                    
                    $displayLimit = 5; // Number of rows to display initially
                    $count = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $rowClass = $count < $displayLimit ? 'visible' : 'hidden';
                            echo "<tr class='$rowClass'>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                           
                            echo "<td>
                            <button class='edit-button' onclick='openEditModal(\"" . htmlspecialchars($row["username"], ENT_QUOTES) . "\", \"" . htmlspecialchars($row["email"], ENT_QUOTES) . "\", \"" . htmlspecialchars($row["password"], ENT_QUOTES) . "\")'>
                            <img width='34' height='34' src='https://img.icons8.com/glyph-neue/64/edit-administrator.png' alt='edit-administrator'/>   
                       
                            </button>
                          </td>";
                          echo "<td>
                          <button class='delete-button' onclick='openDeleteConfirmModal(\"" . htmlspecialchars($row["username"], ENT_QUOTES) . "\")'>
                              
                          <img width='32' height='32' src='https://img.icons8.com/ios-glyphs/30/remove-user-male.png' alt='Delete User'/>
                          </button>
                        </td>";
                  
                            echo "</tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>No users found</td></tr>";
                    }
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
   
    <div class="usersss" id="aa">
        <div class="recent">
     <div class="title">
         <a id="generateReportBtn">Generate Report</a>
    </div>
    <div class="table-container">
    <h1>User Task Statistics</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Total Tasks</th>
                <th>Completed Tasks</th>
                <th>Stats of Tasks</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userTaskCounts as $data): ?>
                <tr>
                    <td><?php echo htmlspecialchars($data['username']); ?></td>
                    <td><?php echo htmlspecialchars($data['total_taskss']); ?></td>
                    <td><?php echo htmlspecialchars($data['completed'] ?? 0); ?></td>
                    <td>
                        <?php
                        // Ensure valid numbers to prevent division errors

                        $totalTaskss = $data['total_taskss'] ?? 0;
                        $completedTasks = $data['completed'] ?? 0;

                        if ($totalTaskss > 0) {
                            echo htmlspecialchars("$completedTasks out of $totalTaskss (" . round(($completedTasks / $totalTaskss) * 100, 2) . "%)");
                        } else {
                            echo "No tasks assigned";
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</div>

<!-- Modal for Report Generation -->
<div id="reportModal" class="modal">
    <div class="modal-content">
        <h4>Generate Report</h4>
        <form id="reportForm">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>

            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>

            <label for="reportType">Report Type:</label>
            <select id="reportType" name="reportType" required>
                <option value="activity">User Activity</option>
                <option value="completion">Task Completion</option>
            </select>

            <button type="submit">Generate</button>
            <button type="button" class="close-modal" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>
</div>
</div>     
<div class="card5" id="ash">
    
<div class="tablee">

    <table id="users2">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Task ID</th>
                <th>Title</th>
                <th>Due Date</th>
                <th>Reminder</th>
                <th>Priority</th>
                <th>category</th>
                <th>completed_task</th>
                <th>Flag</th>
                <th>Task Created At</th>
            </tr>
        </thead>
        <tbody>
        </div>

            <?php
            if (!empty($usersWithTasks)) {
                foreach ($usersWithTasks as $row) {

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["task_id"] ?? 'No tasks assigned') . "</td>";
                    echo "<td>" . htmlspecialchars($row["title"] ?? 'No tasks assigned') . "</td>";
                    echo "<td>" . htmlspecialchars($row["due_date"] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row["reminder"] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row["priority"] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row["category"] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row["completed"] ?? '') . "</td>";
                     
                    echo "<td>" . htmlspecialchars($row["flag"] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars(string: $row["task_created_at"] ?? '') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    
</body>
</html>

</body>
<script src="../../Public/js/dash.js"></script>
<script src="../../Public/js/main.js"></script>



<script>
        const translations = {
            en: {
                headerTitle: "Settings",
                generalTitle: "General Settings",
                darkModeLabel: "Dark Mode",
                languageLabel: "Language",
                privacyTitle: "Privacy Settings",
                usageLabel: "Allow Usage Tracking",
                notificationLabel: "Enable Notifications",
                accountTitle: "Account Settings",
                usernameLabel: "Username",
                passwordLabel: "Password",
                resetButton: "Reset to Default",
                saveButton: "Save",
                changeButton: "Change"
            },
            es: {
                headerTitle: "Configuraciones",
                generalTitle: "Configuraciones Generales",
                darkModeLabel: "Modo Oscuro",
                languageLabel: "Idioma",
                privacyTitle: "Configuraciones de Privacidad",
                usageLabel: "Permitir Seguimiento de Uso",
                notificationLabel: "Habilitar Notificaciones",
                accountTitle: "Configuraciones de la Cuenta",
                usernameLabel: "Nombre de Usuario",
                passwordLabel: "Contraseña",
                resetButton: "Restablecer a Predeterminado",
                saveButton: "Guardar",
                changeButton: "Cambiar"
            },
            fr: {
                headerTitle: "Paramètres",
                generalTitle: "Paramètres Généraux",
                darkModeLabel: "Mode Sombre",
                languageLabel: "Langue",
                privacyTitle: "Paramètres de Confidentialité",
                usageLabel: "Autoriser le Suivi d'Utilisation",
                notificationLabel: "Activer les Notifications",
                accountTitle: "Paramètres du Compte",
                usernameLabel: "Nom d'utilisateur",
                passwordLabel: "Mot de Passe",
                resetButton: "Réinitialiser par Défaut",
                saveButton: "Sauvegarder",
                changeButton: "Modifier"
            }
        };
    
        // Update language function
        function updateLanguage() {
            const language = document.getElementById("languageSelect").value;
            const elements = Object.keys(translations[language]);
    
            elements.forEach(key => {
                document.getElementById(key).textContent = translations[language][key];
            });
        }
    
        // Toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            document.querySelector(".settings-container").classList.toggle("dark-mode");
            document.querySelectorAll(".settings-option").forEach(option => option.classList.toggle("dark-mode"));
        }
    
        // Handle usage tracking
        function handleUsageTracking() {
            const isChecked = document.getElementById("trackUsage").checked;
            const animation = document.getElementById("trackingAnimation");
    
            if (isChecked) {
                animation.style.display = "block";
                animation.style.animation = "fadeOut 2s forwards";
                setTimeout(() => {
                    animation.style.display = "none";
                }, 2000);
            } else {
                alert("Usage tracking disabled.");
            }
        }
    
        // Handle notifications
        function handleNotifications() {
            const isChecked = document.getElementById("notificationToggle").checked;
            const animation = document.getElementById("notificationsAnimation");
    
            if (isChecked) {
                animation.style.display = "block";
                animation.style.animation = "fadeOut 2s forwards";
                setTimeout(() => {
                    animation.style.display = "none";
                }, 2000);
            } else {
                alert("Notifications disabled.");
            }
        }
    
        // Update username
        function updateUsername() {
            const username = document.getElementById("usernameInput").value;
            localStorage.setItem("username", username); // Save to localStorage
            alert("Username updated to: " + username);
        }
    
        // Update password
        function updatePassword() {
            const password = document.getElementById("passwordInput").value;
            localStorage.setItem("password", password); // Save to localStorage
            alert("Password updated successfully!");
        }
    
        // Reset all settings
        function resetSettings() {
            document.getElementById("darkModeToggle").checked = false;
            document.getElementById("trackUsage").checked = false;
            document.getElementById("notificationToggle").checked = false;
            document.getElementById("languageSelect").value = "en";
            document.getElementById("usernameInput").value = "JohnDoe";
            document.getElementById("passwordInput").value = "";
    
            localStorage.clear(); // Clear saved settings
            document.body.classList.remove("dark-mode");
            updateLanguage();
            alert("Settings reset to default!");
        }
    
        // Load saved settings on page load
        document.addEventListener("DOMContentLoaded", () => {
            const savedUsername = localStorage.getItem("username");
            const savedPassword = localStorage.getItem("password");
    
            if (savedUsername) {
                document.getElementById("usernameInput").value = savedUsername;
            }
            if (savedPassword) {
                document.getElementById("passwordInput").value = savedPassword;
            }
        });
    </script>
</html>