<?php

// 必要な関数を定義していく（jsのesモジュール的なもの。PHPではincludesでいける）


require_once __DIR__ . '/../inc/db_info.php';


// DBへ接続する関数
function db_connect()
{

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $db;
}



// var_dump()
function debug_check_array($target)
{
    echo "<pre>";
    var_dump($target);
    echo "</pre>";
}
