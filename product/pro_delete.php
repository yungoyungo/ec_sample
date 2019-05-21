<?php require_once('../common/common.php') ?>

<!DOCTYPE html>
<html lang="ja">
<body>
<?php

try {

    $pro_code = $_GET['pro_code'];

    $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);

    $dbh = connectDB();

    $sql = 'select name, image from mst_product where id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_image_name = $rec['image'];

    $dbh = null;

    if ($pro_image_name == '') {
        $desc_image = '';
    } else {
        $desc_image = '<img width="150" src="./image/'.$pro_image_name.'">';
    }

} catch(Exeption $e) {

    echo 'I am sorry but something might be wrong on this server..';
    exit();

}

?>
Delete product.<br>
Product name : <?php echo $pro_name; ?>
<br>
Product image :
<br>
<?php echo $desc_image; ?>
<br>
<?php echo 'Do you want to delete this product ?'?>
<form method="POST" action="pro_delete_done.php">
    <input type="hidden" name="id" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="image_name" value="<?php echo $pro_image_name; ?>">
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
</form>
</body>
</html>
