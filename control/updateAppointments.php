<?php
include '../model/mydb.php';

$appointmentDateMsg = "";
$appointmentTimeMsg = "";
$hasError = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'] ?? '';
    $appointmentDate = $_POST['appointmentDate'] ?? '';
    $appointmentTime = $_POST['appointmentTime'] ?? '';

    if (empty($appointmentDate)) {
        $appointmentDateMsg = "Appointment Date must not be empty";
        $hasError = 1;
    }

    if (empty($appointmentTime)) {
        $appointmentTimeMsg = "Appointment Time must not be empty";
        $hasError = 1;
    }

    if ($hasError == 0) {
        $mydb = new mydb();
        $conn = $mydb->createConObject();
        $table = "appointments";

        $update = $mydb->updateAppointmentDateAndTime($conn, $table, $appointmentId, $appointmentDate, $appointmentTime);

        if ($update) {
            echo "Appointment date and time updated successfully!";
        } else {
            echo "Failed to update appointment.";
        }

        $mydb->closeCon($conn); 
    } else {
        echo "**Please fill up the required fields**";
    }
}
?>
