function formValidation() {
  document.getElementById("patientNameError").innerHTML = "";
  document.getElementById("appointmentDateError").innerHTML = "";
  document.getElementById("appointmentTimeError").innerHTML = "";
  document.getElementById("reasonError").innerHTML = "";

  var isValid = true;

  if (!checkPatientName()) {
    isValid = false;
  }
  if (!checkAppointmentDate()) {
    isValid = false;
  }
  if (!checkAppointmentTime()) {
    isValid = false;
  }
  if (!checkReason()) {
    isValid = false;
  }

  return isValid;
}

function checkPatientName() {
  var patientName = document.getElementById("patientName").value;
  if (patientName == "") {
    document.getElementById("patientNameError").innerHTML = "Patient name is required.";
    return false;
  }
  return true;
}

function checkAppointmentDate() {
  var appointmentDate = document.getElementById("appointmentDate").value;
  if (appointmentDate == "") {
    document.getElementById("appointmentDateError").innerHTML = "Appointment date is required.";
    return false;
  }
  return true;
}

function checkAppointmentTime() {
  var appointmentTime = document.getElementById("appointmentTime").value;
  if (appointmentTime == "") {
    document.getElementById("appointmentTimeError").innerHTML = "Appointment time is required.";
    return false;
  }
  return true;
}

function checkReason() {
  var reason = document.getElementById("reason").value;
  if (reason == "") {
    document.getElementById("reasonError").innerHTML = "Reason for appointment is required.";
    return false;
  }
  return true;
}

function submitForm(event) {
  event.preventDefault();

  if (!formValidation()) {
      return false;
  }

  var formData = document.getElementById('appointmentForm');

  var xhttp = new XMLHttpRequest();
  
  xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById('show').innerHTML = this.responseText;
      }
  };

  xhttp.open("POST", "../control/insertAppointControl.php", true);
  xhttp.send(formData);
}