<?php
$isEdit = ! empty($product['id']);
$formAction = $isEdit
    ? site_url('products/edit/' . $product['id'])
    : site_url('products/new');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $isEdit ? 'Edit Product' : 'Add Product' ?></title>
</head>
<body>

<h1><?= $isEdit ? 'Edit Product' : 'Add Product' ?></h1>

<?php if (! empty($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form method="post" action="<?= $formAction ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <p>
        <label for="name">Product Name</label><br>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= esc(old('name', $product['name'] ?? '')) ?>"
            required
        >
    </p>

    <p>
        <label for="price">Price</label><br>
        <input
            type="number"
            id="price"
            name="price"
            step="0.01"
            min="0"
            value="<?= esc(old('price', $product['price'] ?? '')) ?>"
            required
        >
    </p>

    <p>
        <label for="stock_quantity">Stock Quantity</label><br>
        <input
            type="number"
            id="stock_quantity"
            name="stock_quantity"
            min="0"
            value="<?= esc(old('stock_quantity', $product['stock_quantity'] ?? '')) ?>"
            required
        >
    </p>

    <p>
        <label for="image">Product Image</label><br>
        <input
            type="file"
            id="image"
            name="image"
            accept="image/jpeg,image/png,image/gif"
        >
    </p>

    <?php if (! empty($product['image'])): ?>
        <p>
            Current image:<br>
            <img
                src="<?= esc(base_url('uploads/products/' . $product['image'])) ?>"
                width="120"
                alt="<?= esc($product['name']) ?>"
            >
        </p>
    <?php endif; ?>

    <button type="submit">
        <?= $isEdit ? 'Update Product' : 'Save Product' ?>
    </button>
</form>

<p>
    <a href="<?= site_url('products') ?>">Cancel</a>
</p>

</body>
</html>