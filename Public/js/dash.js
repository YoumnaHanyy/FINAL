document.getElementById('generateReportBtn').onclick = function () {
    document.getElementById('reportModal').style.display = 'flex';
}

// Close the modal
function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
}

// Handle form submission
document.getElementById('reportForm').onsubmit = function (e) {
    e.preventDefault();
    alert('Report generated successfully!');
    closeModal();
}


function showAllUsers() {
    const hiddenRows = document.querySelectorAll('.hidden');
    hiddenRows.forEach(row => row.classList.remove('hidden'));
    document.getElementById('view-all-btn').style.display = 'none'; // Hide the 'View All' button after clicking
}

function updateUserRow(formData) {
const oldUsername = formData.get('old_username');
const newUsername = formData.get('new_username');
const email = formData.get('email');
const password = formData.get('password');

const rows = document.querySelectorAll('tbody tr');
rows.forEach(row => {
    const usernameCell = row.cells[0];
    if (usernameCell.innerText === oldUsername) {
        usernameCell.innerText = newUsername;
        row.cells[1].innerText = email;
        row.cells[2].innerText = password;
    }
});
}

// Function to open the modal with the selected user's data
function openEditModal(username, email, password) {
document.getElementById('modal_old_username').value = username;
document.getElementById('modal_new_username').value = username;
document.getElementById('modal_email').value = email;
document.getElementById('modal_password').value = password;
document.getElementById('editModal').style.display = 'flex'; // Show the modal
}

// Close modal function
function closeEditModal() {
document.getElementById('editModal').style.display = 'none';
document.getElementById('success-message').style.display = 'none';
document.getElementById('error-message').style.display = 'none';

}

/************** */
document.getElementById('edit-form').addEventListener('submit', function(event) {
event.preventDefault();
const formData = new FormData(this);

fetch('http://localhost/PROJECTFF/app/View/edit-user.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.status === 'error') {
                document.getElementById('error-message').style.display = 'block';
                document.getElementById('error-message').textContent = data.message;
                document.getElementById('success-message').style.display = 'none';
            } else {
                updateUserRow(formData); // Update the row visually
                document.getElementById('success-message').style.display = 'block';
                document.getElementById('success-message').textContent = data.message;
                document.getElementById('error-message').style.display = 'none';
                
            }
   
})
.catch(error => console.error('Error:', error));
}); 



document.getElementById('generateReportBtn').onclick = function () {
    document.getElementById('reportModal').style.display = 'flex';
}

// Close the modal
function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
}

// Handle form submission
document.getElementById('reportForm').onsubmit = function (e) {
    e.preventDefault();
    alert('Report generated successfully!');
    closeModal();
}


function showAllUsers() {
    const hiddenRows = document.querySelectorAll('.hidden');
    hiddenRows.forEach(row => row.classList.remove('hidden'));
    document.getElementById('view-all-btn').style.display = 'none'; // Hide the 'View All' button after clicking
}


document.querySelector(".toggle").addEventListener("click", function() {
document.querySelector(".navigation").classList.toggle("hidden");
document.body.classList.toggle("collapsed");
});


function updateUserRow(formData) {
const oldUsername = formData.get('old_username');
const newUsername = formData.get('new_username');
const email = formData.get('email');
const password = formData.get('password');

const rows = document.querySelectorAll('tbody tr');
rows.forEach(row => {
    const usernameCell = row.cells[0];
    if (usernameCell.innerText === oldUsername) {
        usernameCell.innerText = newUsername;
        row.cells[1].innerText = email;
        row.cells[2].innerText = password;
    }
});
}

// Function to open the modal with the selected user's data
function openEditModal(username, email, password) {
document.getElementById('modal_old_username').value = username;
document.getElementById('modal_new_username').value = username;
document.getElementById('modal_email').value = email;
document.getElementById('modal_password').value = password;
document.getElementById('editModal').style.display = 'flex'; // Show the modal
}

// Close modal function
function closeEditModal() {
document.getElementById('editModal').style.display = 'none';
document.getElementById('success-message').style.display = 'none';
document.getElementById('error-message').style.display = 'none';

}

/************** */
document.getElementById('edit-form').addEventListener('submit', function(event) {
event.preventDefault();
const formData = new FormData(this);

fetch('http://localhost/PROJECTFF/app/View/edit-user.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.status === 'error') {
                document.getElementById('error-message').style.display = 'block';
                document.getElementById('error-message').textContent = data.message;
                document.getElementById('success-message').style.display = 'none';
            } else {
                updateUserRow(formData); // Update the row visually
                document.getElementById('success-message').style.display = 'block';
                document.getElementById('success-message').textContent = data.message;
                document.getElementById('error-message').style.display = 'none';
                
            }
   
})
.catch(error => console.error('Error:', error));
});


let usernameToDelete = '';

