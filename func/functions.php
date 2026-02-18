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
function debug_check_array($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}


// 役割リストを返す関数
function get_roles_list()
{
    $roles = array();

    // DBから引っ張ってくる
    //DBに接続
    try {
        $db = db_connect();
        // SELECT
        $sql = 'SELECT id,name FROM roles';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // 役割配列をDBから持ってくる
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 使いやすいように配列を置き換える
        foreach ($result as $row) {
            $roles[$row['id']] = $row['name'];
        }

        return $roles;
    } catch (PDOException $e) {
        exit("エラー:" . $e->getMessage());
    }
}
