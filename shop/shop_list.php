<?php

require_once('../common/common.php');

try{

    $dbh = connectDB();

    $sql = 'select id, name, price, image from mst_product where 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    echo 'product list : <br><br>';

    while(true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == false) {
            break;
        }
        echo <<<EOD
            <hr>
            <form method="POST" action="shop_detail.php">
            <input type="hidden" name="pro_code" value="$rec[id]">
            <input type="image" height="100" src="../product/image/$rec[image]" align="middle" alt="product_image">
            $rec[name] : $rec[price] JPY
            <input type="submit" name="" value="詳細">
            <br>
            </form>
EOD;
    }
}
catch(Exception $e) {
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}


echo '<a href="cart_list.php">カートを見る</a>';