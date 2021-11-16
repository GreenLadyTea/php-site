<?php
function get_username() {
    return $_SESSION["user"]["username"];
}

function check_admin_rights(): bool{
    return (int)$_SESSION["user"]["admin_rights"] === 1;
}