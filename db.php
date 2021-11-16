<?php
session_start();
$config = require_once './config.php';
try {
    $db = new PDO('mysql:host=' . $config["host"] . ';dbname=' . $config["db"], $config["user"], $config["password"]);
}
catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

function authenticate($username, $password): string {
    global $db;
    $statement = $db->prepare("SELECT id, password FROM Users WHERE username = :username");
    $statement->execute(["username" => $username]);
    $result = $statement->fetch();
    if($result === false) {
        return 'Нет такого пользователя';
    }
    if(md5($password) === $result["password"]) {
        $_SESSION["id"] = $result["id"];
        return '';
    }
    return 'Неправильный пароль';
}

function register($username, $password): bool {
    global $db;
    $statement = $db->prepare("INSERT INTO Users (username, password) VALUES (:username, md5(:password))");
    try {
        $statement->execute(["username" => $username, "password" => $password]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function log_out() {
    session_destroy();
}

function check_authentication(): bool
{
    return isset($_SESSION["id"]);
}

function write_record($message) {
    global $db;
    $statement = $db->prepare("INSERT INTO Messages (message, user_id) VALUES (:message, :user_id)");
    $statement->execute(["message" => $message, "user_id" => $_SESSION["id"]]);
}

function get_records(): array
{
    global $db;
    $statement = $db->prepare("SELECT * FROM Messages INNER JOIN Users ON Messages.user_id = Users.id");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return array_reverse($result);
}
