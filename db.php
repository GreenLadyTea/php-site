<?php
$config = require_once('config.php');
session_start();
$link = new MySQLi($config["host"], $config["user"], $config["password"], $config["db"]);
if ($link->connect_error) {
    die('<p style="color:red">'.$link->connect_errno.' - '.$link->connect_error.'</p>');
}
$link->query("SET NAMES utf8");

function authenticate($username, $password) {
    global $link;
    $username = mysqli_real_escape_string(
        $link,
        $username
    );
    $result = $link->query("SELECT id, password FROM Users WHERE username = '$username'");
    $row = $result->fetch_row();
    if($result === false || count($row) === 0) {
        return false;
    }
    if(md5($password) === $row[1]) {
        $_SESSION["id"] = $row[0];
        return true;
    }
}

function write_record($message_field) {
    global $link;
    $message_field = htmlspecialchars($message_field, ENT_HTML5);
    $link->query("INSERT INTO Messages VALUES (null, ".$_SESSION["id"].", '$message_field', CURRENT_TIMESTAMP())");
}

function get_records(): array
{
    global $link;
    $result = $link->query("SELECT * FROM Messages INNER JOIN Users ON Messages.user_id = Users.id");
    print_r($result);
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
