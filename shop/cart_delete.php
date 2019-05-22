<?php

require_once('../common/common.php');

try {
    $pro_code = $_POST['pro_code'];

    $dbh = connectDB();

    $sql = 'DELETE from cart where product_id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $dbh = null;

    header('Location:cart_list.php');
    exit();

} catch(Exception $e){
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}

echo '<a href="cart_list.php">Go to Cart</a>
    <br><a href="shop_list.php">Go to product list</a>';
