<?php
include '../model/mydb.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve the patient name from GET request
$patientName = $_GET['patientName'] ?? '';  // Use null coalescing operator to avoid undefined index notice

// Check if the patientName is set in the URL to prevent errors
if (empty($patientName)) {
    echo "No patient name provided!";
    exit;
}

// Create a database connection
$mydb = new mydb();
$conn = $mydb->createConObject();
$table = "appointments";  // Use your actual table name

// Fetch pending appointments for the patient
$today = date("Y-m-d");
$condition = "appointment_date >= '$today' AND patient_name = '$patientName'";
$pendingAppointments = $mydb->showAppointments($conn, $table, $condition);

// Fetch past appointments for the patient
$condition = "appointment_date < '$today' AND patient_name = '$patientName'";
$pastAppointments = $mydb->showAppointments($conn, $table, $condition);

$mydb->closeCon($conn); // Close the connection
?>

<html>
<body>
<h2>Patient Dashboard for <?php echo htmlspecialchars($patientName); ?></h2>

<!-- Display pending appointments -->
<h3>Pending Appointments</h3>
<?php if ($pendingAppointments && $pendingAppointments->num_rows > 0) { ?>
    <p>Found <?php echo $pendingAppointments->num_rows; ?> pending appointments.</p>
    <table border="1">
        <tr>
            <th>Appointment ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $pendingAppointments->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['appointment_date']; ?></td>
            <td><?php echo $row['appointment_time']; ?></td>
            <td>
                <form action="../control/cancelAppointControl.php" method="POST" style="display:inline;">
                    <input type="hidden" name="appointmentId" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="cancel">Cancel</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No pending appointments.</p>
<?php } ?>

<!-- Display past appointments -->
<h3>Past Appointments</h3>
<?php if ($pastAppointments && $pastAppointments->num_rows > 0) { ?>
    <table border="1">
        <tr>
            <th>Appointment ID</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php while ($row = $pastAppointments->fetch_assoc()) { ?>
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
<form action="updateAppointments.php?patientName=<?php echo urlencode($patientName); ?>" method="POST">
    <label for="appointmentId">Appointment ID:</label>
    <input type="text" id="appointmentId" name="appointmentId" placeholder="Enter appointment ID" required>

    <label for="appointmentDate">New Appointment Date:</label>
    <input type="date" id="appointmentDate" name="appointmentDate" required>

    <label for="appointmentTime">New Appointment Time:</label>
    <input type="time" id="appointmentTime" name="appointmentTime" required>

    <button type="submit" name="update">Update Appointment</button>
</form>

</body>
</html>
