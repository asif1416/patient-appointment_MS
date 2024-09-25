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
        $conn = new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function closeCon($conn) {
        $conn->close();
    }


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
        return $conn->query($query);
    }

    // Update an appointment by ID using prepared statements
    function updateAppointmentDateAndTime($conn, $table, $id, $appointment_date, $appointment_time) {
        $query = "UPDATE $table SET 
                  appointment_date = ?, 
                  appointment_time = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $appointment_date, $appointment_time, $id);
        
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Delete appointment by ID using prepared statements
    function deleteAppointment($conn, $table, $id) {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);  // Bind the appointment ID as an integer

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>
