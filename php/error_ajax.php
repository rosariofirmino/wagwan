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
?>