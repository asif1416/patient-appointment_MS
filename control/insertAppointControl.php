<?php
require '../model/mydb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Log the received data for debugging

    $patientName = $_POST['patientName'];
    $doctorName = $_POST['doctorName'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $reason = $_POST['reason'];

    $mydb = new mydb();
    $conn = $mydb->createConObject();
    $table = 'appointments';

    // Insert the appointment
    $result = $mydb->insertAppointment($conn, $table, $patientName, $doctorName, $appointmentDate, $appointmentTime, $reason);

    $mydb->closeCon($conn);
} 
?>
