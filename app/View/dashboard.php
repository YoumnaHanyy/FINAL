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
       #searchInput{
       color:burlywood;
        background-color:#000;
        width: 100%;
    height: 40px;
    border-radius: 90px;
    padding: 5px,18px;
    padding-left: 35px;
    border: 2.5px solid #1e1e1e;
    outline: none;
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
                    <td><?php echo htmlspecialchars($data['total_tasks']); ?></td>
                    <td><?php echo htmlspecialchars($data['completed_tasks'] ?? 0); ?></td>
                    <td>
                        <?php
                        // Ensure valid numbers to prevent division errors
                        $totalTasks = $data['total_tasks'] ?? 0;
                        $completedTasks = $data['completed_tasks'] ?? 0;

                        if ($totalTasks > 0) {
                            echo htmlspecialchars("$completedTasks out of $totalTasks (" . round(($completedTasks / $totalTasks) * 100, 2) . "%)");
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
    <div class="metrics">
        <div class="metric-card">
            <h3>Total Users</h3>
            <p><?php echo htmlspecialchars($totalUsers ?? 0); ?></p>
        </div>
        <div class="metric-card">
            <h3>Total Tasks</h3>
            <p><?php echo htmlspecialchars($totalTasks ?? 0); ?></p>
        </div>
        <div class="metric-card">
            <h3>High Priority Tasks</h3>
            <p><?php echo htmlspecialchars($highPriorityTasks ?? 0); ?></p>
        </div>
    </div>
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
                    echo "<td>" . htmlspecialchars($row["completed_task"] ?? '') . "</td>";
                     
                    echo "<td>" . htmlspecialchars($row["flag"] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row["task_created_at"] ?? '') . "</td>";
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
<script src="http://localhost/PROJECTFF/Public/js/dash.js"></script>
<script src="http://localhost/PROJECTFF/Public/js/main.js"></script>
</html>