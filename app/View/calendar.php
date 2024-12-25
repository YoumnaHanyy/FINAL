<?php include 'user.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="../../Public/css/users.css"> <!-- Optional custom styles -->
</head>
<body>
    <h1>My Calendar</h1>
    <div id="calendar"></div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize a calendar
        flatpickr("#calendar", {
            inline: true,
            dateFormat: "Y-m-d",
        });
    </script>
</body>
</html>
<script>
    fetch('user.php')
        .then(response => response.json())
        .then(data => {
            console.log(data); // Process the data
        })
        .catch(error => console.error('Error:', error));
</script>
