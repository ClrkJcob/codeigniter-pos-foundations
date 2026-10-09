<!DOCTYPE html>
<html>
<head>
    <title>Tasks for Today</title>
</head>
<body>

<h1>Tasks for Today</h1>

<nav>
    <a href="<?= site_url('/') ?>">Today</a> |
    <a href="<?= site_url('tasks') ?>">All Tasks</a> |
    <a href="<?= site_url('about') ?>">About</a> |
    <a href="<?= site_url('customers') ?>">Customer Accounts</a> |
    <a href="<?= site_url('users') ?>">User Accounts</a>
</nav>

<hr>

<?php if (empty($tasks)): ?>
    <p>No tasks are scheduled for today.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Date</th>
        </tr>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= esc($task['title']) ?></td>
                <td><?= esc($task['status']) ?></td>
                <td><?= esc($task['task_date']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>