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

fetch('../php/edit-user.php', {
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

fetch('../php/edit-user.php', {
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
    fetch('../php/delete-user.php', {
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