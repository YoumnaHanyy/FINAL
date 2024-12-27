<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoneDeal</title>

    <!-- Linking to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Public/css/users.css">
</head>
<body>
    <div class="sidebar-menu">
        <!-- User Profile -->
        <div class="profile-section">
            <div class="profile-avatar">Y</div>
            <div class="profile-info">
                <p class="username">yomna2207085c5a5...</p>
                <p class="email">yomna2207085@miuegy...</p>
            </div>
            <div class="notifications">
                <span>&#128276;</span>
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
        
        <div class="action-buttons">
            <button id="noteBtn" class="btn">+ Note</button>
            <div class="sub-buttons">
                <button class="btn" id="taskbtn">+ Task</button>
                <button class="btn" id="eventbtn">+ Event</button>
            </div>
        </div>
        
        <div class="menu-items">
        <button class="btn" id="homeBtn"><i class="fa-solid fa-house"></i> Home</button>

        <button class="btn" id="tasksBtn"><i class="fas fa-tasks"></i> Tasks</button>

            
            <button class="btn"><i class="fas fa-file"></i> Files</button>
            <button class="btn"><i class="fas fa-calendar"></i> Calendar</button>
            <button class="btn"><i class="fas fa-book"></i> Notebooks</button>
            <button class="btn"><i class="fas fa-tag"></i> Tags</button>
            <button class="btn"><i class="fas fa-share-alt"></i> Shared with Me</button>
            <button class="btn"><i class="fas fa-trash"></i> Trash</button>
        </div>
        
        <div class="download-upgrade">
            <button class="download-btn">Download the app</button>
            <button class="upgrade-btn">Upgrade</button>
        </div>
        
        <div class="help-section">
            <button class="help-btn">Need a little help?</button>
        </div>
    </div>
    
    <div class="main-content" id="mainContent" style="display: none;">
        <!-- Toolbar at the top of the main content -->
        <div class="toolbar">
            <button class="toolbar-btn" onclick="execCmd('bold')"><i class="fa fa-bold"></i></button>
            <button class="toolbar-btn" onclick="execCmd('italic')"><i class="fa fa-italic"></i></button>
            <button class="toolbar-btn" onclick="execCmd('underline')"><i class="fa fa-underline"></i></button>
            <button class="toolbar-btn" onclick="execCmd('strikeThrough')"><i class="fa fa-strikethrough"></i></button>

            <select class="font-family" onchange="execCmd('fontName', this.value)">
                <option value="Sans Serif">Sans Serif</option>
                <option value="Serif">Serif</option>
                <option value="Monospace">Monospace</option>
            </select>

            <select class="font-size" onchange="execCmd('fontSize', this.value)">
                <option value="3">12</option> <!-- Corresponds to font-size 12px -->
                <option value="4">14</option> <!-- Corresponds to font-size 14px -->
                <option value="5">16</option> <!-- Corresponds to font-size 16px -->
                <option value="6">18</option> <!-- Corresponds to font-size 18px -->
                <option value="7">24</option> <!-- Corresponds to font-size 24px -->
            </select>

            <input type="color" class="color-picker" onchange="execCmd('foreColor', this.value)" />

            <button class="toolbar-btn" onclick="execCmd('justifyLeft')"><i class="fa fa-align-left"></i></button>
            <button class="toolbar-btn" onclick="execCmd('justifyCenter')"><i class="fa fa-align-center"></i></button>
            <button class="toolbar-btn" onclick="execCmd('justifyRight')"><i class="fa fa-align-right"></i></button>
        </div>

        <!-- Content area for writing notes -->
        <div class="content-area">
            <div class="title-input" contenteditable="true" data-placeholder="Title"></div>
            <div class="subtitle" contenteditable="true" data-placeholder="Start writing, drag files or start from a template"></div>
            <div class="template-suggestions">
                <button class="template-button">To-do list</button>
                <button class="template-button">Meeting note</button>
                <button class="template-button">Project plan</button>
                <button class="template-button">Add more</button>
            </div>
            <button class="open-gallery">Open Gallery</button>
        </div>
    </div>

   
