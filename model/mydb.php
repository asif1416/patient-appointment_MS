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

    function updateAppointmentDateAndTime($conn, $table, $id, $appointment_date, $appointment_time) {
        $query = "UPDATE $table SET 
                  appointment_date = ?, 
                  appointment_time = ?
                  WHERE id = ?";
        
        $result = $conn->query($query);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Delete appointment by ID 
    function deleteAppointment($conn, $table, $id) {
        $query = "DELETE FROM $table WHERE id = ?";
        

        $result = $conn->query($query);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
