<?php
$current_page = [
    "page" => "main",
    "title" => "Главная"
];
require_once './db.php';
require_once './partials/header.php';
require_once './partials/navigation-bar.php'
?>
<div>
<h3>
    Это главная страница
</h3>
    <img src="./public/forest.jpg" alt="forest"/>
</div>
<?php require_once './partials/footer.php'; ?>
