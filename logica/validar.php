<?php

function EmailVa($email) {
    
    $patron = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($patron, $email)) {

        return true;  

    } else {

        return false; 

    }
}

function validated_password ($password){

    $patron = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){6,16}$/";

    if (preg_match($patron, $password)) {

        return True;

    } 

    else {

        return False;

    }

    return True;
    
}


?>