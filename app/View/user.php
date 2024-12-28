
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="../../Public/css/Tasks.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <div class="sidebar-menu">
       
    <div class="profile-section">
    <div class="profile-avatar">Y</div> <!-- Default initial -->
    <div class="profile-info">
        <p class="username">Loading...</p> <!-- Placeholder for username -->
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

            
            <button class="btn" id="Eventbtn><i class="fas fa-file"></i> Events</button>
            <button class="btn"><i class="fas fa-calendar"></i> Calendar</button>
            <input type="datetime-locall" id="customDateInputt" style="display:none;" />
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
    


    <div id="notificationRoot"></div>
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
                <button class="open-gallery">Open Gallery</button>
            </div>
            <button id="saveBtn" class="btn1">Save</button>
        </div>
</div>
<div id="calendarOverlay">
        <div id="calendarModal">
            <div id="calendar"></div> <!-- Placeholder for the calendar -->
            <button onclick="closeCalendar()">Close Calendar</button>
        </div>
    </div>
   
</div>
    <div class="task-modal" id="taskModal">
        <div class="task-modal-content">
            <h2><i class="fa fa-check-circle"></i> Enter task</h2>
            <div class="task-fields">
                <label ><i class="fa fa-pen"></i> Title</label>
                <textarea class="des" id="des" placeholder="What is this task about?"></textarea>

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
        <option value="Work">Work</option>
        <option value="School">School</option>
        <option value="Personal">Personal</option>
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
        <button id="applyFilterBtn">Apply</button> <!-- Filter button -->
    </div>
    <input type="text" id="searchTask" placeholder="Find tasks..." class="search-bar1">
</div>

<div class="task-tabs">
    <span class="tab active" data-category="all">All tasks</span>
    <span class="tab" data-category="School">School</span>
    <span class="tab" data-category="Personal">Personal</span>
    <span class="tab" data-category="Work">Work</span>
</div>
    <div class="task-table-header">
        <span class="column-header">Title</span>
        <span class="column-header">Due date</span>
        <span class="column-header">Reminder</span>
        <span class="column-header">Assigned to</span>
    </div>
    <div id="taskDisplay" class="task-display">
    </div>

<div id="mainContent1">
    <div id="taskListContainer"></div>
</div>

</body>


