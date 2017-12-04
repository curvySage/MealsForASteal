var changePasswordForm = document.getElementById("change-password-div");
var changePasswordButton = document.getElementById("change-password-button");
var changePassword1 = document.getElementById("change-password-form-password1");
var changePassword2 = document.getElementById("change-password-form-password2");
var changePasswordErrorMsg = document.getElementById("change-password-form-password2-error");
var updatePasswordButton = document.getElementById("change-password-form-submit");
var deleteAccountButton = document.getElementById("delete-account-warning");
var deleteAccountForm = document.getElementById("delete-account-form");


changePasswordForm.style.display = "none";
deleteAccountForm.style.display = "none";

changePasswordButton.onclick = function(){
	if (changePasswordForm.style.display == "none") {
		changePasswordForm.style.display = "flex";
		changePasswordButton.style.backgroundColor = "#1968b2";	
	} else {
		changePasswordForm.style.display = "none";
		changePasswordButton.style.backgroundColor = "#2595ff";
	}
	
}

updatePasswordButton.onclick = function() {
	changePasswordErrorMsg.innerHTML = "&nbsp;";
	var changePassword1 = document.getElementById("change-password-form-password1");
	var changePassword2 = document.getElementById("change-password-form-password2");
	
	// Empty values
	if (changePassword1.value == "" || changePassword2.value == ""){
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
}



deleteAccountButton.onclick = function() {
	console.log("ho");
	if (deleteAccountForm.style.display == "none") {
		deleteAccountForm.style.display = "flex";
		deleteAccountButton.style.backgroundColor = "red";	
	} else {
		deleteAccountForm.style.display = "none";
		deleteAccountButton.style.backgroundColor = "#ff3547";
	}
}