</div>


    <div class="task-modal" id="taskModal">
        <div class="task-modal-content">
            <h2><i class="fa fa-check-circle"></i> Enter task</h2>
            <div class="task-fields">
                <label ><i class="fa fa-pen"></i> Title</label>
                <textarea class="des" placeholder="What is this task about?"></textarea>

                <label><i class="fa fa-calendar"></i> Due date</label>
                <div class="task-date-options">
                    <button>Today</button>
                    <button>Tomorrow</button>
                    <button id="customDateBtn">Custom</button>
                    <input type="datetime-local" id="customDateInput" style="display:none;" />
                    <button>Repeat</button>
                </div>

                <label><i class="fa fa-bell"></i> Reminder</label>
                <div class="task-reminder-options">
                    <button>In 1 hour</button>
                    <button>In 4 hours</button>
                    <button id="customReminderBtn">Custom</button>
                    <input type="text" id="customReminderInput" style="display:none;" />
                </div>

                <label><i class="fa fa-user"></i> Assigned to</label>
                <input type="text" placeholder="Assign">

                <label><i class="fa fa-exclamation-triangle"></i> Priority</label>
                <div class="task-priority-options">
                    <button>Low</button>
                    <button>Medium</button>
                    <button>High</button>
                </div>

                <label><i class="fa fa-flag"></i> Flag</label>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>

                <label><i class="fa fa-folder"></i> Category</label>
    <select id="taskCategory" class="task-category-options">
        <option value="work">Work</option>
        <option value="school">School</option>
        <option value="company">Personal</option>
    </select>
                <div class="task-actions">
                    <button class="cancel-btn">Cancel</button>
                    <button class="create-btn">Create task</button>
                    <button class="delete-btn" style="display: none;">Delete Task</button>
                </div>
            </div>
        </div>
    </div>
    <div class="event-modal" id="eventModal" style="display: none;">
    <div class="event-modal-content">
        <h2><i class="fa fa-calendar-plus"></i> Create Event</h2>
        <div class="event-fields">
            <label><i class="fa fa-pen"></i> Event Title</label>
            <input type="text" placeholder="Enter event title" id="eventTitle">

            <label><i class="fa fa-calendar"></i> Start Date & Time</label>
            <input type="datetime-local" id="eventStart">

            <label><i class="fa fa-calendar"></i> End Date & Time</label>
            <input type="datetime-local" id="eventEnd">

            <div class="event-actions">
                <button class="cancel-event-btn">Cancel</button>
                <button class="create-event-btn">Create Event</button>
            </div>
        </div>
    </div>
</div>

<div class="home-content" id="homeContent">
    <h2>Ready to start taking notes?</h2>
    <div class="notes-header">
        <h3>yomna2207085c5a50bc41c3d015e's Home</h3>
    </div>
    <div class="notes-section">
        <div class="note-card">
            <p>Untitled</p>
            <small>Oct 15</small>
        </div>
        <div class="note-card">
            <p>Meeting note</p>
            <p>Date & Time Goal<br>Attendees Me<br>Agenda Notes<br>Action Items</p>
            <small>Oct 14</small>
        </div>
      
    </div>
    <div class="recently-captured">
        <h3>Recently Captured</h3>
        <div class="capture-options">
            <button>Web Clips</button>
            <button>Images</button>
            <button>Documents</button>
            <button>Audio</button>
            <button>Emails</button>
        </div>
   

    <section class="container">
  <div class="heading">
    <img class="heading__img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/756881/laptop.svg">
    <h1 class="heading__title">To-Do List</h1>
  </div>
  <form class="form">
    <div>
      <label class="form__label" for="todo">~ Today I need to ~</label>
      <input class="form__input"
           type="text" 
           id="todo" 
           name="to-do"
           size="30"
           required>
      <button class="button"><span>Submit</span></button>
    </div>
  </form>
  <div>
    <ul class="toDoList">
    </ul>
  </div>
</div>
</section>
</div>

<div class="main-content1" id="taskContent" style="display: none;">
    <h2>Tasks </h2>
    <h4><span id="taskCount">0</span> tasks</h4>
    <div class="task-controls">
        <button id="newTaskBtn" class="new-task-btn">
            <i class="fas fa-plus-circle"></i> New Task
        </button>

        <div class="task-filters">
    <label for="sortBy" class="srt">Sort by:</label>
    <select id="sortBy" class="filter-select">
        <option value="priority">Priority</option>
        <option value="deadline">Deadline</option>
    </select>

    <!-- Sort Button -->
    <button id="sortBtn" class="sort-btn" title="Sort by Priority or Deadline">
        <i class="fa-solid fa-arrow-down-wide-short"></i>
    </button>
</div>


        <!-- Search Bar -->
        <input type="text" id="searchTask" placeholder="Find tasks..." class="search-bar1">
    </div>

    <!-- Task Tabs -->
    <div class="task-tabs">
        <span class="tab active">All tasks</span>
        <span class="tab">School</span>
        <span class="tab">Personal</span>
        <span class="tab">Work</span>
       
    </div>

    <!-- Table-like header for task details -->
    <div class="task-table-header">
        <span class="column-header">Title</span>
        <span class="column-header">Due date</span>
        <span class="column-header">Reminder</span>
        <span class="column-header">Assigned to</span>
    </div>
    <div id="taskDisplay" class="task-display">
        <!-- Tasks will be displayed here -->
         
    </div>

<div id="mainContent1">
    <div id="taskListContainer"></div>
</div>



<script src="../../Public/js/users.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>
<script>
document.querySelector('.create-btn').addEventListener('click', function () {
    const dueDate = document.getElementById('customDateInput').value;
    const reminder = document.getElementById('customReminderInput').value;

    const taskData = {
        title: document.querySelector('.des').value || "",
        due_date: dueDate || null,
        reminder: reminder || null,
        priority: document.querySelector('.task-priority-options .selected')?.innerText || "Low",
        category: document.getElementById('taskCategory').value || "",
        flag: document.querySelector('input[type="checkbox"]').checked ? 1 : 0
    };

    fetch('../Controllers/taskcontroller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(taskData)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error("Error:", error));
});






</script>
</html>


