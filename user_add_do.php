<?php
// めあて：ユーザー情報を登録する

// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';


// POST送信されているか
if (!empty($_POST)) {

    // 必須項目が入力されているか
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        debug_check_array($_POST);

        // $_POSTから値を取り出す
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // ユーザー名の書式チェック（半角英数　4文字以上)
        if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
            header('location: user_add.php');
            exit();
        }
        // ユーザー名はユニーク制約なので、重複してないかも確認する
        // DB接続(取り出して、比較したい)
        try {
            $db = db_connect();
            // 重複名が存在するかカウント
            $sql = 'SELECT COUNT(name) FROM users WHERE name = :name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            // キーが連番の配列で取り出す
            $result = $stmt->fetch(PDO::FETCH_NUM);
            debug_check_array($result);

            // $resultが空なら重複なしだが...あるときは弾きたい
            if ($result[0] !== 0) {
                header('location: user_add.php');
            }
            // パスワードをハッシュ化する（password_hash）
            $password_h = password_hash($password, PASSWORD_DEFAULT);
            echo $password_h;

            // DBのusersに登録
            // SQLを再度書く
            $sql_2 = 'INSERT INTO users(name,password,role,date)
            VALUES(:name,:password,:role,now())';
            $stmt = $db->prepare($sql_2);

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_h, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            exit('エラー' . $e->getMessage());
        }
    }
}

// POST送信されていない時もページ遷移
header('location: user.php');
