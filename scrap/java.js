function copyPreAddress() {
    var presentAddress = document.getElementById("Presentaddress").value;
    document.getElementById("permanentaddress").value = presentAddress;
  }
   function convertToLower() {
    var input = document.getElementById('email');
    input.value = input.value.toLowerCase(); 
  }

  function validateAge() {
    var dob = document.getElementById('DateOfBirth').value;
    var dobDate = new Date(dob);
    var today = new Date();
    var age = today.getFullYear() - dobDate.getFullYear();
          if (today.getMonth() < dobDate.getMonth() || 
        (today.getMonth() == dobDate.getMonth() && today.getDate() < dobDate.getDate())) {
      age--;
    }
          if (age < 18) {
      alert('You must be 18 years or older.');
      document.getElementById('DateOfBirth').value = '';
    }
  }

  function convertToUpper() {
    var input = document.getElementById('pancard');
    input.value = input.value.toUpperCase();
    
  }
    function formatAadharInput() {
        var input = document.getElementById('aadhar');
        var trimmed = input.value.replace(/\s+/g, ''); 
        var formatted = trimmed.replace(/(\d{4})(?=\d)/g, '$1 '); 
        input.value = formatted;
    }
    function restrictInput(event) {
        var charCode = event.which || event.keyCode;
        if (charCode < 48 || charCode > 57) { 
            event.preventDefault();
        }
    }
    
    

  function collgedata() {
      var selectBox = document.getElementById("HighestEducation");
      var selectedValue = selectBox.options[selectBox.selectedIndex].value;
      var collegeNameDiv = document.getElementById("collegeNameDiv");
      var yearOfPassoutDiv = document.getElementById("yearOfPassoutDiv");
      var stream = document.getElementById("stream");
      var percentage = document.getElementById("percentage");

      if (selectedValue === "B.Tech" || selectedValue === "Degree" || selectedValue === "Diploma") {
          collegeNameDiv.style.display = "block";
          yearOfPassoutDiv.style.display = "block";
          stream.style.display = "block";
          percentage.style.display = "block";
      } else {
          collegeNameDiv.style.display = "none";
          yearOfPassoutDiv.style.display = "none";
          stream.style.display = "none";
          percentage.style.display = "none";
      }
  }

document.addEventListener('DOMContentLoaded', function() {
var experienceInput = document.getElementById('Experience');
var companyNameField = document.getElementById('companyNameField');
experienceInput.addEventListener('input', function() {
  var experienceValue = experienceInput.value.trim();
  if (experienceValue !== '') {
    companyNameField.style.display = 'block';
  } else {
    companyNameField.style.display = 'none';
  }
});
});