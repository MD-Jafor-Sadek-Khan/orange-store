<?php
// Include the database connection
include('connection.php');

// Query to get the "New" products
$query = "SELECT * FROM products WHERE product_category = 'new'";
$result = $conn->query($query);

// Check if there are any "New" products
if ($result->num_rows > 0) {
  $new_products = $result;
} else {
  $new_products = null;
}
?>
