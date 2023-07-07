<?php

var_dump($_POST);
$taskName = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$taskName = trim($taskName);
$taskDesc = filter_input(INPUT_POST, 'task_desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

if ($taskName) {
    if (file_exists('tasks.json')) {
        $json = file_get_contents('tasks.json');
        $jsonArray = json_decode($json, true);

    } else $jsonArray = [];

    $jsonArray[$taskName] = ['completed' => false, 'task_desc' => $taskDesc];
    file_put_contents('tasks.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
}

header('Location: /index.php');