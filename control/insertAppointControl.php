<?php
include '../model/mydb.php';

$patientNameMsg = "";
$doctorNameMsg = "";
$appointmentDateMsg = "";
$appointmentTimeMsg = "";
$reasonMsg = "";
$hasError = 0;

if (isset($_POST["Submit"])) {
    if (empty($_POST["patientName"])) {
        $patientNameMsg = "Patient Name must not be empty";
        $hasError = 1;
    }

    if (empty($_POST["doctorName"])) {
        $doctorNameMsg = "Please select a doctor";
        $hasError = 1;
    }

    if (empty($_POST["appointmentDate"])) {
        $appointmentDateMsg = "Appointment Date must not be empty";
        $hasError = 1;
    }

    if (empty($_POST["appointmentTime"])) {
        $appointmentTimeMsg = "Appointment Time must not be empty";
        $hasError = 1;
    }

    if (empty($_POST["reason"])) {
        $reasonMsg = "Please provide a reason for the appointment";
        $hasError = 1;
    }

    if ($hasError == 0) {
        $mydb = new mydb();
        $conn = $mydb->createConObject();  
        $table = "appointments";  

        $result = $mydb->insertAppointment($conn,$table,$_POST["patientName"],$_POST["doctorName"],$_POST["appointmentDate"],$_POST["appointmentTime"],$_POST["reason"]);

        if (!$result) {
            echo "Failed to create appointment.";
        } 

        $mydb->closeCon($conn); 
    } 
}
?>
