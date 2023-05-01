#!/usr/local/bin/php
<?php

$err_type = $_GET["error_type"];

$err = "";

if($err_type == "email") {
    email_err();
}
elseif($err_type == "username") {
    username_err();
}
elseif($err_type == "password") {
    password_err();
}
elseif($err_type == "ver_password") {
    ver_password_err();
}

function email_err() {
    $q = $_GET["email"];
    if ($q !== "") {
        if(!preg_match('/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/', trim($q))) {
            $err = "Please provide a valid email.";
        }
    }
    
    echo json_encode(array("err"=>$err));
}

function username_err() {
    $q = $_GET["username"];
    if ($q !== "") {
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($q))) {
            $err = "Username can only contain letters, numbers, and underscores.";
        }
    }
    
    echo json_encode(array("err"=>$err));
}

function password_err() {
    $q = $_GET["password"];
    if ($q !== "") {
        if(strlen(trim($q)) < 6) {
            $err = "Password must contain at least 6 characters.";
        }
    }
    
    echo json_encode(array("err"=>$err));
}

function ver_password_err() {
    $p = $_GET["password"];
    $q = $_GET["ver_password"];
    if ($q !== "" && $p !== "") {
        if(empty($q) || ($p != $q)) {
            $err = "Passwords are not matching.";
        }
    }
    
    echo json_encode(array("err"=>$err));
}
?>