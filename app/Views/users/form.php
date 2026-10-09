<h1><?= esc($formTitle ?? 'Add User') ?></h1>

<?php if ($validation): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form method="post" action="<?= site_url($formAction ?? 'users/new') ?>" enctype="multipart/form-data">

    <?= csrf_field() ?>
    
        <p>
        <label for="username">Username</label><br>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= esc($user['username'] ?? '') ?>"
            required
        >
    </p>

    <p>
        <label for="full_name">Full Name</label><br>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= esc($user['full_name'] ?? '') ?>"
            required
        >
    </p>

    <p>
    <label for="password">Password</label><br>
    <input
        type="password"
        id="password"
        name="password"
        minlength="8"
        <?= empty($user['id']) ? 'required' : '' ?>
    >

    <?php if (! empty($user['id'])): ?>
        <small>Leave blank to keep the current password.</small>
    <?php endif; ?>
</p>

    <?php if (! empty($isEdit)): ?>
    <p>
        <label for="avatar">
            Profile Picture (JPG or PNG, maximum 2 MB)
        </label><br>

        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
        >
    </p>
<?php endif; ?>
<button type="submit"><?= esc($buttonText ?? 'Save User') ?></button>
</form>

<p>
    <a href="<?= site_url('users') ?>">Cancel</a>
</p>