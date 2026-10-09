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
<form method="post" action="<?= site_url('logout') ?>">
    <?= csrf_field() ?>
    <button type="submit">Logout</button>
</form>
<p>
    <a href="<?= site_url('users/new') ?>">Add New User</a>
</p>

<table border="1" cellpadding="8">
    <tr>
        <th>Username</th>
        <th>Full Name</th>
        <th>Avatar</th>
        <th>Action</th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
                        <td><?= esc($user['username']) ?></td>
            <td><?= esc($user['full_name']) ?></td>

            <td>
                <?php if (! empty($user['avatar'])): ?>
                    <img
                        src="<?= base_url('uploads/avatars/' . esc($user['avatar'])) ?>"
                        alt="User avatar"
                        width="80"
                        height="80"
                    >
                <?php else: ?>
                    <span>No avatar</span>
                <?php endif; ?>
            </td>

            <td>
                <a href="<?= site_url('users/edit/' . $user['id']) ?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>