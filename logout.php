<?php
require_once './db.php';
log_out();
header("Location: http://" . $_SERVER ['HTTP_HOST'] . dirname($_SERVER ['PHP_SELF']) . "/index.php");
