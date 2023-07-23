<?php
session_start();
// include('../server/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>
        @media (max-width: 991.98px) {
            .navbar-toggler {
                order: 1;
                margin-left: 10px;
            }
        }
    </style>
</head>
<body>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <a href="index.php" class="d-flex justify-content-between align-items-end text-decoration-none"> <img class="logo" src="assets/imgs/logo.jpeg" />
                <h1 class="brand brand-name">Orange</h1> </a>
            </div>
            <form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2 border border-black" type="search" name="q" placeholder="Search" aria-label="Search">
                <button class="btn shop-buy-btn" type="submit">Search</button>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <ul class="d-flex flex-row list-unstyled">
                    <li class="nav-item">
                        <a href="cart.php">
                            <i class="fas fa-shopping-bag coral-text">
                                <?php if (isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                                    <span class="cart-quantity"> <?php echo $_SESSION['quantity'];  ?> </span>
                                <?php } ?>
                            </i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="account.php"><i class="fas fa-user coral-text"></i></a>
                    </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</nav>
