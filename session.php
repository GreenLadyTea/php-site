<?php
function get_username() {
    return $_SESSION["user"]["username"];
}

function get_user_id() {
    return $_SESSION["user"]["id"];
}

function check_admin_rights(): bool{
    return (int)$_SESSION["user"]["admin_rights"] === 1;
}