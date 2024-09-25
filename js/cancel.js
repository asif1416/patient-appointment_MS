function cancelAppointment(appointmentId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("cancelResponse").innerHTML = this.responseText;
            
            // Remove the row dynamically
            if (this.responseText.includes("successfully")) {
                var row = document.getElementById("row-" + appointmentId);
                row.parentNode.removeChild(row);
            }
        }
    };
    
    xhr.open("POST", "../control/cancelAppointControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("appointmentId=" + appointmentId);  
}
