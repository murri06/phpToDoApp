<?php

$taskName = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$taskName = trim($taskName);
$taskDesc = filter_input(INPUT_POST, 'task_desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$taskDate = filter_input(INPUT_POST, 'task_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

if ($taskName) {
    if (file_exists('tasks.json')) {
        $json = file_get_contents('tasks.json');
        $jsonArray = json_decode($json, true);

        if ($jsonArray[$taskName]) {
            header('Location: /phpToDoApp/index.php?error=1');
            exit;
        }
    } else $jsonArray = [];

    $jsonArray[$taskName] = ['completed' => false, 'task_desc' => $taskDesc, 'task_date' => $taskDate];
    file_put_contents('tasks.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
}

header('Location: /phpToDoApp/index.php');