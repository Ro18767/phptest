<?php
define("ERROR_CODES", [
    400 => "Bad request",
    403 => "Forbidden",
    405 => "HTTP method not allowed by the server",
    500 => "Server error",
]);

function send_error($code = 400, $message = false)
{
    if ($message === false) { // не зазначене повідомлення
        if (isset(ERROR_CODES[$code])) { // чи є серед переліку?
            $message = ERROR_CODES[$code];
        } else {
            $message = 'Undefined error';
        }
    }
    http_response_code($code);
    echo $message;
    exit;
}

function get_db()
{
    global $db;
    return $db;
}

function log_error($message)
{
    $log_name = "logs/test.log";
    $log_file = fopen($log_name, "a");
    fwrite($log_file, date("y-m-d h:i:s") . " " . $message . "\r\n");
    fclose($log_file);
}