function email_err(email_str) {
    $.ajax({
        url:"../php/error_ajax.php",
        type: "get",
        dataType: 'json',
        data: {error_type: "email", email: email_str},
        success:function(result){
            document.getElementById("email_err").textContent = result.err;
        }
    });
}

function username_err(username_str) {
    $.ajax({
        url:"../php/error_ajax.php",
        type: "get",
        dataType: 'json',
        data: {error_type: "username", username: username_str},
        success:function(result){
            document.getElementById("username_err").textContent = result.err;
        }
    });
}

function password_err(password_str) {
    $.ajax({
        url:"../php/error_ajax.php",
        type: "get",
        dataType: 'json',
        data: {error_type: "password", password: password_str},
        success:function(result){
            document.getElementById("password_err").textContent = result.err;
        }
    });
}

function ver_password_err(password_str, ver_password_str) {
    $.ajax({
        url:"../php/error_ajax.php",
        type: "get",
        dataType: 'json',
        data: {error_type: "ver_password", password: password_str, ver_password: ver_password_str},
        success:function(result){
            document.getElementById("ver_password_err").textContent = result.err;
        }
    });
}