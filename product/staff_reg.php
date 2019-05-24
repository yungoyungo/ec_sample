reg<hr>

<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$name = $post['name'];
$pass = $post['pass'];

$hash = password_hash($pass, PASSWORD_BCRYPT);

echo <<< EOD
name : $name
<br>
pass : $pass
<br>
hash : $hash
<br>
EOD;

try {
    
} catch(Exception $e) {
    echo 'I am sorry but something might be wrong on this server..';
    exit();
}

echo '<a href="./staff_login.php">ログインに戻る</a>';
