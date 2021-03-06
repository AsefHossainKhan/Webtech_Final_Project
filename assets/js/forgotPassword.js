const answer = document.getElementById('answer');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
const securityQuestion = document.getElementById('securityQuestion');
const userId = document.getElementById('userId');

function submits() {
  answerValue = answer.value.trim();
  passwordValue = password.value.trim();
  confirmPasswordValue = confirmPassword.value.trim();
  userIdValue = userId.value.trim();

  if (answerValue === '') {
    alert ('Please enter an answer');
  }
  else if (passwordValue === '') {
    alert ('Please enter a new password');
  }
  else if (passwordValue.length < 8) {
    alert ('Password must be a minimum of 8 characters');
  }
  else if (passwordValue != confirmPasswordValue) {
    alert ('Passwords do not match');
  }
  else {
    var coachData = {
      'functionName' : "submits",
      'userId' : userIdValue,
      'answer' : answerValue,
      'password' : passwordValue
    };

    coachData = JSON.stringify(coachData);

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/coachForgotPasswordController.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.responseType = "json";
    xhttp.send('json='+coachData);

    xhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        alert(this.response.status);
      }
    }
  }
}

function setQuestion() {
  userIdValue = userId.value.trim();

  var coachData = {
    'functionName' : "setQuestion",
    'userId' : userIdValue
  };

  coachData = JSON.stringify(coachData);

  var xhttp = new XMLHttpRequest();
  xhttp.open('POST', '../controllers/coachForgotPasswordController.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.responseType = "json";
  xhttp.send('json='+coachData);

  xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      securityQuestion.innerHTML = this.response.securityQuestion;
    }
  }
}