<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

<h1>User Accounts</h1>

<nav>
    <a href="<?= base_url('/') ?>">Home</a> |
    <a href="<?= base_url('/about') ?>">About</a> |
    <a href="<?= base_url('/customers') ?>">Customer Accounts</a> |
    <a href="<?= base_url('/users') ?>">User Accounts</a>
</nav>

<table border="1" cellpadding="8">
    <tr>
        <th>Username</th>
        <th>Full Name</th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= esc($user['username']) ?></td>
            <td><?= esc($user['full_name']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>