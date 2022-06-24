<?php

function sendData($data) {
    header('Content-Type: application/json; charset=utf-8');
    $out = json_encode($data);
    echo $out;
}

function validateEmail($email) {
    return (strpos($email, '@') === false)? false : true;
}

function saveStdOutput ($str) {
    $filePath = __DIR__ . '/../logs/errors.log';
    if ($str) {
        file_put_contents($filePath, "\n" . getCurrentDateTime() . "\n" . $str, FILE_APPEND);
    }
}

function getCurrentDateTime() {
    return date('Y-m-d H:i:s');
}