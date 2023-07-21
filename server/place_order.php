<?php

session_start();

include('connection.php');

// If user is not logged in
if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;
} else {
    if (isset($_POST['place_order'])) {
        // 1. Get user info and store it in the database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "not paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

        $stmt_status = $stmt->execute();

        if (!$stmt_status) {
            header('location: index.php');
            exit;
        }

        // 2. Issue new order and store order info in the database
        $order_id = $stmt->insert_id;

        // 3. Get products from cart (from session)
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            // 4. Store each single item in order_items database
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_quantity, user_id, order_date, product_price)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_quantity, $user_id, $order_date, $product_price);

            $stmt1->execute();
        }

        // 5. Remove everything from cart --> delay until payment is done
        unset($_SESSION['cart']);

        $_SESSION['order_id'] = $order_id;

        // 6. Inform the user whether everything is fine or there is a problem
        header('location: ../payment.php?order_status=order placed successfully');
    }
}

?>
