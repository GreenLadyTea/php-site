<?php

function write_record($filename, $name_field, $message_field) {
    $name_field = htmlspecialchars($name_field, ENT_HTML5);
    $message_field = htmlspecialchars($message_field, ENT_HTML5);

    $info = $name_field . ":" . $message_field . "\n";
    file_put_contents($filename, $info, FILE_APPEND);
}

function get_records($filename): array
{
    $messages = [];
    $file = file_get_contents($filename);
    $strings = explode("\n", $file);
    $strings = array_reverse($strings);

    foreach ($strings as $string) {
        $pair = explode(":", $string);
        if (count($pair) === 1) {
            continue;
        }
        $messages[] = [
            "name" => $pair[0],
            "message" => $pair[1],
        ];
    }
    return $messages;
}
