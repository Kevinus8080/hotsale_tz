<?php

function sendData($data) {
    header('Content-Type: application/json; charset=utf-8');
    $out = json_encode($data);
    echo $out;
}

function validateEmail($email) {
    return (strpos($email, '@') === false)? false : true;
}