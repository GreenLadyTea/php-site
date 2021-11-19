<?php
$current_page = [
    "page" => "profile",
    "title" => "Личный кабинет"
];
require_once './db.php';
require_once './session.php';

require_once './partials/header.php';
require_once './partials/navigation-bar.php';
?>
<div>
<div>Добро пожаловать, <?=get_username()?>!</div>
<?php
if(check_admin_rights()) {?>
    Как админ вы можете удалить записи всех пользователей <br/>
    <?php
    $users = get_users();
    ?>
    <ul>
        <?php
        foreach ($users as $user) {
        ?>
            <li>
                <b><?=$user["username"];?></b>: Всего
                <span><?=get_number_of_records_of_user($user["id"])?> сообщений</span>
                <a href="delete_all_messages.php?user_id=<?=$user["id"]?>">Удалить все сообщения пользователя</a>
            </li>
            <?php } ?>
    </ul>
<?php
} else {?>
    <a href="delete_all_messages.php?user_id=<?=get_user_id()?>">Удалить все мои сообщения</a>
<?php } ?>
</div>

<?php require_once './partials/footer.php'; ?>
