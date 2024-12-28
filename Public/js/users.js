
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
   
    
    // Get references to the task fields
    const taskDescriptionInput = document.querySelector('textarea');
    const taskDateButtons = document.querySelectorAll('.task-date-options button');
    const taskReminderButtons = document.querySelectorAll('.task-reminder-options button');
    const taskPriorityButtons = document.querySelectorAll('.task-priority-options button');
    const taskAssignedInput = document.querySelector('input[placeholder="Assign"]');
    const taskFlagInput = document.querySelector('input[type="checkbox"]');
    const deleteBtn = document.querySelector('.delete-btn'); // Reference to the delete button
    
    // Attach a single event listener for the "Create Task" button
   
    
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
    
    
  
  
    
    
    function toggleTaskCompletion(index) {
    tasks[index].completed = !tasks[index].completed; // Toggle the completion status
    // Re-render the tasks
    }
    
   
    
    // Show task content when "Tasks" button is clicked
    document.getElementById('tasksBtn').addEventListener('click', function() {
    hideHomeContent();
    document.getElementById('mainContent').style.display = 'none';
    document.getElementById('taskContent').style.display = 'block';
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
         // Re-display tasks after sorting
    }
    
    // Function to sort tasks by deadline (Latest to Earliest)
    function sortTasksByDeadline() {
        tasks.sort((a, b) => {
            const dateA = new Date(a.dueDate);
            const dateB = new Date(b.dueDate);
            return dateB - dateA; // Always sort Latest to Earliest
        });
        // Re-display tasks after sorting
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