<?php
include '../model/mydb.php';

$appointmentDateMsg = "";
$appointmentTimeMsg = "";
$hasError = 0;

if (isset($_POST["update"])) {
    // Validate Appointment Date
    if (empty($_POST["appointmentDate"])) {
        $appointmentDateMsg = "Appointment Date must not be empty";
        $hasError = 1;
    } else {
        $appointmentDateMsg = "Appointment Date: " . $_POST["appointmentDate"] . "<br>";
    }

    // Validate Appointment Time
    if (empty($_POST["appointmentTime"])) {
        $appointmentTimeMsg = "Appointment Time must not be empty";
        $hasError = 1;
    } else {
        $appointmentTimeMsg = "Appointment Time: " . $_POST["appointmentTime"] . "<br>";
    }

    // If there are no errors, update the appointment date and time in the database
    if ($hasError == 0) {
        $mydb = new mydb();
        $conn = $mydb->createConObject();
        $table = "appointments"; // Specify the table name

        // Get the appointment ID from the form
        $id = $_POST["appointmentId"];

        // Update the appointment in the database
        $update = $mydb->updateAppointmentDateAndTime(
            $conn,
            $table,
            $id,
            $_POST["appointmentDate"],
            $_POST["appointmentTime"]
        );

        if ($update) {
            echo "Appointment date and time updated successfully!";
        } else {
            echo "Failed to update appointment.";
        }

        $mydb->closeCon($conn); // Close the connection
    } else {
        echo "**Please fill up the required fields**";
    }
}
?>
