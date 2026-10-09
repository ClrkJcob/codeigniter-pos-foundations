<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

<h1>Demo User Profile</h1>

<nav>
    <a href="<?= site_url('/') ?>">Today</a> |
    <a href="<?= site_url('tasks') ?>">All Tasks</a> |
    <a href="<?= site_url('profile') ?>">Profile</a> |
    <a href="<?= site_url('about') ?>">About</a>
</nav>

<hr>

<?php if ($user): ?>
    <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
    <p><strong>Full Name:</strong> <?= esc($user['full_name']) ?></p>
    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
    <p><strong>Created At:</strong> <?= esc($user['created_at']) ?></p>
<?php else: ?>
    <p>No user record found.</p>
<?php endif; ?>

</body>
</html>