<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h1>Product Management</h1>

<nav>
    <a href="<?= site_url('/') ?>">Home</a> |
    <a href="<?= site_url('products') ?>">Products</a> |
    <a href="<?= site_url('customers') ?>">Customers</a> |
    <a href="<?= site_url('users') ?>">Staff</a> |
    <a href="<?= site_url('sales') ?>">Sales History</a>
</nav>

<hr>
<?php if ($error = session()->getFlashdata('error')): ?>
    <p><?= esc($error) ?></p>
<?php endif; ?>
<p>
    <a href="<?= site_url('products/new') ?>">Add New Product</a>
</p>

<table border="1" cellpadding="8">
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td>
                <?php if (! empty($product['image'])): ?>
                    <img
                        src="<?= esc(base_url('uploads/products/' . $product['image'])) ?>"
                        width="80"
                        alt="<?= esc($product['name']) ?>"
                    >
                <?php else: ?>
                    No image
                <?php endif; ?>
            </td>
            <td><?= esc($product['name']) ?></td>
            <td>₱<?= esc(number_format((float) $product['price'], 2)) ?></td>
            <td><?= esc($product['stock_quantity']) ?></td>
            <td>
                <a href="<?= site_url('products/edit/' . $product['id']) ?>">Edit</a>
                |
<form
    method="post"
    action="<?= site_url('products/delete/' . $product['id']) ?>"
    style="display: inline;"
>
    <?= csrf_field() ?>
    <button
        type="submit"
        onclick="return confirm('Delete this product?')"
    >
        Delete
    </button>
</form>            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>