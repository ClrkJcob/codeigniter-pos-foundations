<h1><?= esc($formTitle ?? 'Add Customer') ?></h1>

<?php if ($validation): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form method="post" action="<?= site_url($formAction ?? 'customers/new') ?>">
        <?= csrf_field() ?>

        <p>
        <label for="full_name">Full Name</label><br>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= esc($customer['full_name'] ?? '') ?>"
            required
        >
    </p>

    <p>
        <label for="email">Email</label><br>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= esc($customer['email'] ?? '') ?>"
            required
        >
    </p>

    <p>
        <label for="phone">Phone</label><br>
        <input
            type="text"
            id="phone"
            name="phone"
            value="<?= esc($customer['phone'] ?? '') ?>"
        >
    </p>

<button type="submit"><?= esc($buttonText ?? 'Save Customer') ?></button>
</form>

<p>
    <a href="<?= site_url('customers') ?>">Cancel</a>
</p>