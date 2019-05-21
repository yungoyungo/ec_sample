<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$pro_code = $post['id'];
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_image_name_old= $post['image_name_old'];
$pro_image = $_FILES['image'];

if ($pro_name == '') {
    echo 'Please input product name..<br>';
} elseif(preg_match('/^[0-9]/+$', $pro_price)) {
    echo 'please input correct product price..<br>';
} else {
    echo <<<EDO
    Product name : $pro_name
    <br>
    Product price : $pro_price JPY
    <br>
EDO;
}

if ($pro_image['size'] > 0) {
    if ($pro_image['size'] > 1000000) {
        echo 'Image size is too large..';
    } else {
        move_uploaded_file($pro_image['tmp_name'], './image/'.$pro_image['name']);
        echo '<img width="150" src="./image/'.$pro_image['name'].'"><br>';
    }
}

if ($pro_name == '' || preg_match('/^[0-9]/+$', $pro_price) || $pro_image['size'] > 1000000) {
    echo <<<EDO
    <form>
        <input type="button" onclick="history.back()" value="Back">
    </form>
EDO;
} else {
    echo <<<EDO
    <form method="POST" action="pro_edit_done.php">
        <input type="hidden" name="id" value="$pro_code">
        <input type="hidden" name="name" value="$pro_name">
        <input type="hidden" name="price" value="$pro_price">
        <input type="hidden" name="image_name_old" value="$pro_image_name_old">
        <input type="hidden" name="image_name" value="$pro_image[name]">
        <br>
        <input type="button" onclick="history.back()" value="Back">
        <input type="submit" value="OK">
    </form>
EDO;
}