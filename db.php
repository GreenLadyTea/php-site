<?php
session_start();
$config = require_once './config/config.php';
try {
    $db = new PDO('mysql:host=' . $config["host"] . ';dbname=' . $config["db"], $config["user"], $config["password"]);
}
catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

function authenticate($username, $password): string {
    global $db;
    $statement = $db->prepare("SELECT * FROM Users WHERE username = :username");
    $statement->execute(["username" => $username]);
    $result = $statement->fetch();
    if($result === false) {
        return 'Нет такого пользователя';
    }
    if(md5($password) === $result["password"]) {
        $_SESSION["user"] = $result;
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
    return isset($_SESSION["user"]["id"]);
}

function write_record($message) {
    global $db;
    $statement = $db->prepare("INSERT INTO Messages (message, user_id) VALUES (:message, :user_id)");
    $statement->execute(["message" => $message, "user_id" => $_SESSION["user"]["id"]]);
}

function get_records(): array
{
    global $db;
    $statement = $db->prepare("
        SELECT
            Messages.id as message_id,
            Messages.creation_date,
            Messages.message,
            Users.id, Users.username
        FROM Messages 
        INNER JOIN Users ON Messages.user_id = Users.id
        ORDER BY Messages.creation_date");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return array_reverse($result);
}

function delete_record($message_id) {
    global $db;
    $statement = $db->prepare("DELETE FROM Messages WHERE id=:id");
    $statement->execute(["id" => $message_id]);
}

function delete_all_records($user_id) {
    global $db;
    $statement = $db->prepare("DELETE FROM Messages WHERE user_id=:user_id");
    $statement->execute(["user_id" => $user_id]);
}