function validate(e) {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    if (password != confirm_password) {
        e.preventDefault(true);
        document.getElementById("mismatched").innerHTML = "Password mismatched";
    } else {
        return false;
    }
}