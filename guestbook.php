<?php
$current_page = [
    "page" => "guestbook",
    "title" => "Гостевая книга"
];
require_once './db.php';

if(!check_authentication()) {
    header("Location: http://" . $_SERVER ['HTTP_HOST'] . dirname($_SERVER ['PHP_SELF']) . "/index.php");
}

require_once './partials/header.php';
require_once './partials/navigation-bar.php';
?>
<h3>
    Это гостевая книга
</h3>
<form action="guestbook.php" method="POST">
    <label>
        Сообщение
        <textarea name="message"></textarea>
    </label>
    <button type="submit">Отправить</button>
</form>
<?php
if (isset($_POST['message'])) {
    $message_field = $_POST['message'];
    write_record($message_field);
}

$messages = get_records();

?>
<ul>
    <?php
    foreach ($messages as $message) {
        ?>
        <li>
            <b><?=$message["username"];?></b>:
            <?=$message["message"];?>,
            <?=$message["creation_date"]?>
        </li>
        <?php
    }
    ?>
</ul>

<?php require_once './partials/footer.php'; ?>
