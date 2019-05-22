<?php

require_once('../common/common.php');

try{
    $post = sanitize($_POST);

    $pro_name = $post['pro_name'];
    $pro_code = $post['pro_code'];
    $add_lot = $post['lot'];

    if ($pro_code == '') {
        echo '商品詳細からアクセスして下さい<br>';
    } elseif (preg_match('/^[0-9]+$/',$add_lot) == 0) {
        echo 'please input correct product price..<br>';
    } else {
        $dbh = connectDB();

        $sql = 'select product_id, lot from cart where 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while(true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false) {
                break;
            }
            if($rec[product_id] == $pro_code) {
                $exist = true;
                $lot_old = $rec[lot];
            }
        }
        if($exist == false) {
            $sql = 'insert into cart (product_id,lot) values (?, ?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $data[] = intval($add_lot);
            $stmt->execute($data);
            echo $pro_name .'をカートに追加しました.<br>';
        } else {
            $sql = 'update cart set lot = ? where product_id = ?';
            $stmt = $dbh->prepare($sql);
            $total_lot = $lot_old + $add_lot;
            $data[] = $total_lot;
            $data[] = $pro_code;
            $stmt->execute($data);
            echo <<<EOD
                $pro_name を $add_lot 個追加しました(計 $total_lot 個)<br>
EOD;
        }

        $dbh = null;
    }
} catch(Exception $e) {
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}

echo '<a href="cart_list.php">Go to Cart</a>
    <br><a href="shop_list.php">Go to product list</a>';
