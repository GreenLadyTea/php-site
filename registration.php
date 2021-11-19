<?php
require_once './db.php';

$current_page = [
    "page" => "registration",
    "title" => "Регистрация"
];

$error_message = "";

if (isset($_POST['name']) && isset($_POST['password'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];
    if(register($username, $password)) {
        header("Location: http://" . $_SERVER ['HTTP_HOST'] . dirname($_SERVER ['PHP_SELF']) . "/auth.php");
        exit;
    }
    $error_message = "Не удалось зарегистрироваться";
}

require_once './partials/header.php';
require_once './partials/navigation-bar.php';
?>
<div class="window">
<h3>Регистрация</h3>
<?=$error_message?>
<form action="registration.php" method="post">
    <label>
        Ник
        <input type="text" name="name"/>
    </label>
    <label>
        Пароль
        <input type="password" name="password"/>
    </label>
    <button type="submit">Отправить</button>
</form>
</div>
<?php
require_once './partials/footer.php';
?>
