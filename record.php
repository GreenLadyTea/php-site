<?php
$config = require_once('config.php');
$link = new MySQLi($config["host"], $config["user"], $config["password"], $config["db"]);
if ($link->connect_error) {
    die('<p style="color:red">'.$link->connect_errno.' - '.$link->connect_error.'</p>');
}
$link->query("SET NAMES utf8");

function write_record($name_field, $message_field) {
    global $link;
    $name_field = htmlspecialchars($name_field, ENT_HTML5);
    $message_field = htmlspecialchars($message_field, ENT_HTML5);
    $link->query("INSERT INTO Messages VALUES (null, '$name_field', '$message_field', CURRENT_TIMESTAMP())");
}

function get_records(): array
{
    global $link;
    $result = $link->query("SELECT * FROM Messages");
    $messages = [];
    while ($row = $result->fetch_row()) {
        $messages[] = [
            "name" => $row[1],
            "message" => $row[2],
            "date" => $row[3]
        ];
    }
    return array_reverse($messages);
}
