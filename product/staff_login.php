<!DOCTYPE html>
<html lang="ja">
<body>

<p>スタッフログイン</p>
<hr>
<form method="POST" action="staff_auth.php">
    <input type="text" name="name" placeholder="ユーザー名">
    <input type="password" name="pass" placeholder="パスワード">
    <input type="submit" value="ログイン">
</form>
<br><hr>

<p>新規登録はこちら</p>
<form method="POST" action="staff_reg.php">
    <input type="text" name="name" placeholder="ユーザー名">
    <input type="password" name="pass" placeholder="パスワード">
    <input type="submit" value="ログイン">
</form>
<hr>
<a href="../shop/shop_list.php">商品一覧に戻る</a>
</body>
<html>