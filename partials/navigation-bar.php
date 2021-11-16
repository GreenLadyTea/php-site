<?php
require_once './db.php';
require_once './session.php';
$isAuthenticated = check_authentication();
?>
<a href="../index.php" class="<?=$current_page["page"] === "main" ? "active" : ""?>">
    Главная
</a>
<a href="../guestbook.php" class="<?=$current_page["page"] === "guestbook" ? "active" : ""?>">
    Гостевая книга
</a>
<?php
if(!$isAuthenticated) { ?>
    <a href="../auth.php" class="<?=$current_page["page"] === "auth" ? "active" : ""?>">
    Авторизация
</a>
<a href="../registration.php" class="<?=$current_page["page"] === "registration" ? "active" : ""?>">
    Регистрация
</a>
<?php
}
else { ?>
<span><?=get_username()?></span>
<a href="../logout.php">
    Выйти
</a>
<?php
}
?>