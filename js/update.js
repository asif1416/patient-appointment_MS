document.getElementById('updateAppointmentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    document.getElementById('appointmentIdError').innerHTML = '';
    document.getElementById('appointmentDateError').innerHTML = '';
    document.getElementById('appointmentTimeError').innerHTML = '';

    let isValid = true;

    // Validate Appointment ID
    const appointmentId = document.getElementById('appointmentId').value;
    if (appointmentId.trim() === "") {
        document.getElementById('appointmentIdError').innerHTML = "Appointment ID is required.";
        isValid = false;
    }

    // Validate Appointment Date
    const appointmentDate = document.getElementById('appointmentDate').value;
    if (appointmentDate.trim() === "") {
        document.getElementById('appointmentDateError').innerHTML = "Appointment date is required.";
        isValid = false;
    }

    // Validate Appointment Time
    const appointmentTime = document.getElementById('appointmentTime').value;
    if (appointmentTime.trim() === "") {
        document.getElementById('appointmentTimeError').innerHTML = "Appointment time is required.";
        isValid = false;
    }

    // If the form is valid, proceed with the AJAX request
    if (isValid) {
        const xhttp = new XMLHttpRequest();
        const url = '../control/updateAppointments.php'; 
        const params = `appointmentId=${appointmentId}&appointmentDate=${appointmentDate}&appointmentTime=${appointmentTime}&patientName=${encodeURIComponent('<?php echo $patientName; ?>')}`;

        xhttp.open('POST', url, true);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4) {
                const response = xhttp.responseText;

                if (xhttp.status === 200) {
                    updateTableRow(appointmentId, appointmentDate, appointmentTime);
                    alert("Appointment updated successfully!");
                    location.reload();
                } else {
                    alert("Error updating appointment: " + response);
                }
            }
        };

        xhttp.send(params);
    }
});

// Function to update the table row
function updateTableRow(appointmentId, appointmentDate, appointmentTime) {
    const row = document.getElementById("row-" + appointmentId);
    if (row) {
        row.cells[1].innerHTML = appointmentDate; // Update the date
        row.cells[2].innerHTML = appointmentTime; // Update the time
    }
}
