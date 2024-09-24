<?php
require '../control/insertAppointControl.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Form</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>

<h2>Doctor Appointment Form</h2>

<form action="#" method="POST">
    <label for="patientName">Patient Name:</label>
    <input type="text" id="patientName" name="patientName" placeholder="Your name..">

    <label for="doctorName">Doctor Name:</label>
    <select id="doctorName" name="doctorName">
        <option value="Dr. John Doe">Dr. John Doe</option>
        <option value="Dr. Jane Smith">Dr. Jane Smith</option>
        <option value="Dr. Alex Johnson">Dr. Alex Johnson</option>
    </select>

    <label for="appointmentDate">Appointment Date:</label>
    <input type="date" id="appointmentDate" name="appointmentDate">

    <label for="appointmentTime">Appointment Time:</label>
    <input type="time" id="appointmentTime" name="appointmentTime">

    <label for="reason">Reason for Appointment:</label>
    <textarea id="reason" name="reason"></textarea>

    <!-- Add a name attribute to the button -->
    <button type="submit" name="Submit">Book Appointment</button>
</form>


</body>
</html>