<script>
    function NewYearModal() {
        // Set initial state to open the modal immediately
        var isOpenState = React.useState(true);
        var isOpen = isOpenState[0];
        var setIsOpen = isOpenState[1];

        var timeLeftState = React.useState({
            days: 10,
            hours: 2,
            minutes: 24,
            seconds: 44
        });
        var timeLeft = timeLeftState[0];
        var setTimeLeft = timeLeftState[1];

        React.useEffect(function() {
            if (isOpen) {
                var timer = setInterval(function() {
                    setTimeLeft(function(prev) {
                        var newTime = { ...prev };
                        newTime.seconds--;

                        if (newTime.seconds < 0) {
                            newTime.seconds = 59;
                            newTime.minutes--;

                            if (newTime.minutes < 0) {
                                newTime.minutes = 59;
                                newTime.hours--;

                                if (newTime.hours < 0) {
                                    newTime.hours = 23;
                                    newTime.days--;
                                }
                            }
                        }

                        return newTime;
                    });
                }, 1000);

                return function() {
                    clearInterval(timer);
                };
            }
        }, [isOpen]);

        function padNumber(num) {
            return String(num).padStart(2, '0');
        }

        return React.createElement('div', { className: 'relative' },
            React.createElement('button', {
                onClick: function() { setIsOpen(true); },
                className: 'p-2 rounded-full hover:bg-gray-100 transition-colors'
            }, '🔔'),

            isOpen && React.createElement('div', {
                className: 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50'
            },
                React.createElement('div', {
                    className: 'modal-bg text-white rounded-lg w-full max-w-lg mx-4 relative overflow-hidden'
                }, [
                    React.createElement('button', {
                        key: 'close',
                        onClick: function() { setIsOpen(false); },
                        className: 'absolute right-4 top-4 text-gray-300 hover:text-white'
                    }, '×'),

                    React.createElement('div', {
                        key: 'left-ornament',
                        className: 'absolute left-8 top-16'
                    }, [
                        React.createElement('span', { key: 'star1', className: 'text-yellow-400' }, '✨'),
                        React.createElement('div', { key: 'ornament1', className: 'mt-4' }, '🎈')
                    ]),

                    React.createElement('div', {
                        key: 'right-ornament',
                        className: 'absolute right-8 top-16'
                    }, [
                        React.createElement('span', { key: 'star2', className: 'text-yellow-400' }, '✨'),
                        React.createElement('div', { key: 'ornament2', className: 'mt-4' }, '🎈')
                    ]),

                    React.createElement('div', {
                        key: 'content',
                        className: 'pt-8 pb-6 px-8 text-center'
                    }, [
                        React.createElement('div', {
                            key: 'exclusive',
                            className: 'inline-block bg-white text-black rounded-full px-4 py-1 text-sm font-semibold mb-4'
                        }, 'EXCLUSIVE OFFER'),

                        React.createElement('h2', {
                            key: 'title1',
                            className: 'text-4xl font-bold mb-2'
                        }, 'Boost your'),

                        React.createElement('h2', {
                            key: 'title2',
                            className: 'text-4xl font-bold mb-8'
                        }, 'productivity in the new year'),

                        React.createElement('div', {
                            key: 'discount',
                            className: 'price-text text-7xl font-bold mb-2'
                        }, '-40%'),

                        React.createElement('div', {
                            key: 'offer',
                            className: 'price-text text-xl mb-8'
                        }, 'NEW YEAR\'S OFFER'),

                        React.createElement('div', {
                            key: 'timer',
                            className: 'flex justify-center gap-4 mb-8'
                        }, [
                            createTimerUnit(padNumber(timeLeft.days), 'days'),
                            React.createElement('div', { key: 'sep1', className: 'text-xl' }, ':'),
                            createTimerUnit(padNumber(timeLeft.hours), 'hours'),
                            React.createElement('div', { key: 'sep2', className: 'text-xl' }, ':'),
                            createTimerUnit(padNumber(timeLeft.minutes), 'minutes'),
                            React.createElement('div', { key: 'sep3', className: 'text-xl' }, ':'),
                            createTimerUnit(padNumber(timeLeft.seconds), 'seconds')
                        ]),

                        React.createElement('button', {
                            key: 'continue',
                            onClick: function() { setIsOpen(false); },
                            className: 'w-full bg-green-500 hover:bg-green-600 text-white rounded-lg py-4 text-xl font-semibold mb-6 transition-colors'
                        }, 'Continue'),

                        React.createElement('div', {
                            key: 'pricing',
                            className: 'text-gray-400'
                        }, [
                            React.createElement('span', {
                                key: 'original',
                                className: 'line-through'
                            }, '$129.99'),
                            React.createElement('span', {
                                key: 'new',
                                className: 'text-white font-bold ml-2'
                            }, '$77.99 / year')
                        ]),

                        React.createElement('div', {
                            key: 'monthly',
                            className: 'text-gray-400 italic mt-1'
                        }, 'just $6.49 / month')
                    ])
                ])
            )
        );
    }

    function createTimerUnit(value, label) {
        return React.createElement('div', {
            className: 'timer-bg rounded p-2 w-16',
            key: label
        }, [
            React.createElement('div', {
                key: 'value',
                className: 'text-2xl font-bold'
            }, value),
            React.createElement('div', {
                key: 'label',
                className: 'text-xs text-gray-400'
            }, label)
        ]);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var root = document.getElementById('notificationRoot');
        if (root) {
            ReactDOM.createRoot(root).render(
                React.createElement(NewYearModal)
            );
        }
    });
</script>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    fetch('../../app/Controllers/taskcontroller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=getUsername' // Send the action to get the username
    })
    .then(response => response.text()) // Get the plain text username
    .then(username => {
        // Update the profile section with the username
        document.querySelector(".profile-avatar").textContent = username.charAt(0).toUpperCase(); // First letter of the username
        document.querySelector(".username").textContent = `Welcome, ${username}`; // Add "Welcome" before the username
    })
    .catch(error => console.error("Error fetching username:", error));
});



