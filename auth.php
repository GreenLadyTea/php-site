<?php
require_once './db.php';

$current_page = [
    "page" => "auth",
    "title" => "Авторизация"
];

$error_message = "";

if (isset($_POST['name']) && isset($_POST['password'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];
    if (authenticate($username, $password)) {
        header("Location: http://" . $_SERVER ['HTTP_HOST'] . dirname($_SERVER ['PHP_SELF']) . "/index.php");
        exit;
    }
    $error_message = "Не удалось авторизоваться";
}

require_once './partials/header.php';
require_once './partials/navigation-bar.php';
?>

<h3>Авторизация</h3>
<?=$error_message?>
<form action="auth.php" method="post">
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

<?php



require_once './partials/footer.php';
?>