function openDeleteConfirmModal(username) {
    usernameToDelete = username;
    document.getElementById('usernameToDeleteDisplay').innerText = username; // Display the username in the modal
    document.getElementById('deleteConfirmPopup').style.display = 'flex'; // Show the modal
}

document.getElementById('cancelDeleteBtn').onclick = function () {
    closeDeleteConfirmModal(); // Close the modal
};

document.getElementById('confirmDeleteBtn').onclick = function () {
    const confirmUsername = document.getElementById('confirmUsernameInput').value;
    if (confirmUsername === usernameToDelete) {
        deleteUser(usernameToDelete);
        closeDeleteConfirmModal(); // Close modal after deletion
    } else {
        document.getElementById('confirmUsernameInput').setCustomValidity("Please type the correct username to confirm deletion.");
        document.getElementById('confirmUsernameInput').reportValidity(); // Show validation message
    }
};

function closeDeleteConfirmModal() {
    document.getElementById('deleteConfirmPopup').style.display = 'none'; // Hide modal
}

function deleteUser(username) {
    fetch('http://localhost/PROJECTFF/app/View/delete-user.php', {
        method: 'POST',
        body: JSON.stringify({ username }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.querySelectorAll(`#user-table-body tr`).forEach(row => {
                if (row.cells[0].innerText === username) {
                    row.remove();
                }
            });
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function toggleUsersSection() {
    // Get the users section element
    const usersSection = document.getElementById('sh');
    const usSection = document.getElementById('aa');
    const uasSection = document.getElementById('ash');
    const SNSection = document.getElementById('SN');
    const SNNSSection = document.getElementById('SNNS');
  
    // Show the users section
    usersSection.style.display = 'grid';
    usSection.style.display = 'none';
    uasSection.style.display = 'none';
    SNSection.style.display='grid';
    SNNSSection.style.display='none';
}

function toggleUsersSection2() {
    // Get the users section element
    const usersSection = document.getElementById('sh');
    const usSection = document.getElementById('aa');
    const uasSection = document.getElementById('ash');
    const SNSection = document.getElementById('SN');
    const SNNSSection = document.getElementById('SNNS');
   
    // Show the users section
    usersSection.style.display = 'none';
    usSection.style.display = 'none';
    uasSection.style.display = 'grid';
    uasSection.style.marginLeft = '275px';
    uasSection.style.marginBottom = '50px';
    SNSection.style.display='none';
    SNNSSection.style.display='none';

}

function toggleUsersSection3() {
    // Get the users section element
    const usersSection = document.getElementById('sh');
    const usSection = document.getElementById('aa');
    const uasSection = document.getElementById('ash');
    const toggle1 = document.getElementById('toggleBtn');
    const SNSection = document.getElementById('SN');
    const SNNSSection = document.getElementById('SNNS');
   

    // Show the users section
    usersSection.style.display = 'none';
    usSection.style.display = 'grid';
    uasSection.style.display = 'none';
    toggle1.style.display='flex';
    SNSection.style.display='none';
    SNNSSection.style.display='none';

}

function toggleUsersSection4() {
    // Get the users section element
    const usersSection = document.getElementById('sh');
    const usSection = document.getElementById('aa');
    const uasSection = document.getElementById('ash');
    const toggle1 = document.getElementById('toggleBtn');
    const SNSection = document.getElementById('SN');
    const SNNSSection = document.getElementById('SNNS');
    
   

    // Show the users section
    usersSection.style.display = 'none';
    usSection.style.display = 'none';
    uasSection.style.display = 'none';
    toggle1.style.display='flex';
    SNSection.style.display='none';
    SNNSSection.style.display='grid';

    

}


if (data.status === 'success') {
    document.getElementById('add-success-message').style.display = 'block';
    document.getElementById('add-success-message').textContent = data.message;
    document.getElementById('add-error-message').style.display = 'none';

    // Delay closing modal to allow success message visibility
    setTimeout(() => closeAddModal(), 3000); // Adjust the delay as needed
} else {
    document.getElementById('add-error-message').style.display = 'block';
    document.getElementById('add-error-message').textContent = data.message;
    document.getElementById('add-success-message').style.display = 'none';
}








function filterTable() {
    // Get the search input value
    const searchInput = document.getElementById("searchInput").value.toLowerCase();

    // Get all table rows
    const table = document.getElementById("users2");
    const rows = table.getElementsByTagName("tr");

    // Loop through all rows, excluding the header row
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let match = false;

        // Check each cell in the row for a match
        for (let j = 0; j < cells.length; j++) {
            if (cells[j] && cells[j].innerText.toLowerCase().includes(searchInput)) {
                match = true;
                break;
            }
        }

         // Show or hide the row based on the match, and apply gradient color if matched
         if (match) {
            rows[i].style.display = "";
            rows[i].style.background = "linear-gradient(to right,rgb(105, 72, 72),rgb(70, 178, 193))";
        } else {
            rows[i].style.display = "none";
            rows[i].style.background = ""; // Reset background
        }
    }
}
