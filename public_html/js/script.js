function validateLogin() {
  if (
    !document.loginform.email.value.match(
      /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    )
  ) {
    document.getElementById("opt").innerHTML = "Email Invalid";
    return false;
  }
}

console.log("numb");

function validateSignup() {
  if (
    !document.signupform.email.value.match(
      /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    )
  ) {
    document.getElementById("opt").innerHTML = "Email Invalid";
    return false;
  }
  if (!document.signupform.username.value.match(/^[a-zA-Z][a-bA-z0-9]{8,}$/)) {
    document.getElementById("opt").innerHTML =
      "Username must begin with an alphabet and must be least 8 character long.";
    return false;
  }
  if (
    !document.signupform.password1.value.match(
      /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/
    )
  ) {
    document.getElementById("opt").innerHTML =
      "Minimum eight characters, at least one letter, one number and one special character:";
    return false;
  }

  if (document.signupform.password2.value.length === 0) {
    document.getElementById("opt").innerHTML =
      "Confirmation password field is empty.";
    return false;
  }
  if (
    document.signupform.password1.value !== document.signupform.password2.value
  ) {
    document.getElementById("opt").innerHTML =
      "Confirmation password doesnt match.";
    return false;
  }
  return true;
}
