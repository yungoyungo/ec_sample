<?php

$pro_code = $_POST['pro_code'];

if (isset($_POST['add']) == true) {

    header ('Location:pro_add.php');
    exit();

} elseif ($pro_code == null) {

    header('Location:pro_ng.php');
    exit();

} else {

    if (isset($_POST['detail']) == true) {
        header('Location:pro_detail.php?pro_code='.$pro_code);
        exit();
    }

    elseif(isset($_POST['edit']) == true) {

        header('Location:pro_edit.php?pro_code='.$pro_code);
        exit();

    } elseif (isset($_POST['delete']) == true) {

        header('Location:pro_delete.php?pro_code='.$pro_code);
        exit();

    }

}

?>