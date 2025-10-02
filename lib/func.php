<?php

function validate($name, $email, $examDate, $subject, $grade)
{
    return validateName($name);
}

function validateName($name) {
    if (strlen($name)==0){

    }else if (strlen($name) > 20){
        return false;
    } else {
        return true;
    }
}
