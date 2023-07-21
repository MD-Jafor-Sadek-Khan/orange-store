<?php
include('layouts/header.php');
require_once('server/connection.php');


if(isset($_GET['q'])){
    $keyword = $_GET['q'];

    $query = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        // echo '<div class="mt-3 pt-3"></div>';
        echo '<div class="mt-3 pt-3"></div>';
        echo '<div class="container mt-5 pt-5">';
        echo '<h3 > Search Results</h3>';
        echo '<hr class="mb-5">';
        echo '<div class="row mx-5">';
        
        while($row = mysqli_fetch_assoc($result)){
            echo '<div class="col-md-6 col-sm-6 col-lg-4 col-xxl-3">';
            echo '<div class="card mb-4 search-border search-card-body">';
            echo '<img src="assets/imgs/' . $row['product_image'] . '" class="card-img-top  w-75 mx-auto w-sm-50" alt="' . $row['product_name'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title search-title">' . $row['product_name'] . '</h5>';
            echo '<hr class="mx-auto px-4">';
            echo '<p class="card-text search-description mx-2">' . $row['product_description'] . '</p>';
            echo '<div class="price-buy-wrapper d-flex justify-content-around align-items-baseline">';
            echo '<p class="card-price">Price: <span class="coral-text">$' . $row['product_price'] . '</span></p>';

            echo '<a class="btn shop-buy-btn" href="single_product.php?product_id=' . $row['product_id'] . '">Buy Now</a>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }
}

mysqli_close($conn);

?>


</div>
<?php include('layouts/footer.php');?>
