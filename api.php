<?php

ob_start();

require './core/autoload.php';

$user = new User();

$outData = new stdClass();
$outData->error = '';

switch($_GET['action']) {
    case 'register':
        // Validate user Data
        if ($_POST['email'] === '') {
            $outData->error = 'EMPTY_EMAIL';
        }
        
        if (!validateEmail($_POST['email'])) {
            $outData->error = 'WRONG_EMAIL';
        }
        
        if ($_POST['password'] === '') {
            $outData->error = 'EMPTY_PASSWORD';
        }
        
        if ($_POST['password'] !== $_POST['retypePassword']) {
            $outData->error = 'PASSWORDS_NOT_EQUALS';
        }
                
        // check exist user
        if ($user->searchUserByEmail($_POST['email']) && $outData->error == '') {
            $outData->error = 'USER_ALREADY_REGISTERED';
        }
        break;
    default:
        $outData->error = 'WRONG_ROUTE';
}

saveStdOutput(ob_get_contents());
ob_clean();

sendData($outData);