document.querySelector('.create-btn').addEventListener('click', function () {
    const dueDate = document.getElementById('customDateInput').value;
    const reminder = document.getElementById('customReminderInput').value;
    const title=document.getElementById('des').value;
    const taskData = new URLSearchParams();
    taskData.append('action', 'create'); // Action type
    taskData.append('title', title || "");
    taskData.append('due_date', dueDate || "");
    taskData.append('reminder', reminder || "");
    taskData.append(
        'priority',
        document.querySelector('.task-priority-options .selected')?.innerText || "Low"
    );
    taskData.append('category', document.getElementById('taskCategory').value || "");
    taskData.append(
        'flag',
        document.querySelector('input[type="checkbox"]').checked ? 1 : 0
    );

    fetch('../../app/Controllers/taskcontroller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: taskData.toString(), // Send data as a URL-encoded string
    })
        .then(response => response.text()) // Read the response as plain text
        .then(text => {
            console.log(text); // Log raw response for debugging
            alert(text); // Display the response message directly
        })
        .catch(error => console.error("Error:", error)); // Log network errors
});
document.addEventListener('DOMContentLoaded', function () {
    let currentTasks = [];

    // Initialize Flatpickr for the custom date input
    const dateInput = document.getElementById('customDateInput');
    const reminderInput = document.getElementById('customReminderInput');

    function initFlatpickr(input) {
        flatpickr(input, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today"
        });
    }

    document.getElementById('customDateBtn').addEventListener('click', function() {
        const dateInput = document.getElementById('customDateInput');
        if (dateInput.style.display === "none" || dateInput.style.display === "") {
            dateInput.style.display = "block";
            initFlatpickr(dateInput); // Initialize Flatpickr when visible
        } else {
            dateInput.style.display = "none";
        }
    });

    document.getElementById('customReminderBtn').addEventListener('click', function() {
        const reminderInput = document.getElementById('customReminderInput');
        if (reminderInput.style.display === "none" || reminderInput.style.display === "") {
            reminderInput.style.display = "block";
            initFlatpickr(reminderInput); // Initialize Flatpickr when visible
        } else {
            reminderInput.style.display = "none";
        }
    });

    // Fetch tasks and display
    fetch('../../app/Controllers/taskcontroller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'getTasks' })
    })
    .then(response => response.json())
    .then(tasks => {
        currentTasks = tasks;
        displayTasks(currentTasks);
    })
    .catch(error => {
        console.error("Error fetching tasks:", error);
        document.getElementById('taskDisplay').innerHTML = '<p>Failed to load tasks. Please try again later.</p>';
    });

    // Function to display tasks
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function () {
            const selectedCategory = this.getAttribute('data-category');

            // Remove "active" class from all tabs and set it for the clicked tab
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Filter tasks based on the selected category
            const filteredTasks =
                selectedCategory === 'all'
                    ? currentTasks // Show all tasks for "all"
                    : currentTasks.filter(task => task.category === selectedCategory);

            displayTasks(filteredTasks); // Render filtered tasks
        });
    });

    // Function to display tasks
    function displayTasks(tasks) {
        const taskDisplay = document.getElementById('taskDisplay');
        taskDisplay.innerHTML = '';

        if (Array.isArray(tasks) && tasks.length > 0) {
            tasks.forEach(task => {
                const taskRow = document.createElement('div');
                taskRow.classList.add('task-row');

                taskRow.innerHTML = `
                    <div class="task-completion">
                        <input type="checkbox" 
                            id="completion-${task.id}" 
                            class="task-complete-checkbox" 
                            ${task.completed === 1 ? 'checked' : ''}>
                        <label for="completion-${task.id}" class="completion-circle"></label>
                    </div>
                    <span class="task-title ${task.completed === 1 ? 'completed' : ''}" data-id="${task.id}">
                        ${task.title}
                    </span>
                    <span>${task.due_date}</span>
                    <span>${task.reminder}</span>
                    <span>${task.assigned_to || 'Unassigned'}</span>
                `;
                taskDisplay.appendChild(taskRow);

                // Add checkbox and modal functionality (reuse from existing code)
                const checkbox = taskRow.querySelector(`#completion-${task.id}`);
                checkbox.addEventListener('change', function (e) {
                    e.stopPropagation();
                    updateTaskCompletion(task.id, this.checked);
                });

                const taskTitle = taskRow.querySelector('.task-title');
                taskTitle.addEventListener('click', () => openTaskModal(task));
            });
        } else {
            taskDisplay.innerHTML = '<p>No tasks found for this category.</p>';
        }
    }

