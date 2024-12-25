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
    <link rel="stylesheet" href="http://localhost/PROJECTFF/public/css/dashboard.css">
    <link rel="stylesheet" href="http://localhost/PROJECTFF/public/css/edit-user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <style>
    .password-strength-tray {
    margin-top: 5px;
    padding: 5px;
    color: white;
    text-align: center;
    font-size: 14px;
    border-radius: 3px;
    display: none; /* Initially hidden */
}

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
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-question"></i> </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-gear"></i></span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
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
                <div class="search">
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
                            <h4>15240</h4>
                            <p>Comments</p>
                        </div>
                        </div>
                        <div class="card">
                            <div class="iconn" class="icon1"><i class="fa-solid fa-money-bill"></i> </div> 
                            <div id="info">
                            <h4>9000$</h4>
                            <p>profit</p>
                            </div>
                        </div>
                
                
                        <div class="card">
                            <div class="iconn" class="icon1"><i class="fa-regular fa-eye"></i></div> 
                            <div id="info">
                            <h4>18241</h4>
                            <p>customers</p>
                            </div>
                        </div>
                
                
                        <div class="card">
                            <div class="iconn" class="icon1"><i class="fa-solid fa-cart-shopping"></i></div>
                            <div id="info">
                            <h4>1900$</h4>
                            <p>Sales</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div>
    
    <div class="usersss"id="sh">
        <div class="recent">
            <div class="title">
                <h2> Users</h2>
                <a href="#" id="view-all-btn" class="view" onclick="showAllUsers()">View All</a>    
                <a href="#" class="view" onclick="openAddModal()">ADD</a>
                <a href="#" class="view">Delete</a>
               
            </div>
        
            <div id="addModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeAddModal()">&times;</span>
        <h2>Add User</h2>
        <form id="add-form" method="POST" action="/add-user.php">
            <label for="add_username">Username:</label>
            <input id="add_username" name="username" type="text" required>
            <p id="add-name-error" class="error-message" style="display: none;">Name must contain only letters and be 3-15 characters long.</p>

            <label for="add_email">Email:</label>
            <input id="add_email" name="email" type="email" 
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                title="Please enter a valid email address" required>
            <p id="add-email-error" class="error-message" style="display: none;">Please enter a valid Gmail address (e.g., name@gmail.com).</p>

            <label for="add_password">Password:</label>
            <input id="add_password" name="password" type="password" 
                title="Password must include uppercase, lowercase, a number, a symbol, and be at least 8 characters long" 
                required>
            <div class="password-strength">
                <div class="strength-bar" id="add-strength-bar"></div>
                <span class="strength-level" id="add-strength-level">Password strength</span>
            </div>

            <button type="submit">Add User</button>
            <p id="add-error-message" class="error-message" style="display: none;">A user with the same email already exists.</p>
            <p id="add-success-message" class="success-message" style="display: none;">User added successfully!</p>
            <div class="password-strength-tray" id="add-strength-tray" style="display: none;">Weak Password</div>

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
                <table>
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

                            echo "<td><button class='edit-button' onclick='openEditModal(\"" . $row["username"] . "\", \"" . $row["email"] . "\", \"" . $row["password"] . "\")'>Edit</button></td>";
                            echo "<td><button class='delete-button' onclick='openDeleteConfirmModal(\"" . $row["username"] . "\")'>Delete</button></td>";

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
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Tasks Completed</th>
                    <th>Completion Rate</th>
                    <th>Last Active</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="http://localhost/PROJECTFF/public/images/man.png" class="user-img" alt="User Image"> Alice Johnson</td>
                    <td>34 / 40</td>
                    <td>85%</td>
                    <td>27 Oct 2024</td>
                    <td><span class="status-badge status-completed">Active</span></td>
                </tr>
                <tr>
                    <td><img src="http://localhost/PROJECTFF/public/images/man.png" class="user-img" alt="User Image"> Bob Smith</td>
                    <td>10 / 50</td>
                    <td>20%</td>
                    <td>25 Oct 2024</td>
                    <td><span class="status-badge status-pending">Inactive</span></td>
                </tr>
                <tr>
                    <td><img src="http://localhost/PROJECTFF/public/images/man.png" class="user-img" alt="User Image"> Carol Davis</td>
                    <td>48 / 50</td>
                    <td>96%</td>
                    <td>27 Oct 2024</td>
                    <td><span class="status-badge status-completed">Active</span></td>
                </tr>
                <tr>
                    <td><img src="http://localhost/PROJECTFF/public/images/man.png" class="user-img" alt="User Image"> Dan Lee</td>
                    <td>35 / 70</td>
                    <td>50%</td>
                    <td>24 Oct 2024</td>
                    <td><span class="status-badge status-in-progress">In Progress</span></td>
                </tr>
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
    <div class="dashboard-card" id="ash">
        <div class="card-headery">
            <h4>Admin Dashboard - Active Users</h4>
            <a href="#" class="view-more">View All Users</a>
        </div>
        <div class="task-item">
            <img src="http://localhost/PROJECTFF/public/images/face3.jpg" alt="profile image" class="profile-img">
            <div class="task-details">
                <p>Task: Complete Mobile App UI</p>
                <small>Assigned by: John Doe</small>
                <small class="activity-info">Last active: 5 mins ago</small>
            </div>
            <small class="task-time">Due: 10:07PM</small>
        </div>
        <div class="task-item">
            <img src="http://localhost/PROJECTFF/public/images/face4.jpg" alt="profile image" class="profile-img">
            <div class="task-details">
                <p>Task: Backend API Development</p>
                <small>Assigned by: Jane Smith</small>
                <small class="activity-info">Last active: 1 hr ago</small>
            </div>
            <small class="task-time">Due: 01:07AM</small>
        </div>
        <div class="task-item">
            <img src="http://localhost/PROJECTFF/public/images/face3.jpg" alt="profile image" class="profile-img">
            <div class="task-details">
                <p>Task: Redesign Website</p>
                <small>Assigned by: Michael Lee</small>
                <small class="activity-info">Last active: 3 hrs ago</small>
            </div>
            <small class="task-time">Due: 04:42AM</small>
        </div>
        <div class="task-item">
            <img src="http://localhost/PROJECTFF/public/images/face2.jpg" alt="profile image" class="profile-img">
            <div class="task-details">
                <p>Task: Set Up Analytics Dashboard</p>
                <small>Assigned by: Sarah Brown</small>
                <small class="activity-info">Last active: 1 day ago</small>
            </div>
            <small class="task-time">Due: 07:44PM</small>
        </div>
        <div class="task-item">
            <img src="http://localhost/PROJECTFF/public/images/face1.jpg" alt="profile image" class="profile-img">
            <div class="task-details">
                <p>Task: Design New Logo</p>
                <small>Assigned by: Alex Green</small>
                <small class="activity-info">Last active: 2 days ago</small>
            </div>
            <small class="task-time">Due: 10:49AM</small>
        </div>
    </div>
</body>
<script src="http://localhost/PROJECTFF/Public/js/dash.js"></script>
<script src="http://localhost/PROJECTFF/Public/js/main.js"></script>
</html>
