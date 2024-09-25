function formValidation() {
  // Clear previous error messages
  document.getElementById("patientNameError").innerHTML = "";
  document.getElementById("appointmentDateError").innerHTML = "";
  document.getElementById("appointmentTimeError").innerHTML = "";
  document.getElementById("reasonError").innerHTML = "";

  // Validate each field
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

  return isValid; // Return the overall validation result
}

function checkPatientName() {
  var patientName = document.getElementById("patientName").value;
  if (patientName == "") {
    document.getElementById("patientNameError").innerHTML =
      "Patient name is required.";
    return false;
  }
  return true;
}

function checkAppointmentDate() {
  var appointmentDate = document.getElementById("appointmentDate").value;
  if (appointmentDate == "") {
    document.getElementById("appointmentDateError").innerHTML =
      "Appointment date is required.";
    return false;
  }
  return true;
}

function checkAppointmentTime() {
  var appointmentTime = document.getElementById("appointmentTime").value;
  if (appointmentTime == "") {
    document.getElementById("appointmentTimeError").innerHTML =
      "Appointment time is required.";
    return false;
  }
  return true;
}

function checkReason() {
  var reason = document.getElementById("reason").value;
  if (reason == "") {
    document.getElementById("reasonError").innerHTML =
      "Reason for appointment is required.";
    return false;
  }
  return true;
}

function createAppointment() {
  var submit = document.getElementById("submit").value;
  var xttp = new XMLHttpRequest();

  xttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200)
      document.getElementById("show").innerHTML = this.responseText;
  };

  xttp.open("POST", "../control/insertAppointControl.php?search=" + order, true);
  xttp.send();
}

