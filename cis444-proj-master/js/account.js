// LOGIC: 
// If user signed in, 
// sign-up: display = none;
// change-password = flex;
// delete-account = flex;
// If user signed out: 
// sign-in: display = flex;
// change-password = none;
// delete-account = none;
var changePasswordForm = document.getElementById("change-password-div");
var changePasswordButton = document.getElementById("change-password-button");
var changePassword1 = document.getElementById("change-password-form-password1");
var changePassword2 = document.getElementById("change-password-form-password2");
var changePasswordErrorMsg = document.getElementById("change-password-form-password2-error");
var updatePasswordButton = document.getElementById("change-password-form-submit");
var signInButton = document.getElementById("sign-in-form-submit");
var signInUsername = document.getElementById("sign-in-form-username");
var signInPassword = document.getElementById("sign-in-form-password");
var signInFormError = document.getElementById("sign-in-form-error");






changePasswordForm.style.display = "none";

changePasswordButton.onclick = function(){
	if (changePasswordForm.style.display == "none") {
		changePasswordForm.style.display = "flex";
		changePasswordButton.style.backgroundColor = "#1968b2";	
	} else {
		changePasswordForm.style.display = "none";
		changePasswordButton.style.backgroundColor = "#2595ff";
	}
	
};

updatePasswordButton.onclick = function() {
	changePasswordErrorMsg.innerHTML = "&nbsp;";
	
	// Empty values
	if (changePassword1.value == ""){
		changePasswordErrorMsg.style.color = "red";
		changePasswordErrorMsg.innerHTML = "Empty Passwords are not acceptable";
		return false;
	}

	// Unmatching passwords
	if (changePassword1.value != changePassword2.value){
		changePasswordErrorMsg.style.color = "red";
		changePasswordErrorMsg.innerHTML = "Your passwords do not match";
		return false;
	}

	// Make ajax call
}

signInButton.onclick = function(){
	signInFormError.innerHTML = "&nbsp;";
	
	// Empty values
	if (signInUsername.value == "" || signInPassword.value == ""){
		signInFormError.style.color = "red";
		signInFormError.innerHTML = "There are empty fields";
		return false;
	}

	// make ajax call. If fail, update error message, return false

}








