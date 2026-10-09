<!DOCTYPE html>
<html>
<head>
    <title>All Tasks</title>
</head>
<body>

<h1>All Tasks</h1>

<nav>
    <a href="<?= site_url('/') ?>">Today</a> |
    <a href="<?= site_url('tasks') ?>">All Tasks</a> |
    <a href="<?= site_url('about') ?>">About</a> |
    <a href="<?= site_url('customers') ?>">Customer Accounts</a> |
    <a href="<?= site_url('users') ?>">User Accounts</a>
</nav>

<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Task Date</th>
        <th>Created At</th>
    </tr>

    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= esc($task['title']) ?></td>
            <td><?= esc($task['status']) ?></td>
            <td><?= esc($task['task_date']) ?></td>
            <td><?= esc($task['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>