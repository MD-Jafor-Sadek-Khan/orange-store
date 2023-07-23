<?php include('layouts/header.php'); ?>

<?php
include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $result = $stmt->get_result();

    // Fetch the product row from the result set
    $product = $result->fetch_assoc();

    // Check if the product exists
    if (!$product) {
        header('location: index.php');
        exit(); // Exit the script to prevent further execution
    }
} else {
    header('location: index.php');
    exit(); // Exit the script to prevent further execution
}
?>

<!--Single product-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
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
        // Get the product category from the current product
        $relatedCategory = $product['product_category'];
        $relatedProductsQuery = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_id != ? LIMIT 4");
        $relatedProductsQuery->bind_param("si", $relatedCategory, $product_id);
        $relatedProductsQuery->execute();

        // Get the result set of related products
        $relatedProductsResult = $relatedProductsQuery->get_result();

        // Check if there are related products
        if ($relatedProductsResult->num_rows > 0) {
            while ($relatedProduct = $relatedProductsResult->fetch_assoc()) {
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
                <p>No related products available.</p>
            </div>
            <?php
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
