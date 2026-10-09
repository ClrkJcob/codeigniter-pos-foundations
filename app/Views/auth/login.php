<h1>POS Login</h1>

<?php if ($error = session()->getFlashdata('error')): ?>
    <p><?= esc($error) ?></p>
<?php endif; ?>

<?php if ($success = session()->getFlashdata('success')): ?>
    <p><?= esc($success) ?></p>
<?php endif; ?>

<form method="post" action="<?= site_url('login/auth') ?>">
    <?= csrf_field() ?>

    <p>
        <label for="username">Username</label><br>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= esc(old('username')) ?>"
            required
        >
    </p>

    <p>
        <label for="password">Password</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
    </p>
    <button type="submit">Log In</button>
</form>