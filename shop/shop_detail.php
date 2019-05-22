<?php

require_once('../common/common.php');

?>

<!DOCTYPE html>
<html lang="ja">
<body>
    <?php

    try {
        $pro_code = $_POST['pro_code'];
        $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);
        $dbh = connectDB();

        $sql = 'select name, price, image from mst_product where id=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];
        $pro_image = $rec['image'];

        $dbh = null;

        if($pro_image == ''){
            $desc_image = '';
        } else {
            $desc_image = '<image width="150" src="../product/image/'.$pro_image.'"><br>';
        }
    } catch(Exception $e) {
        echo 'I am sorry but something might be wrong on this server..';
        exit();
    }

    ?>

    The imfomation of product.<br>
    <?php echo $desc_image?>
    <br>
    product name : <?php echo $pro_name; ?>
    <br>
    product price : <?php echo $pro_price; ?>
    <br>
    <br>

    <form method="POST" action="shop_cart_add.php">
        <input type="button" onclick="history.back()" value="Back">
        <input type="hidden" name="pro_name" value="<?php echo $pro_name ?>">
        <input type="hidden" name="pro_code" value="<?php echo $pro_code ?>">
        数量 : <input type="number" name="lot" step="1" required>
        <input type="submit" value="カートに入れる">
    </form>
</body>
</html>
