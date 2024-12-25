
window.onload = function() {
    // Hide other content sections
    document.getElementById('mainContent').style.display = 'none';
    document.getElementById('taskContent').style.display = 'none';
    document.getElementById('eventModal').style.display = 'none';
    document.getElementById('taskModal').style.display = 'none';
    
    // Show the home content by default
    document.getElementById('homeContent').style.display = 'block';
    };
    // Store tasks in an array to be displayed later
    
    // Store tasks in an array
    
    // Store tasks in an array
    let tasks = [];
    let isEditing = false; // Flag to track if we're editing an existing task
    let taskIndexToEdit = null;
    
    // Get references to the task fields
    const taskDescriptionInput = document.querySelector('textarea');
    const taskDateButtons = document.querySelectorAll('.task-date-options button');
    const taskReminderButtons = document.querySelectorAll('.task-reminder-options button');
    const taskPriorityButtons = document.querySelectorAll('.task-priority-options button');
    const taskAssignedInput = document.querySelector('input[placeholder="Assign"]');
    const taskFlagInput = document.querySelector('input[type="checkbox"]');
    const deleteBtn = document.querySelector('.delete-btn'); // Reference to the delete button
    
    // Attach a single event listener for the "Create Task" button
    document.querySelector('.create-btn').addEventListener('click', function () {
        if (isEditing) {
            updateTask(taskIndexToEdit); // Update the existing task
        } else {
            saveTask(); // Create a new task
        }
    });
    
    // Function to toggle selection for buttons
    // Function to toggle selection and highlight the chosen button
    function toggleSelection(buttons) {
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'selected' class from all buttons in the group
                buttons.forEach(btn => btn.classList.remove('selected'));
                
                // Add 'selected' class to the clicked button
                this.classList.add('selected');
            });
        });
    }
    
    // Apply the toggle selection function to each group of buttons
    
    
    toggleSelection(taskDateButtons);
    toggleSelection(taskReminderButtons);
    toggleSelection(taskPriorityButtons);
    
    
    // Function to save the task
    function saveTask() {
        const description = taskDescriptionInput.value;
        const assignedTo = taskAssignedInput.value;
        let dueDate = '';
        let reminder = '';
        let priority = '';
        const isFlagged = taskFlagInput.checked ? 'Flagged' : 'Not Flagged';
    
        // Get selected values
        dueDate = Array.from(taskDateButtons).find(button => button.classList.contains('selected'))?.textContent || '-';
        reminder = Array.from(taskReminderButtons).find(button => button.classList.contains('selected'))?.textContent || '-';
        priority = Array.from(taskPriorityButtons).find(button => button.classList.contains('selected'))?.textContent || '-';
    
        const task = {
            description: description || 'No Description',
            assignedTo: assignedTo || 'Unassigned',
            dueDate: dueDate,
            reminder: reminder,
            priority: priority,
            flag: isFlagged
        };
    
        tasks.push(task);
        clearTaskModal();
        displayTasks();
    }
    
    // Function to clear the task modal after saving
    function clearTaskModal() {
        taskDescriptionInput.value = '';
        taskAssignedInput.value = '';
        taskFlagInput.checked = false;
        taskDateButtons.forEach(button => button.classList.remove('selected'));
        taskReminderButtons.forEach(button => button.classList.remove('selected'));
        taskPriorityButtons.forEach(button => button.classList.remove('selected'));
        document.getElementById('taskModal').style.display = 'none';
        isEditing = false;
        taskIndexToEdit = null;
        document.querySelector('.create-btn').textContent = 'Create Task'; // Reset button text
        deleteBtn.style.display = 'none'; // Hide delete button after closing modal
    }
    
    // Function to display tasks in the right-hand side
    function displayTasks() {
        const taskDisplay = document.getElementById('taskDisplay');
        const taskCount = document.getElementById('taskCount'); // Get the task count span
        taskDisplay.innerHTML = ''; // Clear previous tasks
    
        tasks.forEach((task, index) => {
            const taskItem = document.createElement('div');
            taskItem.classList.add('task-item');
            if (task.completed) {
                taskItem.classList.add('completed'); // Add completed class if the task is done
            }
            taskItem.setAttribute('data-index', index);
    
            // Add the task data in the grid structure
            taskItem.innerHTML = `
                <div class="task-desc">
                    <input type="checkbox" class="task-checkbox" ${task.completed ? 'checked' : ''} data-index="${index}">
                    ${task.description}
                </div>
                <div class="task-meta">${task.dueDate || '-'}</div>
                <div class="task-meta">${task.reminder || '-'}</div>
                <div class="task-meta">${task.assignedTo || '-'}</div>
            `;
    
            // Append the task item to the display
            taskDisplay.appendChild(taskItem);
    
            // Add event listener for editing
            taskItem.querySelector('.task-desc').addEventListener('click', function () {
                openTaskModalForEdit(index);
            });
        });
    
        // Update the task count
        taskCount.textContent = tasks.length; // Update the number of tasks
    }
    
    // Function to open the task modal for editing
    function openTaskModalForEdit(taskIndex) {
        const task = tasks[taskIndex]; // Get the selected task
    
        // Populate modal fields with task data
        taskDescriptionInput.value = task.description;
        taskAssignedInput.value = task.assignedTo;
        document.getElementById('taskCategory').value = task.category;
        taskDateButtons.forEach(button => {
            if (button.textContent === task.dueDate) {
                button.classList.add('selected');
            } else {
                button.classList.remove('selected');
            }
        });
        taskReminderButtons.forEach(button => {
            if (button.textContent === task.reminder) {
                button.classList.add('selected');
            } else {
                button.classList.remove('selected');
            }
        });
        taskPriorityButtons.forEach(button => {
            if (button.textContent === task.priority) {
                button.classList.add('selected');
            } else {
                button.classList.remove('selected');
            }
        });
        taskFlagInput.checked = task.flag === 'Flagged';
    
        // Show the modal
        document.getElementById('taskModal').style.display = 'flex';
        isEditing = true;
        taskIndexToEdit = taskIndex;
    
        // Show delete button
        deleteBtn.style.display = 'block';
    
        // Change the button text to "Update Task"
        document.querySelector('.create-btn').textContent = 'Update Task';
    }
    
    // Function to update the task with the modified data
   // Function to update the task in the database and array
   function updateTask(taskIndex) {
    // Update task with new data from modal
    const description = taskDescriptionInput.value;
    const assignedTo = taskAssignedInput.value;
    const dueDate = Array.from(taskDateButtons).find(button => button.classList.contains('selected'))?.textContent || '-';
    const reminder = Array.from(taskReminderButtons).find(button => button.classList.contains('selected'))?.textContent || '-';
    const priority = Array.from(taskPriorityButtons).find(button => button.classList.contains('selected'))?.textContent || '-';
    const flag = taskFlagInput.checked ? 'Flagged' : 'Not Flagged';

    const task = {
        id: tasks[taskIndex].id, // Keep the task's ID to update the correct task
        description: description,
        assignedTo: assignedTo,
        dueDate: dueDate,
        reminder: reminder,
        priority: priority,
        flag: flag
    };

    // Send the updated task to the server to update it in the database
    fetch('../Controllers/taskcontroller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'update', // Action is "update"
            task: task
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            tasks[taskIndex] = task; // Update the task in the array
            clearTaskModal();
            displayTasks(); // Re-display tasks
        } else {
            alert('Error updating task: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Function to delete the task from the database and array
function deleteTask(taskIndex) {
    // Send a request to delete the task from the backend
    fetch('../Controllers/taskcontroller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'delete',
            taskIndex: taskIndex
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Task deleted successfully!');
            tasks.splice(taskIndex, 1); // Remove task from the array
            clearTaskModal();
            displayTasks(); // Re-display tasks
        } else {
            alert('Error deleting task: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    
    // Attach delete button functionality
    deleteBtn.addEventListener('click', function () {
        deleteTask(taskIndexToEdit); // Delete the task at the current index
    });
    
    
    
    function toggleTaskCompletion(index) {
    tasks[index].completed = !tasks[index].completed; // Toggle the completion status
    displayTasks(); // Re-render the tasks
    }
    
    // When "Create Task" button is clicked
    
    
    // Show task content when "Tasks" button is clicked
    document.getElementById('tasksBtn').addEventListener('click', function() {
    hideHomeContent();
    document.getElementById('mainContent').style.display = 'none';
    document.getElementById('taskContent').style.display = 'block';
    displayTasks(); // Display the tasks when the Tasks button is clicked
    });
    
    // Function to hide home content
    function hideHomeContent() {
    document.getElementById('homeContent').style.display = 'none';
    }
    
    // Show task modal when +Task button is clicked
    document.getElementById('taskbtn').addEventListener('click', function() {
    const taskModal = document.getElementById('taskModal');
    taskModal.style.display = 'flex'; // Show the task modal when the button is clicked
    });
    
    // Hide task modal when Cancel button is clicked
    document.querySelector('.cancel-btn').addEventListener('click', function() {
    const taskModal = document.getElementById('taskModal');
    taskModal.style.display = 'none'; // Hide the task modal when the Cancel button is clicked
    });
    
    document.getElementById('newTaskBtn').addEventListener('click', function() {
    const taskModal = document.getElementById('taskModal');
    taskModal.style.display = 'flex'; // Show the task modal when the button is clicked
    });
    
    
    
    
    
    
    
    
    
    
    
    // Function to hide the homeContent
    function hideHomeContent() {
    document.getElementById('homeContent').style.display = 'none';
    }
    
    // Show main content (toolbar + note editor) when +Note button is clicked
    document.getElementById('noteBtn').addEventListener('click', function() {
    const mainContent = document.getElementById('mainContent');
    hideHomeContent(); // Hide home content
    mainContent.style.display = 'block'; // Show the main content when +Note is clicked
    });
    
    // Show task modal when +Task button is clicked
    document.getElementById('taskbtn').addEventListener('click', function() {
    const taskModal = document.getElementById('taskModal');
    
    taskModal.style.display = 'flex'; // Show the task modal when the button is clicked
    });
    
    // Hide task modal when Cancel button is clicked
    document.querySelector('.cancel-btn').addEventListener('click', function() {
    const taskModal = document.getElementById('taskModal');
    taskModal.style.display = 'none'; // Hide the task modal when the Cancel button is clicked
    });
    
    // Show event modal when +Event button is clicked
    document.getElementById('eventbtn').addEventListener('click', function () {
    const eventModal = document.getElementById('eventModal');
    hideHomeContent(); // Hide home content
    eventModal.style.display = 'flex'; // Show event modal
    });
    
    // Hide event modal when Cancel button is clicked
    document.querySelector('.cancel-event-btn').addEventListener('click', function () {
    const eventModal = document.getElementById('eventModal');
    eventModal.style.display = 'none'; // Hide event modal
    });
    
    // Handle creating the event
    document.querySelector('.create-event-btn').addEventListener('click', function () {
    const title = document.getElementById('eventTitle').value;
    const start = document.getElementById('eventStart').value;
    const end = document.getElementById('eventEnd').value;
    
    if (title && start && end) {
    console.log(`Event Created: ${title}, Start: ${start}, End: ${end}`);
    alert(`Event "${title}" created successfully!`);
    
    document.getElementById('eventModal').style.display = 'none';
    } else {
    alert('Please fill all the fields.');
    }
    });
    
    // Show home content when Home button is clicked
    document.getElementById('homeBtn').addEventListener('click', function() {
    // Hide all other sections (e.g., taskModal, eventModal, etc.)
    document.getElementById('taskModal').style.display = 'none';
    document.getElementById('eventModal').style.display = 'none';
    document.getElementById('mainContent').style.display = 'none';
    
    // Show the home content
    document.getElementById('homeContent').style.display = 'block';
    });
    
    // Load Home page content by default on page refresh
    window.onload = function() {
    // Show home content by default
    document.getElementById('homeContent').style.display = 'block';
    };
    
    // Show main content (toolbar + note editor) when +Note button is clicked
    document.getElementById('noteBtn').addEventListener('click', function() {
        const mainContent = document.getElementById('mainContent');
        mainContent.style.display = 'block'; // Show the main content when +Note is clicked
    });
    
    // Function to execute document commands for formatting
    function execCmd(command, value = null) {
        document.execCommand(command, false, value);
    }
    
    // Placeholder logic for contenteditable elements
    document.querySelectorAll('[contenteditable]').forEach(function(editable) {
        // Display the custom placeholder
        function showPlaceholder() {
            if (editable.textContent.trim() === '') {
                editable.classList.add('empty');
                editable.innerText = editable.getAttribute('data-placeholder');
            }
        }
    
        // Remove placeholder on focus
        function hidePlaceholder() {
            if (editable.classList.contains('empty')) {
                editable.classList.remove('empty');
                editable.innerText = ''; // Clear the placeholder
            }
        }
    
        editable.addEventListener('focus', hidePlaceholder);
        editable.addEventListener('blur', showPlaceholder);
        editable.addEventListener('input', function() {
            if (editable.textContent.trim() !== '') {
                editable.classList.remove('empty');
            }
        });
    
        // Initially show placeholder
        showPlaceholder();
    });
    
    // Show event modal when +Event button is clicked
    document.getElementById('eventbtn').addEventListener('click', function () {
    const eventModal = document.getElementById('eventModal');
    eventModal.style.display = 'flex'; // Show event modal
    });
    
    // Hide event modal when Cancel button is clicked
    document.querySelector('.cancel-event-btn').addEventListener('click', function () {
    const eventModal = document.getElementById('eventModal');
    eventModal.style.display = 'none'; // Hide event modal
    });
    
    // Handle creating the event
    document.querySelector('.create-event-btn').addEventListener('click', function () {
    const title = document.getElementById('eventTitle').value;
    const start = document.getElementById('eventStart').value;
    const end = document.getElementById('eventEnd').value;
    
    if (title && start && end) {
    // For now, log the event details (you can integrate with your calendar view)
    console.log(`Event Created: ${title}, Start: ${start}, End: ${end}`);
    alert(`Event "${title}" created successfully!`);
    
    // Hide the event modal
    document.getElementById('eventModal').style.display = 'none';
    } else {
    alert('Please fill all the fields.');
    }
    });
    
    // Show home content when Home button is clicked
    document.getElementById('homeBtn').addEventListener('click', function() {
    // Hide all other sections (e.g., taskModal, eventModal, etc.)
    document.getElementById('taskModal').style.display = 'none';
    document.getElementById('eventModal').style.display = 'none';
    document.getElementById('mainContent').style.display = 'none';
    document.getElementById('taskContent').style.display = 'none';
    // Show the home content
    document.getElementById('homeContent').style.display = 'block';
    });
    
    // Load Home page content by default on page refresh
    window.onload = function() {
    // Show home content by default
    document.getElementById('homeContent').style.display = 'block';
    };
    
    document.getElementById('searchTask').addEventListener('input', function () {
    filterTasks();
    });
    
    
    
    
    // Event listener for sorting dropdown
    document.getElementById('sortBtn').addEventListener('click', function() {
        const sortBy = document.getElementById('sortBy').value; // Get the selected sort criterion
    
        if (sortBy === 'priority') {
            sortTasksByPriority(); // Sort by priority (High to Low)
        } else if (sortBy === 'deadline') {
            sortTasksByDeadline(); // Sort by deadline (Latest to Earliest)
        }
    });
    
    // Function to sort tasks by priority (High to Low)
    function sortTasksByPriority() {
        tasks.sort((a, b) => {
            const priorityOrder = { "High": 3, "Medium": 2, "Low": 1 };
            return priorityOrder[b.priority] - priorityOrder[a.priority]; // Always sort High to Low
        });
        displayTasks(); // Re-display tasks after sorting
    }
    
    // Function to sort tasks by deadline (Latest to Earliest)
    function sortTasksByDeadline() {
        tasks.sort((a, b) => {
            const dateA = new Date(a.dueDate);
            const dateB = new Date(b.dueDate);
            return dateB - dateA; // Always sort Latest to Earliest
        });
        displayTasks(); // Re-display tasks after sorting
    }
    
    
    
    
    document.getElementById('customDateBtn').addEventListener('click', function () {
        // Show the hidden input field for the date picker
        document.getElementById('customDateInput').style.display = 'block';
    
        // Initialize the Flatpickr date picker on the input field
        flatpickr("#customDateInput", {
            enableTime: true, // Enable time selection if needed
            dateFormat: "Y-m-d H:i", // Date format (Y: Year, m: Month, d: Day, H:i: Time)
            onClose: function(selectedDates, dateStr, instance) {
                // When the user selects a date, hide the input and fill the selected date in the button
                document.getElementById('customDateInput').style.display = 'none';
                document.getElementById('customDateBtn').textContent = dateStr; // Set the date in the button text
            }
        });
    
        // Automatically open the date picker when the button is clicked
        document.getElementById('customDateInput')._flatpickr.open();
    });
    document.getElementById('customDateBtn').addEventListener('click', function() {
        document.getElementById('customDateInput').style.display = 'block'; // Show the input field
        document.getElementById('customDateInput').focus(); // Automatically focus the input
    });
    
    document.getElementById('customDateInput').addEventListener('change', function() {
        // When the user selects a date, hide the input and fill the selected date in the button
        document.getElementById('customDateInput').style.display = 'none';
        document.getElementById('customDateBtn').textContent = this.value; // Set the selected date in the button text
    });
    
    document.getElementById('customReminderBtn').addEventListener('click', function () {
        // Show the hidden input field for the date picker
        document.getElementById('customReminderInput').style.display = 'block';
    
        // Initialize the Flatpickr date picker on the input field
        flatpickr("#customReminderInput", {
            enableTime: true, // Enable time selection
            dateFormat: "Y-m-d H:i", // Date and time format
            defaultDate: new Date(), // Default to current date
            onClose: function(selectedDates, dateStr, instance) {
                // When the user selects a date, hide the input and fill the selected date in the button
                document.getElementById('customReminderInput').style.display = 'none';
                document.getElementById('customReminderBtn').textContent = dateStr; // Set the date in the button text
            }
        });
    
        // Automatically open the date picker when the button is clicked
        document.getElementById('customReminderInput')._flatpickr.open();
    });
    
    
    // IEFE
    (() => { 
        // state variables
        let toDoListArray = [];
        // ui variables
        const form = document.querySelector(".form"); 
        const input = form.querySelector(".form__input");
        const ul = document.querySelector(".toDoList"); 
      
        // event listeners
        form.addEventListener('submit', e => {
          // prevent default behaviour - Page reload
          e.preventDefault();
          // give item a unique ID
          let itemId = String(Date.now());
          // get/assign input value
          let toDoItem = input.value;
          //pass ID and item into functions
          addItemToDOM(itemId , toDoItem);
          addItemToArray(itemId, toDoItem);
          // clear the input box. (this is default behaviour but we got rid of that)
          input.value = '';
        });
        
        ul.addEventListener('click', e => {
          let id = e.target.getAttribute('data-id')
          if (!id) return // user clicked in something else      
          //pass id through to functions
          removeItemFromDOM(id);
          removeItemFromArray(id);
        });
        
        // functions 
        function addItemToDOM(itemId, toDoItem) {    
          // create an li
          const li = document.createElement('li')
          li.setAttribute("data-id", itemId);
          // add toDoItem text to li
          li.innerText = toDoItem
          // add li to the DOM
          ul.appendChild(li);
        }
        
        function addItemToArray(itemId, toDoItem) {
          // add item to array as an object with an ID so we can find and delete it later
          toDoListArray.push({ itemId, toDoItem});
          console.log(toDoListArray)
        }
        
        function removeItemFromDOM(id) {
          // get the list item by data ID
          var li = document.querySelector('[data-id="' + id + '"]');
          // remove list item
          ul.removeChild(li);
        }
        
        function removeItemFromArray(id) {
          // create a new toDoListArray with all li's that don't match the ID
          toDoListArray = toDoListArray.filter(item => item.itemId !== id);
          console.log(toDoListArray);
        }
        
      })();
    flatpickr("#customReminderInput", {
        enableTime: true,
        noCalendar: false,  // Ensure the calendar is shown
        dateFormat: "Y-m-d H:i K",  // 'K' adds the AM/PM option
        time_24hr: false,  // Switch to 12-hour format with AM/PM
        onClose: function(selectedDates, dateStr, instance) {
            document.getElementById('customReminderInput').style.display = 'none';
            document.getElementById('customReminderBtn').textContent = dateStr;
        }
    });