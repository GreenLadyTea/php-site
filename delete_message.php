<?php
require_once './db.php';
delete_record($_GET["message_id"]);
header("Location: http://" . $_SERVER ['HTTP_HOST'] . dirname($_SERVER ['PHP_SELF']) . "/guestbook.php");