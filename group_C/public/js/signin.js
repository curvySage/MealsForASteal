var signInButton = document.getElementById("sign-in-form-submit");
var signInUsername = document.getElementById("sign-in-form-username");
var signInPassword = document.getElementById("sign-in-form-password");
var signInFormError = document.getElementById("sign-in-form-error");

var signUpFormError = document.getElementById("sign-up-form-error");
var signUpFormUsername = document.getElementById("sign-up-form-username");
var signUpFormPassword1 = document.getElementById("sign-up-form-password1");
var signUpFormPassword2 = document.getElementById("sign-up-form-password2");
var signUpFormButton = document.getElementById("sign-up-form-submit");

signInButton.onclick = function(){
	signInFormError.innerHTML = "&nbsp;";
	
	// Empty values
	if (signInUsername.value == "" || signInPassword.value == ""){
		signInFormError.style.color = "red";
		signInFormError.innerHTML = "There are empty fields";
		return false;
	}

}

signUpFormButton.onclick = function(){
	signUpFormError.innerHTML = "&nbsp;";

	if (signUpFormUsername.value == "" || signUpFormPassword1.value == "" || signUpFormPassword2.value == ""){
		signUpFormError.style.color = "red";
		signUpFormError.innerHTML = "There are empty fields";
		return false;
	}

	if (signUpFormPassword2.value != signUpFormPassword1.value) {
		signUpFormError.style.color = "red";
		signUpFormError.innerHTML = "Passwords do not match";
		return false;	
	}


}
