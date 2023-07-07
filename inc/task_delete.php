<?php

$json = file_get_contents('tasks.json');
$jsonArray = json_decode($json, true);

$taskName = $_POST['task_name'] ?? '';
$taskName = trim($taskName);

if ($taskName) {
    unset($jsonArray[$taskName]);
    file_put_contents('tasks.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
}

header('Location: /phpToDoApp/index.php');