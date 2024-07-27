<?php
include '../includes/db.php';
include '../includes/product.php';
include '../includes/nav.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$products = getProducts();
$editingProduct = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];
        $expiration_date = $_POST['expiration_date'];
        $barcode = $_POST['barcode'];
        addProduct($name, $description, $price, $quantity, $category_id, $supplier_id, $expiration_date, $barcode);
        header("Location: manage_products.php");
        exit();
    } elseif (isset($_POST['edit_product'])) {
        $id = $_POST['id'];
        $editingProduct = getProductById($id);
    } elseif (isset($_POST['update_product'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];
        $expiration_date = $_POST['expiration_date'];
        $barcode = $_POST['barcode'];
        updateProduct($id, $name, $description, $price, $quantity, $category_id, $supplier_id, $expiration_date, $barcode);
        header("Location: manage_products.php");
        exit();
    } elseif (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        deleteProduct($id);
        header("Location: manage_products.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Manage Products</h1>

    <?php if ($editingProduct): ?>
        <h2>Edit Product</h2>
        <form action="manage_products.php" method="post">
            <input type="hidden" name="update_product" value="1">
            <input type="hidden" name="id" value="<?php echo $editingProduct['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($editingProduct['name']); ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($editingProduct['description']); ?></textarea>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($editingProduct['price']); ?>" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($editingProduct['quantity']); ?>" required>
            <label for="category_id">Category ID:</label>
            <input type="number" id="category_id" name="category_id" value="<?php echo htmlspecialchars($editingProduct['category_id']); ?>" required>
            <label for="supplier_id">Supplier ID:</label>
            <input type="number" id="supplier_id" name="supplier_id" value="<?php echo htmlspecialchars($editingProduct['supplier_id']); ?>" required>
            <label for="expiration_date">Expiration Date:</label>
            <input type="date" id="expiration_date" name="expiration_date" value="<?php echo htmlspecialchars($editingProduct['expiration_date']); ?>">
            <label for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" value="<?php echo htmlspecialchars($editingProduct['barcode']); ?>" required>
            <button type="submit">Update Product</button>
        </form>
    <?php else: ?>
        <h2>Add Product</h2>
        <form action="manage_products.php" method="post">
            <input type="hidden" name="add_product" value="1">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="category_id">Category ID:</label>
            <input type="number" id="category_id" name="category_id" required>
            <label for="supplier_id">Supplier ID:</label>
            <input type="number" id="supplier_id" name="supplier_id" required>
            <label for="expiration_date">Expiration Date:</label>
            <input type="date" id="expiration_date" name="expiration_date">
            <label for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" required>
            <button type="submit">Add Product</button>
        </form>
    <?php endif; ?>

    <h2>Existing Products</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category ID</th>
                <th>Supplier ID</th>
                <th>Expiration Date</th>
                <th>Barcode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['category_id']; ?></td>
                    <td><?php echo $product['supplier_id']; ?></td>
                    <td><?php echo $product['expiration_date']; ?></td>
                    <td><?php echo $product['barcode']; ?></td>
                    <td>
                        <form action="manage_products.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="edit_product">Edit</button>
                        </form>
                        <form action="manage_products.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="delete_product" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
