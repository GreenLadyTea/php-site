<?php
$current_page = [
    "page" => "guestbook",
    "title" => "Гостевая книга"
];
?>
<?php require_once './partials/header.php'; ?>
<?php require_once './partials/navigation-bar.php' ?>
<h3>
    Это гостевая книга
</h3>
<form action="guestbook.php" method="POST">
    <label>
        Имя
        <input type="text" name="name"/>
    </label>
    <label>
        Сообщение
        <textarea name="message"></textarea>
    </label>
    <button type="submit">Отправить</button>
</form>
<?php
require_once './record.php';

$filename = 'data.txt';

if (isset($_POST['name']) && isset($_POST['message'])) {
    $name_field = $_POST['name'];
    $message_field = $_POST['message'];
    write_record($filename, $name_field, $message_field);
}

$messages = get_records($filename);

?>
<ul>
    <?php
    foreach ($messages as $message) {
        ?>
        <li>
            <b><?=$message["name"];?></b>:
            <?=$message["message"];?>
        </li>
        <?php
    }
    ?>
</ul>

<?php require_once './partials/footer.php'; ?>
