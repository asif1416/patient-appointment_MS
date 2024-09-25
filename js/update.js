document.getElementById('updateAppointmentForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const appointmentId = document.getElementById('appointmentId').value;
    const appointmentDate = document.getElementById('appointmentDate').value;
    const appointmentTime = document.getElementById('appointmentTime').value;

    const xhttp = new XMLHttpRequest();
    const url = '../control/updateAppointments.php'; // The PHP file to handle the update
    const params = `appointmentId=${appointmentId}&appointmentDate=${appointmentDate}&appointmentTime=${appointmentTime}&patientName=${encodeURIComponent('<?php echo $patientName; ?>')}`;

    xhttp.open('POST', url, true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
        if (xhttp.readyState === 4) {
            const response = xhttp.responseText;
            document.getElementById('updateResponse').innerHTML = this.responseText;

            if (xhttp.status === 200 && response.includes("successfully")) {
                updateTableRow(appointmentId, appointmentDate, appointmentTime);
            }
        }
    };

    xhttp.send(params);
});

// Function to update the table row
function updateTableRow(appointmentId, appointmentDate, appointmentTime) {
    const row = document.getElementById("row-" + appointmentId);
    if (row) {
        row.cells[1].innerHTML = appointmentDate; // Update the date
        row.cells[2].innerHTML = appointmentTime; // Update the time
    }
}
