<?php
?>

<html lang="en-GB">
<head>
    <title>ToDoApp</title>
    <link rel="icon" href="image/iconSmall.png">
</head>
<body>
<main>
    <div class="">
        <form action="inc/task_create.php" method="post">
            <label for="task_name">Put a name for a task
                <input type="text" name="task_name" placeholder="Name" autocomplete="off">
            </label>
            <label for="task_desc">Place for a description(not necessary)
                <input type="text" name="task_desc" placeholder="Description" autocomplete="off">
            </label>
            <button type="submit">Submit</button>
        </form>
    </div>
</main>
</body>
</html>