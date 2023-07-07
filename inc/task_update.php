<?php


$json = file_get_contents('tasks.json');
$jsonArray = json_decode($json, true);
echo $_POST['task_name'] ?? ' ';
$taskName = $_POST['task_name'] ?? '';
$taskName = trim($taskName);

echo $taskName;
if ($taskName) {
    $jsonArray[$taskName]['completed'] = !$jsonArray[$taskName]['completed'];
    file_put_contents('tasks.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
}

header('Location: /index.php');