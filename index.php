<?php

$tasksArray = '';

if (file_exists('inc/tasks.json')) {
    $tasksArray = file_get_contents('inc/tasks.json');
    $tasksArray = json_decode($tasksArray, true);
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
</head>
<body>
<main>
    <header>
        <br>
    </header>
    <div style="max-width: 80vw;text-align: center;">
        <div class="row">
            <div class="col-md-6 col-12 col-sm-12">
                <form action="inc/task_create.php" class="form" method="post">
                    <label class="form-label" for="task_name">Put a name for a task
                        <input class="form-control" type="text" name="task_name" placeholder="Name" autocomplete="off"
                               required>
                    </label><br>
                    <label class="form-label" for="task_desc">Place for a description(not necessary)
                        <input class="form-control" type="text" name="task_desc" placeholder="Description"
                               autocomplete="off">
                    </label><br>
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
                    </div>
                <?php
                endforeach;
                ?>
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