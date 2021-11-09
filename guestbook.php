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

$filename = 'data.txt';

if (isset($_POST['name']) && isset($_POST['message'])) {
    $name_field = $_POST['name'];
    $message_field = $_POST['message'];

    $info = $name_field . ":" . $message_field . "\n";
    file_put_contents($filename, $info, FILE_APPEND);
}

$file = file_get_contents($filename);
$strings = explode("\n", $file);
$strings = array_reverse($strings);
$messages = [];
foreach ($strings as $string) {
    $pair = explode(":", $string);
    //print_r($pair);
    if (count($pair) === 1) {
        continue;
    }
    $messages[] = [
            "name" => $pair[0],
            "message" => $pair[1],
    ];
}

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
