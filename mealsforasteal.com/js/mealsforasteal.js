function signup_validate()
{
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var password_conf = document.getElementById('password_confirmation').value;

    if(username == "" || password == "" || password_conf == "")
    {
        alert("All fields must be filled out!");
        return false;
    }

    if(password != password_conf) {
        alert("Passwords don't match!");
    }

    return true;
}