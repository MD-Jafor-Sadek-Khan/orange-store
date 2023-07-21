<?php
// Include the database connection file
include('connection.php');

// Query to fetch bag products from the 'products' table where product_category is 'bags'
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = 'bags' LIMIT 4");
$stmt->execute();

// Get the result of the query
$bags = $stmt->get_result();
?>
