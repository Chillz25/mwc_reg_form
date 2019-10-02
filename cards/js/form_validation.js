

function validateEmail(v_email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(v_email);
}

var fname = document.getElementById("fname").value;
var lname = document.getElementById("lname").value;
var birthdate = document.getElementById("birthdate").value;
var contact = document.getElementById("contact").value;
var email = document.getElementById("email").value;

//PASSWORD VARIABLES IN REGISTRATION
var passwd = document.getElementById("passwd").value;
var c_passwd = document.getElementById("c_passwd").value;
//PASSWORD VARIABLES IN REGISTRATION

//PASSWORD VARIABLES IN SETTINGS
var current_passwd = document.getElementById("current_pw").value;
var new_passwd = document.getElementById("change_pw").value;
var confirm_new_passwd = document.getElementById("confirm_change_pw").value;
//PASSWORD VARIABLES IN SETTINGS

var flag = false;

//PASSWORD VARIABLES
var allLetters = /^[a-zA-Z]+$/;
var letter = /[a-zA-Z]/;
var number = /[0-9]/;
//PASSWORD VARIABLES

document.getElementById("register").onclick = function () {

//FIRST NAME
if (!fname) {
  document.getElementById("fname_label").innerHTML = "<span style='color: red;'>Please enter your first name</span>";
  flag = true;
} else {
    document.getElementById("fname_label").innerHTML = "";
}
//FIRST NAME

//LAST NAME
if (!lname) {
  document.getElementById("lname_label").innerHTML = "<span style='color: red;'>Please enter your last name</span>";
  flag = true;
} else {
    document.getElementById("lname_label").innerHTML = "";
}
//LAST NAME

//CONTACT NUMBER
  let c = contact + ''; // make sure it's a string
  c = c.trim()// trim it
  if (c.length !== 11) {
      document.getElementById("number_label").innerHTML = "<span style='color: red;'>Your contact number must contain 11 digits</span>";
      flag = true;
  } else {
      document.getElementById("number_label").innerHTML = "";
  }
//CONTACT NUMBER

//BIRTHDATE
if (!birthdate) {
  document.getElementById("birthdate_label").innerHTML = "<span style='color: red;'>Please select your birthdate</span>";
  flag = true;
} else {
    document.getElementById("birthdate_label").innerHTML = "";
}
//BIRTHDATE

//EMAIL
  if (validateEmail(email)) {
    document.getElementById("email_label").innerHTML = "";
  } else {
    document.getElementById("email_label").innerHTML = "<span style='color: red;'>Incorrect email format</span>";
    flag = true;
  }
//EMAIL

//PASSWORD VALIDITY CHECK
if (!passwd || !c_passwd) {
    document.getElementById("password_label").innerHTML = "<span style='color: red;'>Please enter your password</span>";
    flag = true;
} else if (passwd.length < 4 || !letter.test(passwd) || !number.test(passwd)) {
    document.getElementById("password_label").innerHTML = "<span style='color: red;'>Your password must contain a number and a letter and be at least 4 characters long</span>";
    flag = true;
} else {
    document.getElementById("password_label").innerHTML = "Password";
}
//PASSWORD VALIDITY CHECK

//COMPARE PASSWORDS
if (passwd != c_passwd) {
    document.getElementById("password_label").innerHTML = "<span style='color: red;'>Passwords do not match</span>";
    document.getElementById("c_password_label").innerHTML = "<span style='color: red;'>Passwords do not match</span>";
    flag = true;
}
//COMPARE PASSWORDS

if(flag) {
  return false;
}
}

document.getElementById("change").onclick = function () {

  //PASSWORD VALIDITY CHECK
  if (!new_passwd || !confirm_new_passwd) {
      document.getElementById("password_label").innerHTML = "<span style='color: red;'>Please enter your password</span>";
      flag = true;
  } else if (new_passwd.length < 4 || !letter.test(new_passwd) || !number.test(new_passwd)) {
      document.getElementById("password_label").innerHTML = "<span style='color: red;'>Your password must contain a number and a letter and be at least 4 characters long</span>";
      flag = true;
  } else {
      document.getElementById("password_label").innerHTML = "Password";
  }
  //PASSWORD VALIDITY CHECK

if(flag) {
  return false;
}
}
