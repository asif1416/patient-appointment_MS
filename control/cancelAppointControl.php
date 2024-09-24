<?php
include '../model/mydb.php';

// Check if the appointment ID is set
if (isset($_POST['appointmentId'])) {
    $appointmentId = $_POST['appointmentId'];

    // Create a database connection
    $mydb = new mydb();
    $conn = $mydb->createConObject();
    $table = "appointments";  // Use your actual table name

    // Call the deleteAppointment method
    if ($mydb->deleteAppointment($conn, $table, $appointmentId)) {
        echo "Appointment canceled successfully.";
    } else {
        echo "Error canceling appointment.";
    }

    // Close the connection
    $mydb->closeCon($conn);
} else {
    echo "No appointment ID provided!";
}
?>
