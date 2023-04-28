function email_err(email_str) {
    $.ajax({
        url:"../php/error_ajax.php",
        type: "get",
        dataType: 'json',
        data: {error_type: "email", email: email_str},
        success:function(result){
            document.getElementById("email_err").innerText = result.err;
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
            document.getElementById("username_err").innerText = result.err;
        }
    });
}