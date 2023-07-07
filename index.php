<?php

$tasksArray = '';

if (file_exists('inc/tasks.json')) {
    $tasksArray = file_get_contents('inc/tasks.json');
    $tasksArray = json_decode($tasksArray, true);
    foreach ($tasksArray as $taskName => $task) {
        if ($task['task_date']) {
            $task['task_date'] .= '-23-59';
            $date = DateTime::createFromFormat('Y-m-d-G-i', $task['task_date']);
            $today = new DateTime();
            if ($date >= $today) {
                $tasksArray[$taskName]['days_left'] = $today->diff($date)->format('%a');
            } else $tasksArray[$taskName]['days_left'] = '-1';
        }
    }
    file_put_contents('inc/tasks.json', json_encode($tasksArray, JSON_PRETTY_PRINT));
}

$filter = $_GET['list'] ?? '';

if (isset($_GET['error'])) {
    $error = 'Your name is already in a task list!';
} else {
    $error = '';
}


switch ($filter) {
    case 'todo':
        foreach ($tasksArray as $taskName => $task) {
            if ($task['completed']) unset($tasksArray[$taskName]);
        }
        break;
    case 'completed':
        foreach ($tasksArray as $taskName => $task) {
            if (!$task['completed']) unset($tasksArray[$taskName]);
        }
        break;
    case 'missed':
        foreach ($tasksArray as $taskName => $task) {
            if ($task['days_left'] >= 0 || $task['completed']) unset($tasksArray[$taskName]);
        }
        break;
}


?>
<html lang="en-GB">
<head>
    <title>ToDoApp</title>
    <link rel="icon" href="image/iconSmall.png">
    <link rel="stylesheet" href="inc/styles.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<main>
    <header style="margin-bottom: 100px;">
    </header>

    <div class="container" style="max-width: 100vw;text-align: center;">
        <div class="row">
            <div class="col-2 col-sm-2 col-md-2">
                <div class="container">
                    <ul class="list-group" style="font-size: 50px; max-width: 70px">
                        <li class="list-group-item" style="border: none;"><a href="?list="><i class="bi bi-funnel"></i></a>
                        </li>
                        <li class="list-group-item" style="border: none;"><a href="?list=todo"><i
                                        class="bi bi-list-task"></i></a></li>
                        <li class="list-group-item" style="border: none;"><a href="?list=completed"><i
                                        class="bi bi-check-square"></i></a></li>
                        <li class="list-group-item" style="border: none;"><a href="?list=missed"><i
                                        class="bi bi-bookmark-x"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-10 col-sm-10 col-md-10">
                <div class="row">

                    <div class="col-md-6 col-12 col-sm-12">
                        <form action="inc/task_create.php" class="form" method="post">
                            <label class="form-label" for="task_name">Put a name for a task
                                <input class="form-control" type="text" name="task_name" placeholder="Name"
                                       autocomplete="off"
                                       required>
                                <label class="text-danger"><?= $error ?></label>
                            </label><br>
                            <label class="form-label" for="task_desc">Place for a description (not necessary)
                                <input class="form-control" type="text" name="task_desc" placeholder="Description"
                                       autocomplete="off">
                            </label><br>
                            <label for="task_date" class="form-label"> Select data (not necessary)
                                <input type="date" name="task_date" class="form-control">
                            </label>
                            <button class="btn btn-dark" type="submit">Submit</button>
                        </form>
                    </div>

                    <div class="col-md-6 col-12 col-sm-12">
                        <?php foreach ($tasksArray as $taskName => $task): ?>
                            <div class="" style="border: 2px black solid;">
                                <form style="display:inline-block" action="inc/task_update.php" method="post">
                                    <input type="checkbox"
                                           class="form-check-input" <?= $task['completed'] ? 'checked' : ' ' ?> >
                                    <input type="hidden" name="task_name" value="<?= $taskName ?>">
                                </form>
                                <h2><?= $taskName ?></h2>
                                <h3><?= $task['task_desc'] ?></h3>
                                <h3><?php if (isset($task['days_left']) && !$task['completed']) {
                                        if ($task['days_left'] >= 1) echo "There is " . $task['days_left'] . " days left.";
                                        elseif ($task['days_left'] == 0) echo "Its last day for this task.";
                                        else echo 'This task is already missed.';
                                    }
                                    ?></h3>
                                <form style="display: inline-block" method="post" action="inc/task_delete.php">
                                    <input type="hidden" name="task_name" value="<?= $taskName ?>">
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script>
    const checkbox = document.querySelectorAll('input[type=checkbox]')
    checkbox.forEach(ch => {
        ch.onclick = function () {
            this.parentNode.submit();
        };
    })
</script>
</body>
</html>