<?php
session_start();
try {
    $db = new PDO('mysql:host=localhost;dbname=messagesdb', 'root', '');
}
catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

function authenticate($username, $password) {
    global $db;
    $statement = $db->prepare("SELECT id, password FROM Users WHERE username = :username");
    $statement->execute(["username" => $username]);
    $result = $statement->fetch();
    if($result === false) {
        return false;
    }
    if(md5($password) === $result["password"]) {
        $_SESSION["id"] = $result["id"];
        return true;
    }
}

function register($username, $password): bool {
    global $db;
    $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, md5(:password))");
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
    $statement = $db->prepare("INSERT INTO messages (message, user_id) VALUES (:message, :user_id)");
    $statement->execute(["message" => $message, "user_id" => $_SESSION["id"]]);
}

function get_records(): array
{
    global $db;
    $statement = $db->prepare("SELECT * FROM messages INNER JOIN users ON messages.user_id = Users.id");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return array_reverse($result);
}
