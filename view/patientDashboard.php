<?php
include '../model/mydb.php';

$patientName = $_GET['patientName'] ?? '';  

if (empty($patientName)) {
    echo "No patient name provided!";
    exit;
}

// Create a database connection
$mydb = new mydb();
$conn = $mydb->createConObject();
$table = "appointments";  

// Fetch pending appointments for the patient
$today = date("Y-m-d");
$condition = "appointment_date >= '$today' AND patient_name = '$patientName'";
$pendingAppointments = $mydb->showAppointments($conn, $table, $condition);

// Convert the result set to an array
$appointmentsArray = [];
if ($pendingAppointments && $pendingAppointments->num_rows > 0) {
    while ($row = $pendingAppointments->fetch_assoc()) {
        $appointmentsArray[] = $row; // Add each row to the array
    }
}

// Fetch past appointments for the patient
$condition = "appointment_date < '$today' AND patient_name = '$patientName'";
$pastAppointments = $mydb->showAppointments($conn, $table, $condition);

$mydb->closeCon($conn); 
?>

<html>
<link rel="stylesheet" type="text/css" href="../css/patientDashboard.css">

<body>
    <h2>Patient Dashboard for <?php echo $patientName; ?></h2>

    <!-- Pending appointments -->
    <h3>Pending Appointments</h3>
    <?php if (!empty($appointmentsArray)) { ?>
        <table border="1">
            <tr>
                <th>Appointment ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($appointmentsArray as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                    <td>
                        <form method="POST" class="cancelForm" id="cancelForm<?php echo $row['id']; ?>">
                            <button type="button" id="cancelBtn" onclick="cancelAppointment(<?php echo $row['id']; ?>)">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No pending appointments.</p>
    <?php } ?>
    <div id="cancelResponse"></div>

    <!-- Display past appointments -->
    <h3>Past Appointments</h3>
    <?php
    // Converting to an array
    $pastAppointmentsArray = [];
    if ($pastAppointments && $pastAppointments->num_rows > 0) {
        // Fetching all rows into an array
        $pastAppointmentsArray = $pastAppointments->fetch_all(MYSQLI_ASSOC);
    }
    ?>

    <?php if (!empty($pastAppointmentsArray)) { ?>
        <table border="1">
            <tbody>
            <tr>
                <th>Appointment ID</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            </tbody>
            <?php foreach ($pastAppointmentsArray as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No past appointments.</p>
    <?php } ?>



    <!-- Form to update appointment details -->
    <h2>Update Appointment</h2>
    <form id="updateAppointmentForm"> <!-- Updated to include an ID -->
        <label for="appointmentId">Appointment ID:</label>
        <input type="text" id="appointmentId" name="appointmentId" placeholder="Enter appointment ID" required>

        <label for="appointmentDate">New Appointment Date:</label>
        <input type="date" id="appointmentDate" name="appointmentDate" required>

        <label for="appointmentTime">New Appointment Time:</label>
        <input type="time" id="appointmentTime" name="appointmentTime" required>

        <button type="submit">Update Appointment</button> <!-- Removed name attribute -->
    </form>
    <div id="updateResponse"></div>


    <script src="../js/cancel.js"></script>
    <script src="../js/update.js"></script>
</body>

</html>