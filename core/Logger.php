<?php

class Logger {
    
    // private static $logFilePath = dirname(__FILE__) . '/../logs/out.txt';
    private static $logFilePath = __DIR__ . '/../logs/register.log';
    public static function logData($email, $status) {
        $stat = $status ? 'Email is exist': 'New user';
        $row = sprintf('%s - Try register user by email "%s", status - "%s"'."\n", getCurrentDateTime(), $email, $stat);
        file_put_contents(self::$logFilePath, $row, FILE_APPEND);
    }
}
