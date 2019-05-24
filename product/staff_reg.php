reg<hr>

<?php

require_once('../common/common.php');

try {
    $post = sanitize($_POST);

    if($post['name']=='' || $post['pass']==''){
        echo '名前とパスワードを入力して下さい<br>';
    } else {
        $name = $post['name'];
        $pass = $post['pass'];

        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $dbh = connectDB();

        $sql = 'insert into staff (name, hash) values (?, ?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $data[] = $hash;
        $stmt->execute($data);

        $dbh = null;

        echo <<< EOD
        登録しました<br>
        name : $name
        <hr>
        <a href="pro_list.php">管理画面へ</a><br>
EOD;
    }
    
} catch(Exception $e) {
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}

echo '<a href="./staff_login.php">ログインに戻る</a>';
