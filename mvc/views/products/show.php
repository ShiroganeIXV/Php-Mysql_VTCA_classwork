<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($product['name']) ?></h1>
    <p>Price: $<?= number_format($product['price'], 2) ?></p>
    <a href="index.php?action=edit&id=<?= $product['id'] ?>">Edit</a>
    <a href="index.php?action=delete&id=<?= $product['id'] ?>">Delete</a>
    <a href="index.php">Back to Products</a>
</body>
</html>