// Updated updateTaskCompletion function with better error handling and logging
function updateTaskCompletion(taskId, completed) {
    console.log('Updating task completion:', { taskId, completed }); // Debug log

    const taskData = new URLSearchParams();
    taskData.append('action', 'updateCompletion');
    taskData.append('id', taskId);
    taskData.append('completed', completed ? 1 : 0);

    fetch('../../app/Controllers/taskcontroller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: taskData.toString()
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(text => {
        console.log('Server response:', text); // Debug log
        
        // Update the UI
        const taskTitle = document.querySelector(`.task-title[data-id="${taskId}"]`);
        if (taskTitle) {
            if (completed) {
                taskTitle.classList.add('completed');
            } else {
                taskTitle.classList.remove('completed');
            }
        }

        // Optionally refresh the task list
        // loadTasks(); // Uncomment if you want to refresh the entire list
    })
    .catch(error => {
        console.error('Error updating task completion:', error);
        alert('Failed to update task completion status');
    });
}
    // Function to open task modal for editing
    function openTaskModal(task) {
        document.getElementById('des').value = task.title || '';
        document.getElementById('customDateInput').value = task.due_date || '';
        document.getElementById('customReminderInput').value = task.reminder || '';
        document.getElementById('taskCategory').value = task.category || '';
        document.querySelector('input[type="checkbox"]').checked = task.flag === 1;

        // Highlight priority
        document.querySelectorAll('.task-priority-options button').forEach(btn => {
            if (btn.innerText === task.priority) {
                btn.classList.add('selected');
            } else {
                btn.classList.remove('selected');
            }
        });

        // Show the modal
        document.getElementById('taskModal').style.display = 'block';

        // Update buttons visibility
        const createBtn = document.querySelector('.create-btn');
        const deleteBtn = document.querySelector('.delete-btn');
        createBtn.style.display = 'none';
        deleteBtn.style.display = 'inline-block';

        // Add update button dynamically
        const updateBtn = document.createElement('button');
        updateBtn.textContent = 'Update Task';
        updateBtn.classList.add('update-btn');
        deleteBtn.insertAdjacentElement('beforebegin', updateBtn);

        // Update task on button click
        updateBtn.addEventListener('click', function() {
            const updatedTaskData = new URLSearchParams();
            updatedTaskData.append('action', 'update');
            updatedTaskData.append('id', task.id);
            updatedTaskData.append('title', document.getElementById('des').value || '');
            updatedTaskData.append('due_date', document.getElementById('customDateInput').value || '');
            updatedTaskData.append('reminder', document.getElementById('customReminderInput').value || '');
            updatedTaskData.append('priority', document.querySelector('.task-priority-options .selected')?.innerText || 'Low');
            updatedTaskData.append('category', document.getElementById('taskCategory').value || '');
            updatedTaskData.append('flag', document.querySelector('input[type="checkbox"]').checked ? 1 : 0);

            fetch('../../app/Controllers/taskcontroller.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: updatedTaskData.toString()
            })
            .then(response => response.text())
            .then(text => {
                alert('Task updated successfully!');
                document.getElementById('taskModal').style.display = 'none';
                location.reload();
            })
            .catch(error => {
                alert('Failed to update task: ' + error.message);
            });
        });

        // Delete task
        deleteBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch('../../app/Controllers/taskcontroller.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ action: 'delete', id: task.id })
                })
                .then(response => response.text())
                .then(text => {
                    alert('Task deleted successfully!');
                    document.getElementById('taskModal').style.display = 'none';
                    location.reload();
                })
                .catch(error => {
                    alert('Failed to delete task: ' + error.message);
                });
            }
        });
    }

    // Event listeners for filters and search
    document.getElementById('applyFilterBtn').addEventListener('click', function() {
        const sortBy = document.getElementById('sortBy').value;
        const sortedTasks = sortTasks(currentTasks, sortBy);
        displayTasks(sortedTasks);
    });

    document.getElementById('searchTask').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        const filteredTasks = currentTasks.filter(task => task.title.toLowerCase().includes(searchTerm));
        displayTasks(filteredTasks);
    });
});

// Sorting function for tasks
const priorityOrder = {
    'High': 1,
    'Medium': 2,
    'Low': 3
};

function sortTasks(tasks, sortBy) {
    return [...tasks].sort((a, b) => {
        if (sortBy === 'priority') {
            return priorityOrder[a.priority] - priorityOrder[b.priority];
        } else if (sortBy === 'deadline') {
            const dateA = new Date(a.due_date).getTime();
            const dateB = new Date(b.due_date).getTime();
            return dateA - dateB;
        }
        return 0;
    });
}

</script>
<script src="../../Public/js/user.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</html>