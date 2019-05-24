auth<hr>

<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$name = $post['name'];
$pass = $post['pass'];

$hash = password_hash($pass, PASSWORD_BCRYPT);

$dbh = connectDB();

$sql = 'select hash from staff where name=?';
$stmt = $dbh->prepare($sql);
$data[] = $name;
$stmt->execute($data);

$dbh = null;

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
echo 'name : '.$name.'<br>hash:'.$rec[hash].'<br>';

/* echo <<< EOD
name : $name
<br>
pass : $pass
<br>
hash : $hash
<br>
EOD; */

if(password_verify($pass, $rec[hash])) {

    echo '<hr>認証成功<br>
    <a href="pro_list.php">管理画面へ</a><br>';
   /*  header('Location:pro_list.php');
    exit(); */
}else{
    echo 'password wrong!<br>';
}


try {
    
} catch(Exception $e) {
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}

echo '<a href="./staff_login.php">ログインに戻る</a>';
