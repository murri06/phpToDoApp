<?php
?>

<html lang="en-GB">
<head>
    <title>ToDoApp</title>
    <link rel="icon" href="image/iconSmall.png">
    <link rel="stylesheet" href="inc/styles.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<main>
    <div class="container">
        <form action="inc/task_create.php" class="form" method="post">
            <label for="task_name">Put a name for a task
                <input type="text" name="task_name" placeholder="Name" autocomplete="off">
            </label>
            <label for="task_desc">Place for a description(not necessary)
                <input type="text" name="task_desc" placeholder="Description" autocomplete="off">
            </label>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
</main>
</body>
</html>