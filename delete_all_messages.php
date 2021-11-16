<?php
require_once './db.php';
delete_all_records($_GET["user_id"]);
header("Location: http://" . $_SERVER ['HTTP_HOST'] . dirname($_SERVER ['PHP_SELF']) . "/guestbook.php");