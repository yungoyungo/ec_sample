<?php

require_once('../common/common.php');

try{

    $dbh = connectDB();

    $sql_cart = 'select product_id, lot from cart where 1';
    $stmt_cart = $dbh->prepare($sql_cart);
    $stmt_cart->execute();

    echo 'cart : <br><br>';

    while(true) {
        $rec_cart = $stmt_cart->fetch(PDO::FETCH_ASSOC);
        if($rec_cart == false) {
            break;
        }
        $sql_items = 'select id, name, price, image from mst_product where id=?';
        $stmt_items = $dbh->prepare($sql_items);
        $data[] = $rec_cart[product_id];
        $stmt_items->execute($data);
        $rec_items = $stmt_items->fetch(PDO::FETCH_ASSOC);
        $subtotal = $rec_items[price]*$rec_cart[lot];
        echo <<<EOD
            <hr>
            <form method="POST" action="cart_delete.php">
            <input type="hidden" name="pro_code" value="$rec_items[id]">
            <image height="100" src="../product/image/$rec_items[image]" alt="product_image"><br>
            $rec_items[name] : $rec_items[price] JPY : × $rec_cart[lot] 個<br>
            (小計 : $subtotal JPY)<br>
            <input type="number" name="lot" step="1" required value="$rec_cart[lot]">
            <input type="submit" name="update" value="数量変更">
            <input type="submit" name="delete" value="カートから削除">
            <br>
            </form>
EOD;
        $data = null;
    }
}
catch(Exception $e) {
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}
$dbh = null;

echo '<a href="shop_list.php">商品一覧へ</a>';