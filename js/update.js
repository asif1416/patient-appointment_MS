document.getElementById('updateAppointmentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const appointmentId = document.getElementById('appointmentId').value;
    const appointmentDate = document.getElementById('appointmentDate').value;
    const appointmentTime = document.getElementById('appointmentTime').value;

    // Prepare the AJAX request
    const xhr = new XMLHttpRequest();
    const url = '../control/updateAppointments.php'; // The PHP file to handle the update
    const params = `appointmentId=${appointmentId}&appointmentDate=${appointmentDate}&appointmentTime=${appointmentTime}&patientName=${encodeURIComponent('<?php echo $patientName; ?>')}`;

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define the callback function
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            const response = xhr.responseText;
            document.getElementById('updateResponse').innerHTML = response;

            // Check if the update was successful
            if (xhr.status === 200 && response.includes("successfully")) {
                updateTableRow(appointmentId, appointmentDate, appointmentTime);
            }
        }
    };

    // Send the request with parameters
    xhr.send(params);
});

// Function to update the table row
function updateTableRow(appointmentId, appointmentDate, appointmentTime) {
    const row = document.getElementById("row-" + appointmentId);
    if (row) {
        row.cells[1].innerHTML = appointmentDate; // Update the date
        row.cells[2].innerHTML = appointmentTime; // Update the time
    }
}
