<?php
include '../model/mydb.php';

$mydb = new mydb();
$conn = $mydb->createConObject();
$table = "appointments";
$patientId = $_GET['patientId']; // Assuming patientId is passed via GET

$today = date("Y-m-d");
$condition = "appointment_date < '$today' AND patient_id = '$patientId'";
$result = $mydb->showAppointments($conn, $table, $condition);

echo "<h2>Past Appointments</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Patient: " . $row["patient_name"] . " - Doctor: " . $row["doctor_name"] . " - Date: " . $row["appointment_date"] . " - Time: " . $row["appointment_time"] . " - Reason: " . $row["reason"] . "<br>";
    }
} else {
    echo "No past appointments found.<br>";
}

$mydb->closeCon($conn);
?>
