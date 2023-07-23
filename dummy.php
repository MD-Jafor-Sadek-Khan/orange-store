<?php
// single_product.php

// Step 1: Include the header and database connection
include('layouts/header.php');
include('server/connection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Step 2: Retrieve the product ID from the URL parameter
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Step 3: Fetch the product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $result = $stmt->get_result();

    // Fetch the product row from the result set
    $product = $result->fetch_assoc();

    // Step 4: Check if the product exists
    if (!$product) {
        header('location: index.php');
        exit(); // Exit the script to prevent further execution
    }
} else {
    header('location: index.php');
    exit(); // Exit the script to prevent further execution
}

// Step 5: Retrieve User ID from Session (assuming you already have the user ID stored in the session)

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // If the user ID is not set in the session, you may redirect to the homepage or login page.
    header('Location: index.php');
    exit;
}

// Step 6: Record User-Product View Interaction
// Here, we'll record a "view" interaction for the user and product combination.
// The timestamp will be automatically set to the current time.
$interaction_type = "view";
$timestamp = date('Y-m-d H:i:s'); // Current timestamp

$stmt = $conn->prepare("INSERT INTO user_interactions (user_id, product_id, interaction_type, timestamp) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $product_id, $interaction_type, $timestamp);
$stmt->execute();
$stmt->close();

// ... Rest of the code for the single product page ...



// Step 7: Implement Collaborative Filtering Algorithm
// Fetch related products based on user interactions
$relatedProductsQuery = $conn->prepare("SELECT DISTINCT p.*
    FROM products p
    WHERE p.product_category = ? AND p.product_id <> ?
    LIMIT 4
");

$relatedProductsQuery->bind_param("si", $product['product_category'], $product_id);
$relatedProductsQuery->execute();
$relatedProductsResult = $relatedProductsQuery->get_result();

// Check if there are related products
if ($relatedProductsResult->num_rows > 0) {
    // Display the related products
    while ($relatedProduct = $relatedProductsResult->fetch_assoc()) {
        // Code to display related products goes here
        // For example, you can display each related product's details like product name, image, etc.
        // Replace the sample HTML below with the code to display the related products as per your design.
    }
}
?>

<!--Single product-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <!-- Product details and image display -->
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $product['product_image']; ?>" id="mainImg"/>
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $product['product_image']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $product['product_image2']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $product['product_image3']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $product['product_image4']; ?>" width="100%" class="small-img"/>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <h6>Men/Shoes</h6>
            <h3 class="py-4"><?php echo $product['product_name']; ?></h3>
            <h2>$<?php echo $product['product_price']; ?></h2>

            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
                <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>"/>
                <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>"/>
                <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>"/>
                
                <input type="number" name="product_quantity" value="1"/>
                <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
            </form>

            <h4 class="mt-5 mb-5">Product details</h4>
            <span><?php echo $product['product_description']; ?></span>
        </div>
    </div>
</section>

<!-- Related products -->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Related Products</h3>
        <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
        <?php
        // Step 7: Implement Collaborative Filtering Algorithm
        // Fetch related products based on user interactions
        $relatedProductsQuery = $conn->prepare("SELECT DISTINCT p.*
    FROM products p
    WHERE p.product_category = ? AND p.product_id <> ?
    LIMIT 4
");

        $relatedProductsQuery->bind_param("si", $product['product_category'], $product_id);
        $relatedProductsQuery->execute();
        $relatedProductsResult = $relatedProductsQuery->get_result();

        // Check if there are related products
        if ($relatedProductsResult->num_rows > 0) {
            // Display the related products
            while ($relatedProduct = $relatedProductsResult->fetch_assoc()) {
                // Code to display related products goes here
                // For example, you can display each related product's details like product name, image, etc.
                // Replace the sample HTML below with the code to display the related products as per your design.
        ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $relatedProduct['product_image']; ?>" />
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $relatedProduct['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $relatedProduct['product_price']; ?></h4>
            <a class="btn shop-buy-btn" href="single_product.php?product_id=<?php echo $relatedProduct['product_id']; ?>">Buy Now</a>
        </div>
        <?php
            }
        } else {
            // Display a message when there are no related products
            ?>
            <div class="container text-center mt-5 py-5">
                <p>No related products available. Showing products from the same category:</p>
            </div>
            <?php

            // Display products from the same category here (if available)
            // You can use $categoryProductsResult to fetch products from the same category
        }
        ?>
    </div>
</section>


<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < 4; i++) {
        smallImg[i].onclick = function () {
            mainImg.src = smallImg[i].src;
        }
        }
    
</script>

<?php include('layouts/footer.php'); ?>
