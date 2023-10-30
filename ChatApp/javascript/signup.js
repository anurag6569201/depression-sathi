const form = document.querySelector(".signup form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
}

var iamdrchecked = false;
document.getElementById('doctorCheck').addEventListener('change', function () {
  if (this.checked) {
    console.log("Checked");
    iamdrchecked = true;
  } else {
    console.log("Unchecked");
    iamdrchecked = false;
  }
  toggleForms(iamdrchecked);
});

function toggleForms(view) {
  let forms = document.getElementsByClassName('doctor');
  let drFulAdd = document.getElementById('drFulAdd');
  let drDocNum = document.getElementById('drDocNum');
  if (view) {
    drFulAdd.setAttribute("required", "true");
    drDocNum.setAttribute("required", "true");
    drDocImg.setAttribute("required", "true");
    for (let i = 0; i < forms.length; i++) {
      forms[i].style.visibility = "visible";
      forms[i].style.height = "auto";
    }
  } else {
    drFulAdd.removeAttribute("required");
    drDocNum.removeAttribute("required");
    for (let i = 0; i < forms.length; i++) {
      forms[i].style.visibility = "hidden";
      forms[i].style.height = "0px";
    }
  }


}

continueBtn.onclick = () => {
  ;
  if (!iamdrchecked) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ChatApp/php/signup.php", true);
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
        } else {
          errorText.style.display = "block";
          errorText.textContent = "Server not found";
          console.log("There is a problem");
        }
      }
    }
  } else {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ChatApp/php/signupDr.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (data === "success") {
            location.href = "check.php";
          } else {
            errorText.style.display = "block";
            errorText.textContent = data;
            console.log("There is a problem1  " + xhr.response);
          }
        } else {
          errorText.style.display = "block";
          errorText.textContent = "Server not found";
          console.log("There is a problem " + xhr.response);
        }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}