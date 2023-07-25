

<?php include('layouts/header.php'); ?>





      <!--Home-->
      <section id="home">
        <div class="container">
          <h1>NEW ARRIVALS</h1>
          <h1><span>Best Prices</span> This Season</h1>
          <p><span style="color:coral; font-size: 18px; font-weight:700;">Orange</span> Offers the Best <span style="font-weight: 700;color:black;">Products</span> for the Most Affordable <span style="font-weight: 700; color:black;">Price</span></p>
         <a href="shop.php"><button>Shop Now</button></a> 
        </div>
      </section>

      <!--Brand-->
      <section id="brand" class="container">
        <div class="row m-0">
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.jpeg"/>
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.jpeg"/>
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.jpeg"/>
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.jpeg"/>
        </div>
      </section>

     

<!-- New Section -->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
    <?php
    // Include the file to fetch "New" products
    include('server/get_new_products.php');

    // Check if there are "New" products
    if ($new_products !== null) {
      while ($row = $new_products->fetch_assoc()) {
        // Display the "New" product card
        ?>
        
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>">
            <img class="img-fluid" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
          </a>
          <div class="details">
            <h2><?php echo $row['product_name']; ?></h2>
            <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="text-uppercase">Shop Now</button></a> 
          </div>
        </div>
        <?php
      }
    } else {
      // Display a message when there are no "New" products
      ?>
      <div class="container text-center mt-5 py-5">
        <p>No "New" products available at the moment.</p>
      </div>
      <?php
    }
    ?>
  </div>
</section>




      <!--Featured-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Our Featured</h3>
          <hr class="mx-auto">
          <p>Here you can check out our featured products</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_featured_products.php'); ?>


        <?php while($row= $featured_products->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
           <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a> 
          </div>
      
 
          <?php } ?>
        </div>
      </section>


      <!--Banner-->
      <section id="banner" class="my-5 py-5">
        <div class="container">
          <h4>MID SEASON'S SALE</h4>
          <h1>Autumn Collection <br> UP to 30% OFF</h1>
          <a href="shop.php"><button class="text-uppercase">Shop Now</button></a> 
        </div>
      </section>
   

      <!--Clothes-->
      <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Dresses & Coats</h3>
          <hr class="mx-auto">
          <p>Here you can check out our amazing clothes</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_coats.php'); ?>

        <?php while($row=$coats_products->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$ <?php echo $row['product_price']; ?> </h4>
            <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a> 
          </div>
          
          <?php } ?>
         
          
        </div>
      </section>


      <!--Watches-->
     <section id="watches" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Best Watches</h3>
        <hr class="mx-auto">
        <p>Check out our unique watches</p>
      </div>
      <div class="row mx-auto container-fluid">

      <?php include('server/get_watches.php'); ?>
      <?php while($row=$watches->fetch_assoc()){ ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
          <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a> 
        </div>

      <?php } ?>
        
     
      </div>
     </section>

      <!--Shoes-->
      <section id="shoes" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Shoes</h3>
          <hr class="mx-auto">
          <p>Here you can check out our amazing shoes</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_shoes.php');?>

        <?php while($row=$shoes->fetch_assoc()){ ?>


          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
          <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a> 
          </div>

        <?php } ?>
         
        
        </div>
      </section>

   <!-- Bags -->
<section id="bags" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Bags</h3>
    <hr class="mx-auto">
    <p>Here you can check out our amazing bags</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get_bags.php'); ?>

    <?php while ($row = $bags->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php } ?>

  </div>
</section>

 


<?php include('layouts/footer.php'); ?>