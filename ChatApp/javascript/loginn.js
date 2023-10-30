const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
}

var iamdrchecked = false;
document.getElementById('doctorCheckLog').addEventListener('change', function() {
  if (this.checked) {
    console.log("Checked");
    iamdrchecked = true;
  } else {
    console.log("Unchecked");
    iamdrchecked = false;
  }
  toggleExtraFeild(iamdrchecked);
});

function toggleExtraFeild(view) {
  let elements = document.getElementsByClassName('myElement');
  if (view) {
    for (var i = 0; i < elements.length; i++) {
      var element = elements[i];
      if (element.style.visibility === 'hidden' || element.style.visibility === '') {
          element.style.visibility = 'visible';
          element.style.height = 'auto';
      } else {
          element.style.visibility = 'hidden';
          element.style.height = '0';
      }
    }
  }
}
continueBtn.onclick = () => {
  if (!iamdrchecked) {
    //if doctor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ChatApp/php/login.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (data === "success") {
            location.href = "check.php";
          } else {
            errorText.style.display = "block";
            errorText.textContent = data;
          }
        }
      }
    }
  } else {
    //else patient
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ChatApp/php/loginDr.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (data === "success") {
            location.href = "check.php";
          } else {
            errorText.style.display = "block";
            errorText.textContent = data;
          }
        }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}