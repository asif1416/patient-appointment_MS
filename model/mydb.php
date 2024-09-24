<?php
class mydb {
    public $DBHostName = "";
    public $DBUserName = "";
    public $DBPassword = "";
    public $DBName = "";

    function __construct() {
        $this->DBHostName = "localhost";
        $this->DBUserName = "root";
        $this->DBPassword = "";
        $this->DBName = "mydb";  
    }

    function createConObject() {
        return new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);
    }

    function closeCon($conn) {
        $conn->close();
    }

    // Insert appointment
    function insertAppointment($conn, $table, $patient_name, $doctor_name, $appointment_date, $appointment_time, $reason) {
        $query = "INSERT INTO $table (patient_name, doctor_name, appointment_date, appointment_time, reason) 
                  VALUES ('$patient_name', '$doctor_name', '$appointment_date', '$appointment_time', '$reason')";
        $result = $conn->query($query);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Show appointments by condition
    function showAppointments($conn, $table, $condition) {
        $query = "SELECT * FROM $table WHERE $condition";
        $result = $conn->query($query);
        return $result;
    }

    // Update an appointment by ID
    function updateAppointmentDateAndTime($conn, $table, $id, $appointment_date, $appointment_time) {
        $query = "UPDATE $table SET 
                  appointment_date = '$appointment_date', 
                  appointment_time = '$appointment_time'
                  WHERE id = $id";

        return $conn->query($query) === TRUE;
    }

    // Delete appointment by ID
    function deleteAppointment($conn, $table, $id) {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);  // Bind the appointment ID as an integer

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();  // Close the prepared statement
    }
}
?>
