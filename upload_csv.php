<?php
include '../includes/product.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];
    if ($file) {
        $csvData = array_map('str_getcsv', file($file));
        foreach ($csvData as $row) {
            if (count($row) < 8) continue; // Ensure there are enough columns
            $name = $row[0];
            $description = $row[1];
            $price = $row[2];
            $quantity = $row[3];
            $category_id = $row[4];
            $supplier_id = $row[5];
            $expiration_date = $row[6];
            $barcode = $row[7];
            addProduct($name, $description, $price, $quantity, $category_id, $supplier_id, $expiration_date, $barcode);
        }
        echo "Products imported successfully.";
    } else {
        echo "Error uploading file.";
    }
}
?>

<form action="upload_csv.php" method="post" enctype="multipart/form-data">
    <label for="file">Select CSV File:</label>
    <input type="file" name="file" id="file" required>
    <button type="submit">Upload CSV</button>
</form>
