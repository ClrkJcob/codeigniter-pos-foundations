<!DOCTYPE html>
<html>
<head>
    <title>Record Sale</title>
</head>
<body>

<h1>Record Sale</h1>

<nav>
    <a href="<?= site_url('products') ?>">Products</a> |
    <a href="<?= site_url('sales') ?>">Sales History</a>
</nav>

<hr>

<?php if (! empty($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<?php if (! empty($error)): ?>
    <p><?= esc($error) ?></p>
<?php endif; ?>

<form method="post" action="<?= site_url('sales/new') ?>">
    <?= csrf_field() ?>

    <p>
        <label for="product_id">Product</label><br>
        <select name="product_id" id="product_id" required>
            <option value="">Select a product</option>

            <?php foreach ($products as $product): ?>
                <option
                    value="<?= esc($product['id']) ?>"
                    <?= old('product_id', $sale['product_id'] ?? '') == $product['id'] ? 'selected' : '' ?>
                >
                    <?= esc($product['name']) ?>
                    — ₱<?= esc(number_format((float) $product['price'], 2)) ?>
                    — Stock: <?= esc($product['stock_quantity']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label for="customer_id">Customer (optional)</label><br>
        <select name="customer_id" id="customer_id">
            <option value="">Walk-in Customer</option>

            <?php foreach ($customers as $customer): ?>
                <option
                    value="<?= esc($customer['id']) ?>"
                    <?= old('customer_id', $sale['customer_id'] ?? '') == $customer['id'] ? 'selected' : '' ?>
                >
                    <?= esc($customer['full_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label for="quantity">Quantity</label><br>
        <input
            type="number"
            id="quantity"
            name="quantity"
            min="1"
            value="<?= esc(old('quantity', $sale['quantity'] ?? '1')) ?>"
            required
        >
    </p>

    <button type="submit">Record Sale</button>
</form>

</body>
</html>