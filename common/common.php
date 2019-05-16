<?php

function sanitize($post) {
    foreach ($post as $key => $value) {
        $sanitized_post[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    return $sanitized_post;
}

function connectDB() {
    $dsn = 'mysql:dbname=mini_shop; host=localhost; charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}