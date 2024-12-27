<?php
// Simple products array to simulate a database
$products = [
    ["id" => 1, "name" => "Product 1", "price" => 10.00, "stock" => 100],
    ["id" => 2, "name" => "Product 2", "price" => 20.00, "stock" => 50],
    ["id" => 3, "name" => "Product 3", "price" => 30.00, "stock" => 30],
];

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $id = $_POST['id'];
    
    // Edit price
    if ($action == "edit_price") {
        foreach ($products as &$product) {
            if ($product['id'] == $id) {
                $product['price'] = floatval($_POST['new_price']);
            }
        }
    }
    
    // Add stock
    if ($action == "add_stock") {
        foreach ($products as &$product) {
            if ($product['id'] == $id) {
                $product['stock'] += intval($_POST['add_stock']);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-top: 20px;
        }

        .menu {
            display: flex;
            gap: 20px;
            margin: 20px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #0056b3;
        }

        .product-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .product-table th {
            background-color: #007BFF;
            color: white;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }

        form input, form button {
            margin: 0 5px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Shop Management System</h1>

    <div class="menu">
        <a href="#add-product">Add Product</a>
        <a href="#edit-stock">Edit Stock</a>
        <a href="#edit-price">Edit Price</a>
    </div>

    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price ($)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['stock']; ?></td>
                    <td>
                        <!-- Edit Price Form -->
                        <form method="POST">
                            <input type="hidden" name="action" value="edit_price">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <input type="number" step="0.01" name="new_price" placeholder="New Price" required>
                            <button type="submit">Update Price</button>
                        </form>

                        <!-- Add Stock Form -->
                        <form method="POST">
                            <input type="hidden" name="action" value="add_stock">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <input type="number" name="add_stock" placeholder="Add Stock" required>
                            <button type="submit">Add Stock</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
